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
        $response=$this->SpecialtyService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
    public function update(SpecialtyRequest $request,$id)
    {
        $response=$this->SpecialtyService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
    public function search($name)
    {
        $response= $this->SpecialtyService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function trash($id)
    {
        $response= $this->SpecialtyService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function restoreTrashed($id)
    {
        $response= $this->SpecialtyService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
    public function delete($id)
    {
        $response=$this->SpecialtyService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
