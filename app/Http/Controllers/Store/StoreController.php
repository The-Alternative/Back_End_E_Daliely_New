<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\Store\StoreRequest;
use App\Http\Requests\StoreProduct\StoreProductRequest;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Stores\StoreService;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    use GeneralTrait;
    private $StoreService;

    public function __construct(StoreService $StoreService  )
    {
        $this->middleware(['role:superadministrator|administrator|user']);
        $this->middleware(['permission:store-read'])->only('getAll','GetById');
        $this->middleware(['permission:store-create'])->only('create');
        $this->middleware(['permission:store-update'])->only('update');
        $this->middleware(['permission:store-delete'])->only(['trash','restoreTrashed','getTrashed']);
        $this->StoreService=$StoreService;
    }
    public function getAll()
    {
        return $this->StoreService->getAll();
    }
    public function getById($id)
    {
        return $this->StoreService->getById($id);
    }
    public function getTrashed()
    {
        return $this->StoreService->getTrashed();
    }
    public function create(Request $request)
    {
        return $this->StoreService->create($request);
    }
    public function update(Request $request,$id)
    {
        return  $this->StoreService->update( $request,$id);
    }
    public function search($name)
    {
        return $this->StoreService->search($name);

    }
    public function trash($id)
    {
        return $this->StoreService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->StoreService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->StoreService->delete($id);
    }
    public function getSectionInStore($id)
    {
        return  $this->StoreService->getSectionInStore($id);
    }
}
