<?php

namespace App\Http\Controllers\MealType;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealType\MealTypeRequest;
use App\Service\MealType\MealTypeService;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    private $MealTypeService;


    public function __construct(MealTypeService $MealTypeService)
    {
        $this->MealTypeService=$MealTypeService;
    }
    public function get()
    {
        return $this->MealTypeService->get();
    }
    public function  getById($id)
    {
        return $this->MealTypeService->getById($id);
    }
    public function getTrashed()
    {
        return$this->MealTypeService->getTrashed();
    }
    public function create(MealTypeRequest $request)
    {
        return $this->MealTypeService->create($request);
    }
    public function update(MealTypeRequest $request,$id)
    {
        return $this->MealTypeService->update($request,$id);
    }
    public function search($meal_type_name)
    {
        return $this->MealTypeService->search($meal_type_name);
    }
    public function trash($id)
    {
        return $this->MealTypeService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->MealTypeService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->MealTypeService->delete($id);
    }
}
