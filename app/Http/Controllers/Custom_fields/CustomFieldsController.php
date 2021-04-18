<?php

namespace App\Http\Controllers\Custom_fields;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Service\CustomFields\CustomFieldService;

use App\Traits\GeneralTrait;

use Illuminate\Http\Response;

class CustomFieldsController extends Controller
{

    use GeneralTrait;
    private $customfieldService;
    private $response;
    /**
     * @var CustomFieldService
     */


    public function __construct(CustomFieldService $CustomFieldService,Response  $response)
    {
        $this->customfieldService=$CustomFieldService;
        $this->response=$response;
    }
    public function getAll()
    {
        $response= $this->customfieldService->getAll();
        return response($response, 200);
    }
    public function getCustomFieldsByProduct($id)
    {
        $response= $this->customfieldService->getCustomFieldsByProduct($id);
        return response($response, 200);
    }
    public function getById($id)
    {
        $response= $this->customfieldService->getById($id);
        return response($response, 200);
    }
    public function getTrashed()
    {
        $response= $this->customfieldService->getTrashed();
        return response($response, 200);
    }
    public function create(ProductRequest $request)
    {
        $response= $this->customfieldService->create($request);
        return response($response, 200);
    }
    public function update(ProductRequest $request,$pro_id)
    {
        $response= $this->customfieldService->update($request,$pro_id);
        return response($response, 200);
    }
    public function search($title)
    {
        $response= $this->customfieldService->search($title);
        return response($response, 200);
    }
    public function trash($id)
    {
        $response= $this->customfieldService->trash($id);
        return response($response, 200);
    }
    public function restoreTrashed($id)
    {
        $response= $this->customfieldService->restoreTrashed($id);
        return response($response, 200);
    }
    public function delete($id)
    {
        $response= $this->customfieldService->delete($id);
        return response($response, 200);
    }
}
