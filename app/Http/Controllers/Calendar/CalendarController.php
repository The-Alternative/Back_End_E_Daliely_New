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

     public function create(CalendarRequest $request)
    {
        return   $response=$this->CalendarService->create($request);
    }

    public function update(CalendarRequest $request,$id)
    {
        return $response=$this->CalendarService->update($request,$id);
    }

    public function trash($id)
    {
        return   $response= $this->CalendarService->trash($id);
    }

    public function restoreTrashed($id)
    {
        return  $response= $this->CalendarService->restoreTrashed($id);
    }

    public function delete($id)
    {
        return   $response = $this->CalendarService->delete($id);
    }
}
