<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\PostStore\PostStoreRequest;
use App\Service\Post\PostCustomerService;
use App\Service\Post\PostStoreService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostStoreController extends Controller
{
    use GeneralTrait;
    private $PostStoreService;
    private $response;

    public function __construct(PostStoreService $PostStoreService,Response $response )
    {
        $this->PostStoreService=$PostStoreService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->PostStoreService->get();
    }
    public function  getById($id)
    {
        return $this->PostStoreService->getById($id);
    }
    public function getTrashed()
    {
        return$this->PostStoreService->getTrashed();
    }
    public function create(PostStoreRequest $request)
    {
        return $this->PostStoreService->create($request);
    }
    public function update(PostStoreRequest $request,$id)
    {
        return $this->PostStoreService->update($request,$id);
    }

    public function trash($id)
    {
        return $this->PostStoreService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->PostStoreService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->PostStoreService->delete($id);
    }
}
