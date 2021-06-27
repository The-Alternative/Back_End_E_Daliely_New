<?php

namespace App\Http\Controllers\MenuType;

use App\Http\Controllers\Controller;
use App\Service\MenuType\MenuTypeService;
use Illuminate\Http\Request;

class MenuTypeController extends Controller
{
    private $MenuTypeService;


    public function __construct(MenuTypeService $MenuTypeService)
    {
        $this->MenuTypeService=$MenuTypeService;
    }
    public function get()
    {
        return $this->MenuTypeService->get();
    }
    public function  getById($id)
    {
        return $this->MenuTypeService->getById($id);
    }
    public function getTrashed()
    {
        return$this->MenuTypeService->getTrashed();
    }
    public function create(MenuRequest $request)
    {
        return $this->MenuTypeService->create($request);
    }
    public function update(MenuRequest $request,$id)
    {
        return $this->MenuTypeService->update($request,$id);
    }
    public function search($restaurant_type_title)
    {
        return $this->MenuTypeService->search($restaurant_type_title);
    }
    public function trash($id)
    {
        return $this->MenuTypeService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->MenuTypeService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->MenuTypeService->delete($id);
    }
}
