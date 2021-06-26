<?php


namespace App\Service\Menus;


use App\Http\Requests\Menus\MenuRequest;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuTranslation;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class MenuService
{
    private $MenuModel;
    use GeneralTrait;

    public function __construct(Menu $Menu)
    {
        $this->MenuModel=$Menu;
    }
    public function get()
    {
        try{
            $Menu= $this->MenuModel::paginate(5);
            return $this->returnData('Menu ',$Menu,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $Menu= $this->MenuModel->find($id);
            if (is_null($Menu)){
                return $this->returnSuccessMessage('this Menu not found','done');
            }
            else {
                return $this->returnData('Menu', $Menu, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
//__________________________________________________________________________//
    public function create( MenuRequest $request )
    {
        try {
            $allmenu = collect($request->Menu)->all();
            DB::beginTransaction();
            $unTransMenu_id =Menu::insertGetId([
                'image' => $request['image'],
                'type_menu_id' => $request['user_id'],
                'restaurant_id' => $request['restaurant_id'],
                'is_approved' => $request['is_approved'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allmenu)) {
                foreach ($allmenu as $allmenus) {
                    $transmenu[] = [
                        'title' => $allmenus ['title'],
                        'short_description' => $allmenus ['short_description'],
                        'long_description' => $allmenus ['short_description'],
                        'locale' => $allmenus['locale'],
                        'menu_id' => $unTransMenu_id,
                    ];
                }
                MenuTranslation::insert( $transmenu);
            }
            DB::commit();
            return $this->returnData('Menu', [$unTransMenu_id,$transmenu], 'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Menu', $ex->getMessage());
        }
    }
//_________________________________________________________//
    public function update(MenuRequest $request,$id)
    {
        try{
            $menu= Menu::find($id);
            if(!$menu)
                return $this->returnError('400', 'not found this menu');
            $allmenu = collect($request->Menu)->all();
            if (!($request->has('menus.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newmenu=Menu::where('menus.id',$id)
                ->update([
                    'image' => $request['image'],
                    'type_menu_id' => $request['user_id'],
                    'restaurant_id' => $request['restaurant_id'],
                    'is_approved' => $request['is_approved'],
                    'is_active' => $request['is_active'],
                ]);

            $ss=MenuTranslation::where('menu_translations.restaurant_id',$id);
            $collection1 = collect($allmenu);
            $allmenulength=$collection1->count();
            $collection2 = collect($ss);

            $db_menu= array_values(MenuTranslation::where('menu_translations.restaurant_id',$id)
                ->get()
                ->all());
            $dbmenu = array_values($db_menu);
            $request_menu= array_values($request->Menu);
            foreach($dbmenu as $dbmenus){
                foreach($request_menu as $request_menus){
                    $values= MenuTranslation::where('menu_translations.restaurant_id',$id)
                        ->where('locale',$request_menus['locale'])
                        ->update([
                            'title' => $dbmenus ['title'],
                            'short_description' => $dbmenus ['short_description'],
                            'long_description' => $dbmenus ['short_description'],
                            'locale' => $dbmenus['locale'],
                            'menu_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Menu', [$dbmenu,$values],'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
//___________________________________________________________//
    public function search($restaurant_name)
    {
        try {
            $menu = DB::table('menu_translations')
                ->where("title", "like", "%" . $restaurant_name . "%")
                ->get();
            if (!$menu) {
                return $this->returnError('400', 'not found this Menu');
            } else {
                return $this->returnData('Menu', $menu, 'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try{
            $menu= $this->MenuModel::find($id);
            if(is_null($menu)){
                return $this->returnSuccessMessage('This Menu not found', 'done');}
            else{
                $menu->is_active =0;
                $menu->save();
                return $this->returnData('Menu', $menu, 'This Menu is trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getTrashed()
    {
        try {
            $menu = $this->MenuModel::NotActive();
            return $this->returnData('menu', $menu, 'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try {
            $menu = $this->MenuModel::find($id);
            if (is_null($menu)) {
                return $this->returnSuccessMessage('This menu not found', 'done');
            } else {
                $menu->is_active =1;
                $menu->save();
                return $this->returnData('menu', $menu, 'This menu is trashed Now');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function delete($id)
    {
        try{
            $menu = $this->MenuModel::find($id);
            if ($menu->is_active == 0) {
                $menu ->MenuModel->delete();
                $menu ->MenuTranslation()->delete();
                return $this->returnData('menu', $menu, 'This menu is deleted Now');

            }
            else {
                return $this->returnData('menu', $menu, 'This menu is deleted Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
}
