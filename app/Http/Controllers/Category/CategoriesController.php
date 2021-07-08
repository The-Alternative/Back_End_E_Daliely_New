<?php

namespace App\Http\Controllers\Category;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Service\Categories\CategoryService;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    use GeneralTrait;
    private $CategoryService;
    private $response;

    public function __construct(CategoryService $CategoryService,Response  $response)
    {
        $this->CategoryService=$CategoryService;
        $this->response=$response;
        $this->middleware(['role:superadministrator|administrator|user']);
        $this->middleware(['permission:category-read'])->only('getAll','GetById');
        $this->middleware(['permission:category-create'])->only('create');
        $this->middleware(['permission:category-update'])->only('update');
        $this->middleware(['permission:category-delete'])->only(['trash','restoreTrashed','getTrashed']);
    }
    public function getAll()
    {
        return $this->CategoryService->getAll();
    }
    public function getById($id )
    {
        $response= $this->CategoryService->getById($id);
        return $response;    }
    public function getCategoryBySelf($id )
    {
        $response= $this->CategoryService->getCategoryBySelf($id);
        return $response;
    }
    public function getTrashed()
    {
     $response= $this->CategoryService->getTrashed();
        return $response;
    }
        public function create(CategoryRequest $request)
        {
            $response= $this->CategoryService->create($request);
            return $response;
        }
        public function update(CategoryRequest $request,$id)
        {
            $response= $this->CategoryService->update( $request,$id);
            return $response;
        }
        public function search($name)
        {
            $response= $this->CategoryService->search($name);
            return $response;
        }
        public function trash($id)
        {
            $response= $this->CategoryService->trash($id);
            return $response;
        }
        public function restoreTrashed($id)
        {
            $response= $this->CategoryService->restoreTrashed($id);
            return $response;
        }
        public function delete($id)
        {
            $response= $this->CategoryService->delete($id);
            return $response;
        }

}
