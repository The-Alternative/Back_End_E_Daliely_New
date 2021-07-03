<?php

namespace App\Http\Controllers\Menus;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menus\MenuRequest;
use App\Models\Menu\MenuTranslation;
use App\Service\Menus\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $MenuService;


    public function __construct(MenuService $MenuService)
    {
        $this->MenuService=$MenuService;
    }
    public function get()
    {
        return $this->MenuService->get();
    }
    public function  getById($id)
    {
        return $this->MenuService->getById($id);
    }
    public function getTrashed()
    {
        return$this->MenuService->getTrashed();
    }
    public function create(MenuRequest $request)
    {
        return $this->MenuService->create($request);
    }
    public function update(MenuRequest $request,$id)
    {
        return $this->MenuService->update($request,$id);
    }
    public function search($menu_name)
    {
        return $this->MenuService->search($menu_name);
    }
    public function trash($id)
    {
        return $this->MenuService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->MenuService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->MenuService->delete($id);
    }
    public function getType($id)
    {
        return $this->MenuService->getType($id);
    }
    public function getRestaurant($id)
    {
        return $this->MenuService->getRestaurant($id);
    }

}
