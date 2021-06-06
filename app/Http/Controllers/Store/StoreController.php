<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\Store\StoreRequest;
use App\Traits\GeneralTrait;
use App\Http\controllers\controller;
use Illuminate\Http\Request;
use App\Service\Stores\StoreService;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    use GeneralTrait;
    private $StoreService;
    private $response;

    /* ProductsController constructor.
    */
    public function __construct(StoreService $StoreService,Response  $response)
    {
        $this->StoreService=$StoreService;
        $this->response=$response;
    }
//
//"files": [
//"App/Helpers/GeneralHelpers.php"
//]
    public function getAll()
    {
        $response= $this->StoreService->getAll();
//        return response($response, 200);
        return $response;
    }
    public function getById($id)
    {
        $response= $this->StoreService->getById($id);
        return $response;
    }
    public function getTrashed()
    {
        $response= $this->StoreService->getTrashed();
        return $response;
    }
    public function create(StoreRequest $request)
    {
        $response= $this->StoreService->create($request);
        return $response;
    }
    public function update(Request $request,$id)
    {
        $response= $this->StoreService->update( $request,$id);
        return $response;
    }
    public function search($name)
    {
        $response= $this->StoreService->search($name);
        return $response;
    }
    public function trash($id)
    {
        $response= $this->StoreService->trash($id);
        return $response;
    }
    public function restoreTrashed($id)
    {
        $response= $this->StoreService->restoreTrashed($id);
        return $response;
    }
    public function delete($id)
    {
        $response= $this->StoreService->delete($id);
        return $response;
    }
    public function getSectionInStore($id)
    {
        $response= $this->StoreService->getSectionInStore($id);
        return $response;
    }
}
