<?php

namespace App\Http\Controllers\Product;

use App\Service\Products\ProductService;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Laratrust\Laratrust;
use Laratrust\Traits\LaratrustUserTrait;

class ProductsController extends Controller
{
    use GeneralTrait;
    private $ProductService;

    public function __construct(ProductService $ProductService)
    {
        $this->ProductService=$ProductService;
    }
    /*** this function for dashboard ***/
        public function dashgetAll()
        {
            return $this->ProductService->dashgetAll();
        }
        public function dashgetById($id)
        {
            return $this->ProductService->dashgetById($id);
        }
        /** ___________________________________ **/
        public function getAll()
        {
            return $this->ProductService->getAll();
        }
        public function getProductByCategory($id)
        {
            return $this->ProductService->getProductByCategory($id);
        }
        public function getById($id)
        {
            return $this->ProductService->getById($id);
        }
        public function getTrashed()
        {
            return $this->ProductService->getTrashed();
        }
        public function create(ProductRequest $request)
        {
            return $this->ProductService->create($request);
        }
        public function update(ProductRequest $request,$id)
        {
            return $this->ProductService->update($request,$id);
        }
        public function search($title)
        {
            return $this->ProductService->search($title);
        }
        public function trash($id)
        {
            return $this->ProductService->trash($id);
        }
        public function restoreTrashed($id)
        {
            return $this->ProductService->restoreTrashed($id);
        }
        public function delete($id)
        {
            return $this->ProductService->delete($id);
        }
        public function uploadMultiple(Request $request ,$id)
        {
            return $this->ProductService->uploadMultiple($request ,$id);
        }
        public function filter(Request $request )
        {
            return $this->ProductService->filter($request );
        }
        public function upload(Request $request,$id )
        {
            return $this->ProductService->upload($request,$id );
        }
}
