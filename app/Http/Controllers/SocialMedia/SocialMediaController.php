<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMedia\SocialMediaRequest;
use App\Service\SocialMedia\SocialMediaService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialMediaController extends Controller
{
    use GeneralTrait;
    private $SocialMediaService;
    private $response;

    public function __construct(SocialMediaService $SocialMediaService,Response $response )
    {
        $this->SocialMediaService=$SocialMediaService;
        $this->response=$response;
    }
    public function get()
    {
        return$this->SocialMediaService->get();
    }
    public function  getById($id)
    {
        return $this->SocialMediaService->getById($id);
    }
    public function getTrashed()
    {
        return $this->SocialMediaService->getTrashed();
    }
    public function create(SocialMediaRequest $request)
    {
        return $this->SocialMediaService->create($request);
    }
    public function update(SocialMediaRequest $request,$id)
    {
        return $this->SocialMediaService->update($request,$id);
    }
    public function trash($id)
    {
        return $this->SocialMediaService->trash($id);
    }
    public function restoreTrashed($id)
    {
        return $this->SocialMediaService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->SocialMediaService->delete($id);
    }
}
