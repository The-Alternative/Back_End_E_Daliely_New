<?php

namespace App\Http\Controllers\Language;

use App\Http\Requests\LanguageRequest;
use App\Models\Language\Language;
use App\Http\controllers\controller;
use App\Service\languages\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\GeneralTrait;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
use Illuminate\Http\Response;


>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
class LanguageController extends Controller
{
    use GeneralTrait;
    private $response;
    private $LanguagesService;

<<<<<<< HEAD
<<<<<<< HEAD



    public function __construct(LanguageService $LanguagesService,Response  $response)
    {
        $this->response=$response;

=======
    public function __construct(LanguageService $LanguagesService,Response  $response)
    {
        $this->response=$response;
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
=======
    public function __construct(LanguageService $LanguagesService,Response  $response)
    {
        $this->response=$response;
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
        $this->LanguagesService=$LanguagesService;
        $this->response=$response;
    }

    public function getAll()
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

        $response=$this->LanguagesService->get();
        return  $response;


    }

    public function getById($id)
    {
        $response=$this->LanguagesService->getById($id);
        return  $response;
    }

<<<<<<< HEAD
    public function create(LanguageRequest  $request)
    {
        $response=$this->LanguagesService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function update(LanguageRequest $request,$id)
    {
        $response=$this->LanguagesService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }

    public function delete(LanguageRequest $request ,$id)
    {
        $response=$this->LanguagesService->delete($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }

    public function getTrashed()
    {
        $response= $this->LanguagesService->getTrashed();

        $response= $this->LanguagesService->get();
        return $response;
    }
//    public function getById($id )
//    {
//        $response= $this->LanguagesService->getById($id);
//        return $response;
//    }
//    public function getTrashed()
//    {
//        $response= $this->LanguagesService->getTrashed();
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }
//    public function create(LanguageRequest $request)
//    {
//        $response= $this->LanguagesService->create($request);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }
//    public function update(LanguageRequest $request,$id)
//    {
//        $response= $this->LanguagesService->update($request,$id);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }
    public function search($title)
    {
        $response= $this->LanguagesService->search($title);
=======
        $response= $this->LanguagesService->get();
=======
        $response= $this->LanguagesService->getAll();
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
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
<<<<<<< HEAD
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
=======
        $response= $this->LanguagesService->get();
=======
    public function getAll()
    {
        $response= $this->LanguagesService->getAll();
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
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
<<<<<<< HEAD
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
=======
        return response($response, 200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
        return response($response, 200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
<<<<<<< HEAD
<<<<<<< HEAD
    public function trash($id)
    {
        $response= $this->LanguagesService->trash($id);

=======
    public function restoreTrashed($id)
    {
        $response= $this->LanguagesService->restoreTrashed($id);
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
=======
    public function restoreTrashed($id)
    {
        $response= $this->LanguagesService->restoreTrashed($id);
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
=======
        return response($response, 200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
        return response($response, 200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
<<<<<<< HEAD
<<<<<<< HEAD

    public function restoreTrashed($id)
    {
        $response= $this->LanguagesService->restoreTrashed($id);
=======
    public function delete($id)
    {
        $response= $this->LanguagesService->delete($id);
<<<<<<< HEAD
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
=======
    public function delete($id)
    {
        $response= $this->LanguagesService->delete($id);
<<<<<<< HEAD
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
=======
        return response($response, 200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
        return response($response, 200);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }

<<<<<<< HEAD
<<<<<<< HEAD
//    public function trash($id)
//    {
//        $response= $this->LanguagesService->trash($id);

//    public function delete($id)
//    {
//        $response= $this->LanguagesService->delete($id);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }
//
//
//    public function search($name)
//    {
//        $response= $this->LanguagesService->search($name);
//        return response($response, 200)
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', '*');
//    }

=======
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
=======
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
}
