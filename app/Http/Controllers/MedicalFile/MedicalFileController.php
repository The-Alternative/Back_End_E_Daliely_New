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
        return $this->MedicalFileService->create($request);
    }
    public function update(MedicalFileRequest $request,$id)
    {
        return $this->MedicalFileService->update($request,$id);
    }
    public function trash($id)
    {
        return $this->MedicalFileService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->MedicalFileService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->MedicalFileService->delete($id);
    }
}
