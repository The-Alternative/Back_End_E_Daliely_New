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
    private $response;

    /* ProductsController constructor.
    */
    public function __construct(SectionService $SectionService,Response  $response)
    {
        $this->sectionService=$SectionService;
        $this->response=$response;
    }
    public function getAll()
    {
        $response= $this->sectionService->getAll();
        return $response;
    }
    public function getById($id )
    {
        $response= $this->sectionService->getById($id);
        return $response;
    }
    public function getCategoryBySection()
    {
        $response= $this->sectionService->getCategoryBySection();
        return $response;
    }
    public function getTrashed()
    {
        $response= $this->sectionService->getTrashed();
        return $response;
    }
    public function create(Request $request)
    {
        $response= $this->sectionService->create($request);
        return $response;
    }
    public function update(Request $request,$id)
    {
        $response= $this->sectionService->update($request,$id);
        return $response;
    }
    public function search($name)
    {
        $response= $this->sectionService->search($name);
        return $response;
    }
    public function trash($id)
    {
        $response= $this->sectionService->trash($id);
        return $response;
    }
    public function restoreTrashed($id)
    {
        $response= $this->sectionService->restoreTrashed($id);
        return $response;
    }
    public function delete($id)
    {
        $response= $this->sectionService->delete($id);
        return $response;
    }

}

