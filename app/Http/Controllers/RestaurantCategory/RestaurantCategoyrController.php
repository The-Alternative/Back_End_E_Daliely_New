<?php

namespace App\Http\Controllers\RestaurantCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantCategory\RestaurantCategoryRequest;
use App\Service\RestaurantCategory\RestaurantCategoryService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantCategoyrController extends Controller
{
    use GeneralTrait;
    private $RestaurantCategoryService;
    private $response;

    public function __construct(RestaurantCategoryService $RestaurantCategory,Response $response )
    {
        $this->RestaurantCategorySrevice=$RestaurantCategory;
        $this->response=$response;
    }
    public function get()
    {
        return $this->RestaurantCategorySrevice->get();
    }
    public function  getById($id)
    {
        return $this->RestaurantCategorySrevice->getById($id);
    }
    public function getTrashed()
    {
        return$this->RestaurantCategorySrevice->getTrashed();
    }
    public function create(RestaurantCategoryRequest $request)
    {
        return $this->RestaurantCategorySrevice->create($request);
    }
    public function update(RestaurantCategoryRequest $request,$id)
    {
        return $this->RestaurantCategorySrevice->update($request,$id);
    }
    public function search($name)
    {
        return $this->RestaurantCategorySrevice->search($name);
    }
    public function trash($id)
    {
        return $this->RestaurantCategorySrevice->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->RestaurantCategorySrevice->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->RestaurantCategorySrevice->delete($id);
    }
}
