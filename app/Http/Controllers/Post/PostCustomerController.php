<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\PostCustomer\PostCustomerRequest;
use App\Models\Post\PostCustomer;
use App\Service\Post\PostCustomerService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostCustomerController extends Controller
{
    use GeneralTrait;
    private $PostCustomerService;
    private $response;

    public function __construct(PostCustomerService $PostCustomerService,Response $response )
    {
        $this->PostCustomerService=$PostCustomerService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->PostCustomerService->get();
    }
    public function  getById($id)
    {
        return $this->PostCustomerService->getById($id);
    }
    public function getTrashed()
    {
        return $this->PostCustomerService->getTrashed();
    }
    public function create(PostCustomerRequest $request)
    {
        return $this->PostCustomerService->create($request);
    }
    public function update(PostCustomerRequest $request,$id)
    {
        return $this->PostCustomerService->update($request,$id);
    }

    public function trash($id)
    {
        return $this->PostCustomerService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->PostCustomerService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->PostCustomerService->delete($id);
    }
}
