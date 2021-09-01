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
    }
    public function getAll()
    {
        return $this->CategoryService->getAll();
    }
    public function getById($id )
    {
        return $this->CategoryService->getById($id);
    }
    public function getCategoryBySelf($id )
    {
        return $this->CategoryService->getCategoryBySelf($id);
    }
    public function getTrashed()
    {
     return $this->CategoryService->getTrashed();
    }
    public function create(CategoryRequest $request)
    {
        return $this->CategoryService->create($request);
    }
    public function update(CategoryRequest $request,$id)
    {
        return $this->CategoryService->update( $request,$id);
    }
    public function search($name)
    {
        return $this->CategoryService->search($name);
    }
    public function trash($id)
    {
        return $this->CategoryService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->CategoryService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->CategoryService->delete($id);
    }
}
