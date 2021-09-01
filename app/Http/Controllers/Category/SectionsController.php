<?php

namespace App\Http\Controllers\Category;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Service\Categories\SectionService;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;

class SectionsController extends Controller
{
    use GeneralTrait;
    private $sectionService;

    /* ProductsController constructor.
    */
    public function __construct(SectionService $SectionService)
    {
        $this->sectionService=$SectionService;
    }
    public function getAll()
    {
        return $this->sectionService->getAll();
    }
    public function getById($id )
    {
        return $this->sectionService->getById($id);
    }
    public function getCategoryBySection()
    {
        return $this->sectionService->getCategoryBySection();
    }
    public function getTrashed()
    {
        return $this->sectionService->getTrashed();
    }
    public function create(Request $request)
    {
        return $this->sectionService->create($request);
    }
    public function update(Request $request,$id)
    {
        return $this->sectionService->update($request,$id);
    }
    public function search($name)
    {
        return $this->sectionService->search($name);
    }
    public function trash($id)
    {
        return $this->sectionService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->sectionService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->sectionService->delete($id);
    }

}

