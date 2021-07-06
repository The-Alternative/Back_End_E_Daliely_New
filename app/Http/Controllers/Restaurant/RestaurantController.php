<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\RestaurantRequest;
use App\Service\Restaurant\RestaurantService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    use GeneralTrait;
    private $RestaurantService;
    private $response;

    public function __construct(RestaurantService $RestaurantService,Response $response )
    {
        $this->RestaurantService=$RestaurantService;
        $this->response=$response;
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

}
