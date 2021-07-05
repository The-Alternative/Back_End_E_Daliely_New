<?php

namespace App\Http\Controllers\RestaurantProduct;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantProduct\RestaurantProductRequest;
use App\Service\RestaurantProduct\RestaurantProductService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantProductController extends Controller
{
    use GeneralTrait;
    private $RestaurantProductService;
    private $response;

    public function __construct(RestaurantProductService $RestaurantProduct,Response $response )
    {
        $this->RestaurantProductService=$RestaurantProduct;
        $this->response=$response;
    }
    public function get()
    {
        return $this->RestaurantProductService->get();
    }
    public function  getById($id)
    {
        return $this->RestaurantProductService->getById($id);
    }
    public function getTrashed()
    {
        return$this->RestaurantProductService->getTrashed();
    }
    public function create(RestaurantProductRequest $request)
    {
        return $this->RestaurantProductService->create($request);
    }
    public function update(RestaurantProductRequest $request,$id)
    {
        return $this->RestaurantProductService->update($request,$id);
    }
    public function search($name)
    {
        return $this->RestaurantProductService->search($name);
    }
    public function trash($id)
    {
        return $this->RestaurantProductService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->RestaurantProductService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->RestaurantProductService->delete($id);
    }
}
