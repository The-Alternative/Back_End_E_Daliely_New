<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Calendar\CalendarRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\GeneralTrait;
use App\Service\Calendar\CalendarService;

class CalendarController extends Controller
{
    use GeneralTrait;
    private $CalendarService;

    private $response;

    public function __construct(CalendarService $CalendarService,Response $response )
    {
        $this->CalendarService=$CalendarService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->CalendarService->get();
    }

    public function  getById($id)
    {
        return $this->CalendarService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->CalendarService->getTrashed();
    }

    public function create(CalendarRequest $request)
    {
        $response=$this->CalendarService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(CalendarRequest $request,$id)
    {
        $response=$this->CalendarService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
//    public function search($name)
//    {
//        $response= $this->CalendarService->search($name);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }

    public function trash($id)
    {
        $response= $this->CalendarService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->CalendarService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response = $this->CalendarService->delete($id);
        return response($response, 200)
            ->header('Access-control-Allow-Origin', '*')
            ->header('Access-control-Allow-Methods', '*');
    }
}
