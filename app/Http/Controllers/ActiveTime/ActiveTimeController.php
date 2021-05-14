<?php

namespace App\Http\Controllers\ActiveTime;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActiveTime\ActiveTimeRequest;
use App\Service\ActiveTime\ActiveTimeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\GeneralTrait;

class ActiveTimeController extends Controller
{
    use GeneralTrait;
    private $ActiveTimeService;


    private $response;

    public function __construct(ActiveTimeService $ActiveTimeService,Response $response )
    {
        $this->ActiveTimeService=$ActiveTimeService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->ActiveTimeService->get();
    }

    public function  getById($id)
    {
        return $this->ActiveTimeService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->ActiveTimeService->getTrashed();
    }

    public function create(ActiveTimeRequest $request)
    {
        $response=$this->ActiveTimeService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(ActiveTimeRequest $request,$id)
    {
        $response=$this->ActiveTimeService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function trash($id)
    {
        $response= $this->ActiveTimeService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->ActiveTimeService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function delete($id)
    {
        $response = $this->ActiveTimeService->delete($id);
        return response($response, 200)
            ->header('Access-control-Allow-Origin', '*')
            ->header('Access-control-Allow-Methods', '*');
    }

}
