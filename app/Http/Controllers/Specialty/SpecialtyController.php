<?php

namespace App\Http\Controllers\Specialty;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialty\SpecialtyRequest;
use App\Service\Specialty\SpecialtyService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecialtyController extends Controller
{
    use GeneralTrait;
    private $SpecialtyService;
    private $response;

    public function __construct(SpecialtyService $SpecialtyService,Response $response )
    {
        $this->SpecialtyService =$SpecialtyService;
        $this->response=$response;
    }
    public function get()
    {
        return$this->SpecialtyService->get();
    }
    public function  getById($id)
    {
        return $this->SpecialtyService->getById($id);
    }
    public function getTrashed()
    {
        return $this->SpecialtyService->getTrashed();
    }
    public function create(SpecialtyRequest $request)
    {
        return $this->SpecialtyService->create($request);
    }
    public function update(SpecialtyRequest $request,$id)
    {
        return $this->SpecialtyService->update($request,$id);
    }
    public function search($name)
    {
        return $this->SpecialtyService->search($name);
    }
    public function trash($id)
    {
        return $this->SpecialtyService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->SpecialtyService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return  $this->SpecialtyService->delete($id);
    }
}
