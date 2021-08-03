<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Service\Post\PostService;
use App\Traits\GeneralTrait;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    use GeneralTrait;
    private $PostService;
    private $response;

    public function __construct(PostService $PostService,Response $response )
    {
        $this->PostService=$PostService;
        $this->response=$response;
    }
    public function get()
    {
        return $this->PostService->get();
    }
    public function  getById($id)
    {
        return $this->PostService->getById($id);
    }
    public function getTrashed()
    {
        return$this->PostService->getTrashed();
    }
    public function create(PostRequest $request)
    {
        return $this->PostService->create($request);
    }
    public function update(PostRequest $request,$id)
    {
        return $this->PostService->update($request,$id);
    }
    public function search($name)
    {
        return $this->PostService->search($name);
    }
    public function trash($id)
    {
        return $this->PostService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->PostService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->PostService->delete($id);
    }

}
