<?php

namespace App\Http\Controllers\Product;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Service\Products\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    use GeneralTrait;
    private $ProductService;
    private $response;

    public function __construct(ProductService $ProductService,Response  $response)
    {
        $this->ProductService=$ProductService;
        $this->response=$response;
    }
        public function getAll()
        {
         $response= $this->ProductService->getAll();
            return response($response, 200);
        }
        public function getProductByCategory($id)
        {
         $response= $this->ProductService->getProductByCategory($id);
            return response($response, 200);
        }
        public function getById($id)
        {
         $response= $this->ProductService->getById($id);
            return response($response, 200);
        }
        public function getTrashed()
        {
         $response= $this->ProductService->getTrashed();
         return response($response, 200);
        }
        public function create(ProductRequest $request)
        {
            $response= $this->ProductService->create($request);
            return response($response, 200);
        }
        public function update(ProductRequest $request,$pro_id)
        {
            $response= $this->ProductService->update($request,$pro_id);
            return response($response, 200);
        }
        public function search($title)
        {
            $response= $this->ProductService->search($title);
            return response($response, 200);
        }
        public function trash($id)
        {
            $response= $this->ProductService->trash($id);
            return response($response, 200);
        }
        public function restoreTrashed($id)
        {
            $response= $this->ProductService->restoreTrashed($id);
            return response($response, 200);
        }
        public function delete($id)
        {
            $response= $this->ProductService->delete($id);
            return response($response, 200);
        }
}
