<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Service\Stores\StoresProductsService;
use Illuminate\Http\Response;

class StoresProductsController extends Controller
{
    use GeneralTrait;
    private $response;
    private $StoresProductsService;
    public function __construct(StoresProductsService  $StoresProducts,Response  $response)
    {
        $this->StoresProductsService=$StoresProducts;
        $this->response=$response;
    }
    public function insertProductToStore(Request $request)
    {
        $response= $this->StoresProductsService->insertProductToStore($request);
        return $response;
    }
    public function updateProductInStore(Request $request,$id)
    {
        $response= $this->StoresProductsService->updateProductInStore($request,$id);
        return $response;
    }
    public function viewStoresHasProduct($id)
    {
        $response= $this->StoresProductsService->viewStoresHasProduct($id);
        return $response;
    }
    public function viewProductsInStore($id)
    {
        $response= $this->StoresProductsService->viewProductsInStore($id);
        return $response;
    }
    public function hiddenProductByQuantity($id)
    {
        $response= $this->StoresProductsService->hiddenProductByQuantity($id);
        return $response;
    }
    public function rangeOfPrice($id)
    {
        $response= $this->StoresProductsService->rangeOfPrice($id);
        return $response;
    }
}
