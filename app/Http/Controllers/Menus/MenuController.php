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
    public function create(MenuService $request)
    {
        return $this->MenuService->create($request);
    }
    public function update(MenuRequest $request,$id)
    {
        return $this->MenuService->update($request,$id);
    }
    public function search($restaurant_type_title)
    {
        return $this->MenuService->search($restaurant_type_title);
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
}