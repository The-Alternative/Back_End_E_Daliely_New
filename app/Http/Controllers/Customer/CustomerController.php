<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Service\Customer\CustomerService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    use GeneralTrait;
    private $CustomerService;
    private $response;

    public function __construct(CustomerService $CustomerService,Response $response )
    {
        $this->CustomerService=$CustomerService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->CustomerService->get();
    }

    public function  getById($id)
    {
        return $this->CustomerService->getById($id);
    }

    public function getTrashed()
    {
        return  $this->CustomerService->getTrashed();
    }

    public function create(CustomerRequest $request)
    {
        $response=$this->CustomerService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(CustomerRequest $request,$id)
    {
        $response=$this->CustomerService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->CustomerService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->CustomerService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->CustomerService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function delete($id)
    {
        $response=$this->CustomerService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
}
