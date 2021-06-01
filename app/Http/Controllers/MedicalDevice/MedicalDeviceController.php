<?php

namespace App\Http\Controllers\MedicalDevice;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalDevice\MedicalDeviceRequest;
use App\Service\MedicalDevice\MedicalDeviceService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MedicalDeviceController extends Controller
{

    use GeneralTrait;
    private $MedicalDeviceService;
    private $response;

    public function __construct(MedicalDeviceService $MedicalDeviceService,Response $response )
    {
        $this->MedicalDeviceService =$MedicalDeviceService;
        $this->response=$response;
    }
    public function get()
    {
        return$this->MedicalDeviceService->get();
    }
    public function  getById($id)
    {
        return $this->MedicalDeviceService->getById($id);
    }
    public function getTrashed()
    {
        return$this->MedicalDeviceService->getTrashed();
    }
    public function create(MedicalDeviceRequest $request)
    {
        return$this->MedicalDeviceService->create($request);
    }
    public function update(MedicalDeviceRequest $request,$id)
    {
        return $this->MedicalDeviceService->update($request,$id);
    }
    public function search($name)
    {
        return $this->MedicalDeviceService->search($name);
    }
    public function trash($id)
    {
        return $this->MedicalDeviceService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->MedicalDeviceService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return  $this->MedicalDeviceService->delete($id);
    }
    public function getdoctor($medical_device_name)
    {
        return  $this->MedicalDeviceService->doctormedicaldevice($medical_device_name);
    }

}
