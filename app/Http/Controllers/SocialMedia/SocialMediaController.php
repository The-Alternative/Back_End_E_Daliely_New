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
        $response=$this->SocialMediaService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(SocialMediaRequest $request,$id)
    {
        $response=$this->SocialMediaService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function trash($id)
    {
        $response= $this->SocialMediaService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->SocialMediaService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->SocialMediaService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }


}
