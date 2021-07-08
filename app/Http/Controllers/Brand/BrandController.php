<?php
namespace App\Http\Controllers\Brand;

use App\Http\Requests\Brands\BrandRequest;
use App\Http\controllers\controller;
use App\Service\Brands\BrandsService;
use App\Traits\GeneralTrait;
use Symfony\Component\HttpFoundation\Request;

class BrandController extends Controller
{
    use GeneralTrait;
    private $BrandsService;
    public function __construct(BrandsService $BrandsService)
    {
        $this->BrandsService=$BrandsService;
        $this->middleware(['role:superadministrator|administrator|user']);
        $this->middleware(['permission:brand-read'])->only('getAll','GetById');
        $this->middleware(['permission:brand-create'])->only('create');
        $this->middleware(['permission:brand-update'])->only('update');
        $this->middleware(['permission:brand-delete'])->only(['trash','restoreTrashed','getTrashed']);
    }
    public function getAll()
    {
        $response= $this->BrandsService->getAll();
        return $response;
    }
    public function getById($id)
    {
        $response= $this->BrandsService->getById($id);
        return $response;
    }
    public function getTrashed()
    {
        $response= $this->BrandsService->getTrashed();
        return $response;
    }
    public function create(Request $request)
    {
        $response= $this->BrandsService->create($request);
        return $response;
    }
    public function update(Request $request,$pro_id)
    {
        $response= $this->BrandsService->update($request,$pro_id);
        return $response;
    }
    public function search($title)
    {
        $response= $this->BrandsService->search($title);
        return $response;
    }
    public function trash($id)
    {
        $response= $this->BrandsService->trash($id);
        return $response;
    }
    public function restoreTrashed($id)
    {
        $response= $this->BrandsService->restoreTrashed($id);
        return $response;
    }
    public function delete($id)
    {
        $response= $this->BrandsService->delete($id);
        return $response;
    }
}
