<?php
namespace App\Http\Controllers\Brand;

use App\Models\Brands\brands;
use App\Http\controllers\controller;
use App\Service\Brands\BrandsService;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Http\Requests\Brands\BrandRequest;
use Illuminate\Http\response;


class BrandController extends Controller
{
    use GeneralTrait;
    private $BrandsService;
<<<<<<< HEAD
<<<<<<< HEAD
    private $response;

    public function __construct(BrandsService $BrandsService,Response $response )
=======
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    public function __construct(BrandsService $BrandsService)
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    {
        $this->BrandsService=$BrandsService;
        $this->response=$response;
    }
<<<<<<< HEAD
<<<<<<< HEAD

    public function get()
    {
        $response=$this->BrandsService->get();
        return $response;
    }

    public function  getById($id)
    {

        $response=$this->BrandsService->getById($id);
       return $response;
    }

    public function getTrashed()
    {
        $response= $this->BrandsService->getTrashed();
        return $response;

    }
////
    public function create(BrandRequest $request)
    {
        $response=$this->BrandsService->create($request);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
    }
////
    public function update(BrandRequest $request,$id)
    {
        $response=$this->BrandsService->update($request,$id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');

    }
    public function search($name)
    {
        $response= $this->BrandsService->search($name);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function trash($id)
    {
        $response= $this->BrandsService->trash($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }

    public function restoreTrashed($id)
    {
        $response= $this->BrandsService->restoreTrashed($id);
        return response($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*');
    }
//
    public function delete($id)
    {
        $response=$this->BrandsService->delete($id);
        return  response($response,200)
            ->header('Access-control-Allow-Origin','*')
            ->header('Access-control-Allow-Methods','*');
=======
    public function getAllBrands()
    {
        $response=$this->BrandsService->getAllBrands();
        return  response($response,200);
    }
    public function  getBrandsById($id)
    {
        $response=$this->BrandsService->getBrandsById($id);
        return  response($response,200);
    }
    public function createNewBrands(Request $request)
    {
        $response=$this->BrandsService->createNewBrands($request);
        return  response($response,200);
    }
    public function updateBrand(Request $request,$id)
    {
=======
    public function getAllBrands()
    {
        $response=$this->BrandsService->getAllBrands();
        return  response($response,200);
    }
    public function  getBrandsById($id)
    {
        $response=$this->BrandsService->getBrandsById($id);
        return  response($response,200);
    }
    public function createNewBrands(Request $request)
    {
        $response=$this->BrandsService->createNewBrands($request);
        return  response($response,200);
    }
    public function updateBrand(Request $request,$id)
    {
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
        $response=$this->BrandsService->updateBrand($request,$id);
        return  response($response,200);
    }
    public function deleteBrand(Request $request ,$id)
    {
        $response=$this->BrandsService->deleteBrand($request,$id);
        return  response($response,200);
<<<<<<< HEAD
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
}
