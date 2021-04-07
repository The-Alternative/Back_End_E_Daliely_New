<?php

namespace App\Http\Controllers\Language;

use App\Http\Requests\LanguageRequest;
use App\Models\Language\Language;
use App\Http\controllers\controller;
use App\Service\languages\LanguageService;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class LanguageController extends Controller
{
    use GeneralTrait;
    private $response;
    private $LanguagesService;

    public function __construct(LanguageService $LanguagesService,Response  $response)
    {
        $this->response=$response;
        $this->LanguagesService=$LanguagesService;
    }

    public function getAll()
    {
        $response= $this->LanguagesService->getAll();
        return $response;
    }
    public function getById($id )
    {
        $response= $this->LanguagesService->getById($id);
        return $response;
    }
    public function getTrashed()
    {
        $response= $this->LanguagesService->getTrashed();
        return response($response, 200);
    }
    public function create(LanguageRequest $request)
    {
        $response= $this->LanguagesService->create($request);
        return response($response, 200);
    }
    public function update(LanguageRequest $request,$id)
    {
        $response= $this->LanguagesService->update($request,$id);
        return response($response, 200);
    }
    public function search($title)
    {
        $response= $this->LanguagesService->search($title);
        return response($response, 200);
    }
    public function trash($id)
    {
        $response= $this->LanguagesService->trash($id);
        return response($response, 200);
    }
    public function restoreTrashed($id)
    {
        $response= $this->LanguagesService->restoreTrashed($id);
        return response($response, 200);
    }
    public function delete($id)
    {
        $response= $this->LanguagesService->delete($id);
        return response($response, 200);
    }

}
