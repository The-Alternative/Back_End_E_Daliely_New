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
    use LaratrustUserTrait;
    private $ProductService;
    private $laraturst;

    public function __construct(ProductService $ProductService,Laratrust $laraturst)
    {
        $this->ProductService=$ProductService;
        $this->laratrustClass=$laraturst;
        $this->middleware(['role:superadministrator|administrator|user']);
        $this->middleware(['permission:product-read'])->only('getAll','getById');
        $this->middleware(['permission:product-create'])->only('create');
        $this->middleware(['permission:product-update'])->only('update');
        $this->middleware(['permission:product-delete'])->only(['trash','restoreTrashed','getTrashed']);
    }
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
        public function create(Request $request)
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
}
