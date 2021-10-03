<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\RestaurantRequest;
use App\Service\Restaurant\RestaurantService;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    private $RestaurantService;

    public function __construct(RestaurantService $RestaurantService )
    {
        $this->RestaurantService=$RestaurantService;
    }
    public function get()
    {
        return $this->RestaurantService->get();
    }
    public function  getById($id)
    {
        return $this->RestaurantService->getById($id);
    }
    public function getTrashed()
    {
        return$this->RestaurantService->getTrashed();
    }
    public function create(RestaurantRequest $request)
    {
        return $this->RestaurantService->create($request);
    }
    public function update(RestaurantRequest $request,$id)
    {
        return $this->RestaurantService->update($request,$id);
    }
    public function search($restaurant_name)
    {
        return $this->RestaurantService->search($restaurant_name);
    }
    public function trash($id)
    {
        return $this->RestaurantService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->RestaurantService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->RestaurantService->delete($id);
    }
    public function getType($id)
    {
        return $this->RestaurantService->getType($id);
    }
    public function getMenu($id)
    {
        return $this->RestaurantService->getMenu($id);
    }
     public function getItem($id)
    {
        return $this->RestaurantService->getItem($id);
    }
    //_______________________________insert _____________________________//
    public function insertRestaurantItem(Request $request)
    {
        return $this->RestaurantService->insertRestaurantItem($request);
    }

}

