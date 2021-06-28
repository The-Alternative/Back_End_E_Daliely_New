<?php

namespace App\Http\Controllers\Product;

use App\Service\Products\ProductService;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
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
