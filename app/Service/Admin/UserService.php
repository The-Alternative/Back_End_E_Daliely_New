<?php

namespace App\Service\Admin;

use App\Models\Admin\Role;
use App\Models\Order\Order;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{

    use GeneralTrait;
    private $userModel;
    private $roleModel;

    public function __construct(User $userModel , Role $roleModel)
    {
        $this->userModel=$userModel;
        $this->roleModel=$roleModel;
    }
    /*___________________________________________________________________________*/
    /****  Get All Active User Or By ID  ****/
    public function getAll()
    {
        try{
            $user = $this->userModel->get();
            if (count($user) > 0){
                return $response= $this->returnData('User',$user,'done');
            }else{
                return $response= $this->returnSuccessMessage('User','User doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    public function getById($id)
    {
        try{
            $user =$this->userModel->with(['roles'=>function($q){
                return $q->with('Permission')->get();}])->find($id);
            if (is_null($user) ){
                return $response= $this->returnSuccessMessage('This User not found','done');
            }else{
                return $response= $this->returnData('User',$user,'done');
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
            $user = $this->userModel->where('user.is_active',0)->get();
            return $this -> returnData('User',$user,'done');
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
            $user=$this->userModel->find($id);
            if (is_null($user) ){
                return $response= $this->returnSuccessMessage('This User not found','done');
            }else{
                $user->is_active=true;
                $user->save();
                return $this->returnData('User', $user,'This User Is trashed Now');
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
            $user=$this->userModel->find($id);
            if (is_null($user) ){
                return $response= $this->returnSuccessMessage('This User not found','done');
            }else{
                $user->is_active=false;
                $user->save();
                return $this->returnData('User', $user,'This User Is trashed Now');
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
//            $request->is_active ? $is_active = true : $is_active = false;
            DB::beginTransaction();

            $user=$this->userModel->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'location_id' => $request->location_id,
                'social_media_id' => $request->social_media_id,
                'is_active' => $request->is_active,
                'image' => $request->image,
                'email' => $request->email,
                'password' =>bcrypt($request->password)
            ]);
            $token = JWTAuth::fromUser($user);
            if ($request->has('roles')) {
                $role = $this->userModel->find($user->id);
                $role->roles()->syncWithoutDetaching($request->get('roles'));
            }
            if ($request->has('permissions')) {
                $permissions = $this->userModel->find($user->id);
                $permissions->permissions()->syncWithoutDetaching($request->get('permissions'));
            }
            DB::commit();
            return $this->returnData('User', [$token,$user],'Done');

        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('User', $ex->getMessage());
        }
    }
    /*___________________________________________________________________________*/
    /****  Update Role   ***/
    public function update(Request $request,$id)
    {
        try{
//            $validated = $request->validated();
            $user=$this->userModel->find($id);
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'location_id' => $request->location_id,
                'social_media_id' => $request->social_media_id,
                'is_active' => $request->is_active,
                'image' => $request->image,
                'email' => $request->email,
                'password' =>bcrypt($request->password)
            ]);
            $token = JWTAuth::fromUser($user);
            if ($request->has('roles')) {
                $role = $this->userModel->find($user->id);
                $role->roles()->syncWithoutDetaching($request->get('roles'));
            }
            if ($request->has('permissions')) {
                $permissions = $this->userModel->find($user->id);
                $permissions->permissions()->syncWithoutDetaching($request->get('permissions'));
            }
            DB::commit();
            return $this->returnData('User', [$token,$user],'Done');

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
            $user = DB::table('users')
                ->where("name","like","%".$name."%")
                ->get();
            if (!$user)
            {
                return $this->returnError('400', 'not found this user');
            }
            else
            {
                return $this->returnData('user', $user,'done');
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
            $user=$this->userModel->find($id);
            if ($user->is_active=0)
            {
                $roles=$this->userModel->destroy($id);
                return $this->returnData('User', $user,'This User Is deleted Now');
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
            $user=$this->userModel->with([
                'roles'=>function($q){
                return $q->with('Permission')->get();
                },
                'Stores_Order'
            ])->find($id);
            if (is_null($user) ){
                return $response= $this->returnSuccessMessage('This User not found','done');
            }else{
                return $response= $this->returnData('User',$user,'done');
            }
        }
        catch(\Exception $ex){
return $this->returnError('400', $ex->getMessage());
}
    }
}
