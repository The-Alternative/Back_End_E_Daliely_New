<?php

namespace App\Http\Controllers\Custom_fields;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomField\CustomFieldRequest;
use App\Service\CustomFields\CustomFieldService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomFieldsController extends Controller
{
    use GeneralTrait;
    private $customfieldService;
    /**
     *
     * @param CustomFieldService $CustomFieldService
     * @param Response $response
     */
    public function __construct(CustomFieldService $CustomFieldService)
    {
        $this->customfieldService=$CustomFieldService;
    }
    public function getAll()
    {
        return $this->customfieldService->getAll();
    }
    public function getCustomFieldsByProduct($id)
    {
        return $this->customfieldService->getCustomFieldsByProduct($id);
    }
    public function getById($id)
    {
        return $this->customfieldService->getById($id);
    }
    public function getTrashed()
    {
        return $this->customfieldService->getTrashed();
    }
    public function create(CustomFieldRequest $request)
    {
        return $this->customfieldService->create($request);
    }
    public function update(CustomFieldRequest $request,$id)
    {
        return $this->customfieldService->update($request, $id);
    }
    public function search($title)
    {
        return $this->customfieldService->search($title);
    }
    public function trash($id)
    {
        return $this->customfieldService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->customfieldService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->customfieldService->delete($id);
    }
    public function upload(Request $request)
    {
        return $this->customfieldService->upload($request);
    }
    public function update_upload(Request $request,$id)
    {
        return $this->customfieldService->update_upload($request,$id);
    }
}
