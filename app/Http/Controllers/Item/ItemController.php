<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\ItemRequest;
use App\Service\Item\ItemService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    use GeneralTrait;
    private $ItemService;
    private $response;

    public function __construct(ItemService $ItemService,Response $response )
    {
        $this->ItemService=$ItemService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->ItemService->get();
    }
    public function  getById($id)
    {
        return $this->ItemService->getById($id);
    }
    public function getTrashed()
    {
        return$this->ItemService->getTrashed();
    }
    public function create(ItemRequest $request)
    {
        return $this->ItemService->create($request);
    }
    public function update(ItemRequest $request,$id)
    {
        return $this->ItemService->update($request,$id);
    }
    public function search($name)
    {
        return $this->ItemService->search($name);
    }
    public function trash($id)
    {
        return $this->ItemService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->ItemService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->ItemService->delete($id);
    }
    public function getRestaurant($id)
    {
        return $this->ItemService->getRestaurant($id);
    }
    public function getCategory($id)
    {
        return $this->ItemService->getCategory($id);
    }
    public function getProduct($id)
    {
        return $this->ItemService->getProduct($id);
    }

}
