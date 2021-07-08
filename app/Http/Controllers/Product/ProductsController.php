<?php

namespace App\Http\Controllers\Product;

use App\Service\Products\ProductService;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laratrust\Laratrust;
use Laratrust\Traits\LaratrustUserTrait;

class ProductsController extends Controller
{
    use GeneralTrait;
    use LaratrustUserTrait;
    private $ProductService;
    private $response;
    private $laraturst;

    public function __construct(ProductService $ProductService,Response  $response,Laratrust $laraturst)
    {
        $this->ProductService=$ProductService;
        $this->response=$response;
        $this->laratrustClass=$laraturst;
        $this->middleware(['role:superadministrator|administrator|user']);
        $this->middleware(['permission:product-read'])->only('getAll','GetById');
        $this->middleware(['permission:product-create'])->only('create');
        $this->middleware(['permission:product-update'])->only('update');
        $this->middleware(['permission:product-delete'])->only(['trash','restoreTrashed','getTrashed']);
    }
        public function getAll()
        {
            $response = $this->ProductService->getAll();
            return $response;
        }
        public function getProductByCategory($id)
        {
         $response= $this->ProductService->getProductByCategory($id);
            return $response;
        }
        public function getById($id)
        {
         $response= $this->ProductService->getById($id);
            return $response;
        }
        public function getTrashed()
        {
         $response= $this->ProductService->getTrashed();
            return $response;
        }
        public function create(Request $request)
        {
            $response= $this->ProductService->create($request);
            return $response;
        }
        public function update(ProductRequest $request,$pro_id)
        {
            $response= $this->ProductService->update($request,$pro_id);
            return $response;
        }
        public function search($title)
        {
            $response= $this->ProductService->search($title);
            return $response;
        }
        public function trash($id)
        {
            $response= $this->ProductService->trash($id);
            return $response;
        }
        public function restoreTrashed($id)
        {
            $response= $this->ProductService->restoreTrashed($id);
            return $response;
        }
        public function delete($id)
        {
            $response= $this->ProductService->delete($id);
            return $response;
        }
}
