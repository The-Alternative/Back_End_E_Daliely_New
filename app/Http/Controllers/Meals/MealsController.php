<?php

namespace App\Http\Controllers\Meals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meals\MealsRequest;
use App\Service\Meals\MealsService;
use Illuminate\Http\Request;

class MealsController extends Controller
{
    private $MealsService;


    public function __construct(MealsService $MealsService)
    {
        $this->MealsService=$MealsService;
    }
    public function get()
    {
        return $this->MealsService->get();
    }
    public function  getById($id)
    {
        return $this->MealsService->getById($id);
    }
    public function getTrashed()
    {
        return$this->MealsService->getTrashed();
    }
    public function create(MealsRequest $request)
    {
        return $this->MealsService->create($request);
    }
    public function update(MealsRequest $request,$id)
    {
        return $this->MealsService->update($request,$id);
    }
    public function search($restaurant_type_title)
    {
        return $this->MealsService->search($restaurant_type_title);
    }
    public function trash($id)
    {
        return $this->MealsService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->MealsService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->MealsService->delete($id);
    }
}
