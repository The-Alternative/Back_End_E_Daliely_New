<?php

namespace App\Http\Controllers\MedicalFile;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalFile\MedicalFileRequest;
use App\Service\MedicalFile\MedicalFileService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MedicalFileController extends Controller
{
    use GeneralTrait;
    private $MedicalFileService;
    private $response;

    public function __construct(MedicalFileService $MedicalFileService,Response $response )
    {
        $this->MedicalFileService=$MedicalFileService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->MedicalFileService->get();
    }

    public function  getById($id)
    {
        return $this->MedicalFileService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->MedicalFileService->getTrashed();
    }

    public function create(MedicalFileRequest $request)
    {
        $response=$this->MedicalFileService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(MedicalFileRequest $request,$id)
    {
        $response=$this->MedicalFileService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function trash($id)
    {
        $response= $this->MedicalFileService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->MedicalFileService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function delete($id)
    {
        $response=$this->MedicalFileService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
