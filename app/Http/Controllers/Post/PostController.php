<?php

namespace App\Http\Controllers\Post;
use app\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Service\Post\PostService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Response;

class PostController extends Controller
{
    private $PostService;

    public function __construct(PostService $PostService)
    {
        $this->PostService=$PostService;
    }
    public function get()
    {
        return $this->PostService->get();
    }
    public function  getById($id)
    {
        return $this->PostService->getById($id);
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

    public function getOffers($store_Id)
    {
        return $this->PostService->getOffers($store_Id);

    }
  public function getInteractions($post_Id)
    {
        return $this->PostService->getInteractions($post_Id);
    }

    public function getTrashed()
    {
        return $this->PostService->getTrashed();
    }
    public function getAd()
    {
         return $this->PostService->getAd();
    }
}
