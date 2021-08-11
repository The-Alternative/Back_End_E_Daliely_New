<?php

namespace App\Service\Admin;

use App\Models\Admin\Employee;
use App\Models\Admin\Role;
use App\Models\Order\Order;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class EmployeeService
{

    use GeneralTrait;
    private $employeeModel;
    private $roleModel;

    public function __construct(Employee $employeeModel , Role $roleModel)
    {
        $this->employeeModel=$employeeModel;
        $this->roleModel=$roleModel;
    }
    /*___________________________________________________________________________*/
    /****  Get All Active User Or By ID  ****/
    public function getAll()
    {
        try{
            $employee = $this->employeeModel->get();
            if (count($employee) > 0){
                return $response= $this->returnData('Employee',$employee,'done');
            }else{
                return $response= $this->returnSuccessMessage('Employee','Employee doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    public function getById($id)
    {
        try{
            $employee =$this->employeeModel->with(['roles'=>function($q){
                return $q->with('Permission')->get();}])->find($id);
            if (is_null($employee) ){
                return $response= $this->returnSuccessMessage('This Employee not found','done');
            }else{
                return $response= $this->returnData('Employee',$employee,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  ـThis Functions For Trashed user   ****/
    /****Get All Trashed User Or By ID  ****/
    public function getTrashed()
    {
        try{
            $employee = $this->employeeModel->where('employees.is_active',0)->get();
            return $this -> returnData('Employee',$employee,'done');
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Restore Role Fore Active status  ***
     * @param $id
     */
    public function restoreTrashed( $id)
    {
        try{
            $employee=$this->employeeModel->find($id);
            if (is_null($employee) ){
                return $response= $this->returnSuccessMessage('This Employee not found','done');
            }else{
                $employee->is_active=true;
                $employee->save();
                return $this->returnData('Employee', $employee,'This Employee Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****   User's Soft Delete   ***
     * @param $id
     */
    public function trash( $id)
    {
        try{
            $employee=$this->employeeModel->find($id);
            if (is_null($employee) ){
                return $response= $this->returnSuccessMessage('This User not found','done');
            }else{
                $employee->is_active=false;
                $employee->save();
                return $this->returnData('Employee', $employee,'This Employee Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Create User   ****/
    /*___________________________________________________________________________*/
    public function create(Request $request)
    {
        try {
//            $validated = $request->validated();
            $request->is_active ? $is_active = true : $is_active = false;
            DB::beginTransaction();

            $employee=$this->employeeModel->create([
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'age' => $request->age,
               'location_id' => $request->location_id,
               'social_media_id' => $request->social_media_id,
               'image' => $request->image,
               'email' => $request->email,
               'is_active' => $request->is_active,
               'salary' => $request->salary,
               'certificate' => $request->certificate,
               'start_date' => $request->start_date,
               'password' =>bcrypt($request->password)
            ]);
            $token = JWTAuth::fromUser($employee);
            if ($request->has('roles')) {
                $role = $this->employeeModel->find($employee->id);
                $role->roles()->syncWithoutDetaching($request->get('roles'));
            }
            if ($request->has('permissions')) {
                $permissions = $this->employeeModel->find($employee->id);
                $permissions->permissions()->syncWithoutDetaching($request->get('permissions'));
            }
            DB::commit();
            return $this->returnData('Employee', [$token,$employee],'Done');

        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Update Role   ***/
    public function update(Request $request,$id)
    {
        try{
//            $validated = $request->validated();
            $employee=$this->employeeModel->find($id);
            $employee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'location_id' => $request->location_id,
                'social_media_id' => $request->social_media_id,
                'image' => $request->image,
                'email' => $request->email,
                'is_active' => $request->is_active,
                'salary' => $request->salary,
                'certificate' => $request->certificate,
                'start_date' => $request->start_date,
                'password' =>bcrypt($request->password)
            ]);
            $token = JWTAuth::fromUser($employee);
            if ($request->has('roles')) {
                $role = $this->employeeModel->find($employee->id);
                $role->roles()->syncWithoutDetaching($request->get('roles'));
            }
            if ($request->has('permissions')) {
                $permissions = $this->employeeModel->find($employee->id);
                $permissions->permissions()->syncWithoutDetaching($request->get('permissions'));
            }
            DB::commit();
            return $this->returnData('Employee', [$token,$employee],'Done');

        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Search For User  ****/
    public function search($name)
    {
        try {
            $employee = DB::table('employees')
                ->where("name","like","%".$name."%")
                ->get();
            if (!$employee)
            {
                return $this->returnError('400', 'not found this Employee');
            }
            else
            {
                return $this->returnData('Employee', $employee,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Delete user   ***/
    public function delete($id)
    {
        try{
            $employee=$this->employeeModel->find($id);
            if ($employee->is_active=0)
            {
                $roles=$this->employeeModel->destroy($id);
                return $this->returnData('Employee', $employee,'This Employee Is deleted Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  User Profile   ***/
    public function profile($id)
    {
        try{
            $employee=$this->employeeModel->with([
                'roles'=>function($q){
                return $q->with('Permission')->get();
                },
                'Stores_Order'
            ])->find($id);
            if (is_null($employee) ){
                return $response= $this->returnSuccessMessage('This Employee not found','done');
            }else{
                return $response= $this->returnData('Employee',$employee,'done');
            }
        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
