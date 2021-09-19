<?php
namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brands\BrandRequest;
use App\Models\Brands\Brand;
use App\Service\Brands\BrandsService;
use App\Traits\GeneralTrait;
use Symfony\Component\HttpFoundation\Request;

class BrandController
{
    use GeneralTrait;
    private $BrandsService;
    public function __construct(BrandsService $BrandsService)
    {
        $this->BrandsService=$BrandsService;
    }
    public function list()
    {
        return $this->BrandsService->list();
    }
    public function getAll()
    {
        return $this->BrandsService->getAll();
    }
    public function getById($id)
    {
        return $this->BrandsService->getById($id);
    }
    public function getTrashed()
    {
        return $this->BrandsService->getTrashed();
    }
    public function create(BrandRequest $request)
    {
        return $this->BrandsService->create($request);
    }
    public function update(BrandRequest $request,$id)
    {
        return $this->BrandsService->update($request,$id);
    }
    public function search($title)
    {
        return $this->BrandsService->search($title);
    }
    public function trash($id)
    {
        return $this->BrandsService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->BrandsService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->BrandsService->delete($id);
    }
    public function upload(Request $request)
    {
        return $this->BrandsService->upload($request);
    }
    public function update_upload(Request $request,$id)
    {
        return $this->BrandsService->update_upload($request,$id);
    }
}
