<?php

namespace App\Service\Menu;

use App\Http\Requests\Meun\MenuRequest;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuTranslation;
use App\Notifications\Notifications;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class MenuService
{
    private $MenuModel;
    use GeneralTrait;

    public function __construct(Menu $menu)
    {
        $this->MenuModel=$menu;
    }
    public function get()
    {
        try {
            $menu = $this->MenuModel::paginate(5);
            return $this->returnData('Menu', $menu, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $menu= $this->MenuModel::find($id);
            if (is_null($menu)){
                return $this->returnSuccessMessage('this Menu not found','done');
            }
            else{
                return $this->returnData('Menu',$menu,'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }
    //__________________________________________________________//
    public function create( MenuRequest $request )
    {
        try {
            $allMenu = collect($request->Menu)->all();
            DB::beginTransaction();
            $unTransMenu_id = Menu::insertGetId([
                'image'   => $request['image'],
                'is_approved' => $request['is_approved'],
                'is_active'   => $request['is_active'],

            ]);
            if (isset($allMenu)) {
                foreach ($allMenu as $allMenus) {
                    $transmenu[] = [
                        'name' => $allMenus ['name'],
                        'short_description' => $allMenus ['short_description'],
                        'long_description' => $allMenus ['long_description'],
                        'locale' => $allMenus['locale'],
                        'menu_id' => $unTransMenu_id,
                    ];
                }
                MenuTranslation::insert($transmenu);

                $notification=Menu::find($unTransMenu_id);
                Notification::send($notification,new Notifications($notification));
            }
            DB::commit();
            return $this->returnData('Menu',[$unTransMenu_id, $transmenu],'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
    //___________________________________________________________________//
    public function update(MenuRequest $request,$id)
    {
        try{
            $menu= Menu::find($id);
            if(!$menu)
                return $this->returnError('400', 'not found this Menu');
            $allMenu = collect($request->Menu)->all();
            if (!($request->has('menus.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $allmenu=Menu::where('menus.id',$id)
                ->update([
                    'image'   => $request['image'],
                    'is_approved' => $request['is_approved'],
                    'is_active'   => $request['is_active'],
                ]);

            $ss=MenuTranslation::where('menu_translations.menu_id',$id);
            $collection1 = collect($allmenu);
            $allmenulength=$collection1->count();
            $collection2 = collect($ss);

            $db_menu= array_values(MenuTranslation::where('menu_translations.menu_id',$id)
                ->get()
                ->all());
            $dbmenu= array_values($db_menu);
            $request_menu= array_values($request->Menu);
            foreach($dbmenu as $dbmenus){
                foreach($request_menu as $request_menus){
                    $values=MenuTranslation::where('menu_translations.menu_id',$id)
                        ->where('locale',$request_menus['locale'])
                        ->update([
                            'name' => $request_menus ['name'],
                            'short_description' => $request_menus ['short_description'],
                            'long_description' => $request_menus ['long_description'],
                            'locale' => $request_menus['locale'],
                            'menu_id' => $id,
                        ]);
                }
            }

            DB::commit();
            return $this->returnData(' restaurant category', [$dbmenu,$values],'done');
        }
        catch(\Exception $ex){
            DB::rollBack();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    //____________________________________________________________//
    public function search($name)
    {
        try {
            $menu = DB::table('menu_translations')
                ->where("name", "like", "%" . $name . "%")
                ->get();
            if (!$menu) {
                return $this->returnError('400', 'not found this Menu');
            } else {
                return $this->returnData('Menu', $menu, 'done');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try{
            $menu= $this->MenuModel::find($id);
            if (is_null($menu)) {
                return $this->returnSuccessMessage('This Menu not found', 'done');
            }
            else
            {
                $menu->is_active=0;
                $menu->save();
                return $this->returnData('Menu', $menu,'This Menu is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
    public function getTrashed()
    {
        try{
            $menu= $this->MenuModel::NotActive()->all();
            return $this -> returnData('Menu',$menu,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try{
            $menu=$this->MenuModel::find($id);
            if (is_null($menu)) {
                return $this->returnSuccessMessage('This Menu not found', 'done');
            }
            else
            {
                $menu->is_active=1;
                $menu->save();
                return $this->returnData('Menu', $menu,'This Menu is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    //________________________________________//
    public function delete($id)
    {
        try{
            $menu = $this->MenuModel::find($id);
            if ($menu->is_active == 0) {

                $menu->delete();
                $menu->MenuTranslation()->delete();
                return $this->returnData('Menu', $menu, 'This Menu is deleted Now');
            }
            else{
                return $this->returnData('Menu', $menu, 'This Menu can not deleted Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function getRestaurant($id)
    {
        try {
            $Category = $this->MenuModel::with('Restaurant')->find($id);
            return $this->returnData('Restaurant Menu', $Category, 'done');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
