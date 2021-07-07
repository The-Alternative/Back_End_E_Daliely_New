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
        $this->RestaurantCategoryService=$RestaurantCategory;
        $this->response=$response;
    }
    public function get()
    {
        return $this->RestaurantCategoryService->get();
    }
    public function  getById($id)
    {
        return $this->RestaurantCategoryService->getById($id);
    }
    public function getTrashed()
    {
        return$this->RestaurantCategoryService->getTrashed();
    }
    public function create(RestaurantCategoryRequest $request)
    {
        return $this->RestaurantCategoryService->create($request);
    }
    public function update(RestaurantCategoryRequest $request,$id)
    {
        return $this->RestaurantCategoryService->update($request,$id);
    }
    public function search($name)
    {
        return $this->RestaurantCategoryService->search($name);
    }
    public function trash($id)
    {
        return $this->RestaurantCategoryService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->RestaurantCategoryService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->RestaurantCategoryService->delete($id);
    }
    public function getRestaurant($id)
    {
        return $this->RestaurantCategoryService->getRestaurant($id);
    }
    public function getProduct($id)
    {
        return $this->RestaurantCategoryService->getProduct($id);
    }
}
