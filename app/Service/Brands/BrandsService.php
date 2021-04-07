<?php


namespace App\Service\Brands;

use App\Models\Brands\Brands;
 use  App\Http\Controllers\LangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneralTrait;
use App\Http\Requests\Brands\BrandRequest;
use phpDocumentor\Reflection\Types\This;

use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;

class BrandsService
{
    private $BrandModel;
    private $lang;
    use GeneralTrait;

    public function __construct(Brands $brand)
    {

        $this->BrandModel=$brand;
    }

    public function getAllBrands()
    {

        return $this->BrandModel::all();

//        $brand=DB::table('brands')
//            ->select('brands.id','brands.slug','brands.image','brands_language.name as name','brands_language.description as description')
//            ->join('brands_language','brands_id','=','brands.id')
//            ->join('languages','languages.lang_id','=','brands_language.lang_id')
//            ->where('languages.lang_code','=','ar-SY');
//
//        return response()->json($brand);
    }

    public function getBrandsById($id)
    {
        return $this->BrandModel::find($id);

//         Brands::find($id);
//
//        $brand=DB::table('brands')
//            ->select('brands.id','brands.slug','brands.image','brands_language.name as name','brands_language.description as description')
//            ->join('brands_language','brands_id','=','brands.id')
//            ->join('languages','languages.lang_id','=','brands_language.lang_id')
//            ->where('languages.lang_code','=','ar-SY')
//            ->get();
//
//        return response()->json($brand);
    }
//
    public function createNewBrands( BrandRequest $request )
    {

        $brand=new Brands();

        $brand->name            =$request->name;
        $brand->slug            =$request->slug;
        $brand->description     =$request->description;
        $brand->image           =$request->image;
        $brand->is_active       =$request->is_active;

        $brand->save();
        return response()->json($brand);
    }
//
    public function updateBrand(Request $request,$id)
    {
        $brand= Brands::find($id);

        $brand->name            =$request->name;
        $brand->slug            =$request->slug;
        $brand->description     =$request->description;
        $brand->image           =$request->image;
        $brand->is_active       =$request->is_active;

        $brand->save();
        return response()->json($brand);

    }
//
    public function deleteBrand(Request $request,$id)
    {
        $brand=Brands::find($id);

        $brand->is_active    =$request->is_active;

        $brand->save();

        return response()->json($brand);
    }
}
