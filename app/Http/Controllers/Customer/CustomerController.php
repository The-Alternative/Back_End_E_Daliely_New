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

    public function create(CustomerRequest $request)
    {
        return $this->CustomerService->create($request);
    }

    public function update(CustomerRequest $request,$id)
    {
        return $this->CustomerService->update($request,$id);
    }
    public function search($name)
    {
        return $this->CustomerService->search($name);
    }

    public function trash($id)
    {
        return $this->CustomerService->trash($id);
    }
    public function getTrashed()
    {
        return  $this->CustomerService->getTrashed();
    }

    public function restoreTrashed($id)
    {
        return $this->CustomerService->restoreTrashed($id);
    }

    public function delete($id)
    {
        return $this->CustomerService->delete($id);
    }
}
