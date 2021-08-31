<?php

namespace App\Http\Controllers\Custom_fields;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Service\CustomFields\CustomFieldService;

use App\Traits\GeneralTrait;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomFieldsController extends Controller
{
    use GeneralTrait;
    private $customfieldService;
    private $response;
    /**
     *
     * @param CustomFieldService $CustomFieldService
     * @param Response $response
     */
    public function __construct(CustomFieldService $CustomFieldService,Response  $response)
    {
        $this->customfieldService=$CustomFieldService;
        $this->response=$response;
//        $this->middleware(['role:superadministrator|administrator|user']);
//        $this->middleware(['permission:custom_field-read'])->only('getAll','GetById');
//        $this->middleware(['permission:custom_field-create'])->only('create');
//        $this->middleware(['permission:custom_field-update'])->only('update');
//        $this->middleware(['permission:custom_field-delete'])->only(['trash','restoreTrashed','getTrashed']);
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
    public function create(Request $request)
    {
        return $this->customfieldService->create($request);
    }
    public function update(Request $request,$id)
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
}
