<?php

namespace App\Http\Controllers\TypeOfRestaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeOfRestaurant\TypeOfRestaurantRequest;
use App\Service\TypeOfRestaurant\TypeOfRestaurantService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeOfRestaurantController extends Controller
{
    use GeneralTrait;
    private $TypeOfRestaurantService;
    private $response;

    public function __construct(TypeOfRestaurantService $TypeOfRestaurantService,Response $response )
    {
        $this->TypeOfRestaurantService=$TypeOfRestaurantService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->TypeOfRestaurantService->get();
    }
    public function  getById($id)
    {
        return $this->TypeOfRestaurantService->getById($id);
    }
    public function getTrashed()
    {
        return$this->TypeOfRestaurantService->getTrashed();
    }
    public function create(TypeOfRestaurantRequest $request)
    {
        return $this->TypeOfRestaurantService->create($request);
    }
    public function update(TypeOfRestaurantRequest $request,$id)
    {
        return $this->TypeOfRestaurantService->update($request,$id);
    }
    public function search($restaurant_type_title)
    {
        return $this->TypeOfRestaurantService->search($restaurant_type_title);
    }
    public function trash($id)
    {
        return $this->TypeOfRestaurantService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->TypeOfRestaurantService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->TypeOfRestaurantService->delete($id);
    }
}
