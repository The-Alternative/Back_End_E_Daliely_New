<?php
namespace App\Http\Controllers\Brand;

use App\Models\Brands\brands;
use App\Http\controllers\controller;
use App\Service\Brands\BrandsService;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use GeneralTrait;
    private $BrandsService;
    public function __construct(BrandsService $BrandsService)
    {

        $this->BrandsService=$BrandsService;
    }
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
        $response=$this->BrandsService->updateBrand($request,$id);
        return  response($response,200);
    }
    public function deleteBrand(Request $request ,$id)
    {
        $response=$this->BrandsService->deleteBrand($request,$id);
        return  response($response,200);
    }
}
