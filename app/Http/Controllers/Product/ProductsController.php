<?php

namespace App\Http\Controllers\Product;

use App\Service\Products\ProductService;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    use GeneralTrait;
    private $ProductService;
    private $response;

    public function __construct(ProductService $ProductService,Response  $response)
    {
        $this->ProductService=$ProductService;
        $this->response=$response;
        $this->middleware('role:superadministrator|user');
//        $this->middleware('role:user', ['except' => ['creat','update','delete']]);
//        $this->middleware(['permission:product_read'])->only(['getAll','getById']);
//        $this->middleware(['permission:product_create'])->only('create');
        $this->middleware(['permission:product_update'])->only('update');
        $this->middleware(['permission:product_delete'])->only(['trash','restoreTrashed','getTrashed']);

    }
        public function getAll()
        {
//            if (Auth::user()->hasPermission('product_read')){
            $response = $this->ProductService->getAll();
            return $response;
//        }else{
//            return response();
//            }
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
