<?php


namespace App\Service\Brands;

use App\Models\Brands\Brands;
use App\Models\Brands\BrandTranslation;
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
    use GeneralTrait;


    public function __construct(Brands $brand, BrandRequest $request)
    {
        $this->BrandModel = $brand;
    }

    public function get()
    {
        $brand = $this->BrandModel::withTrans()->Active()->get();
        return $this->returnData('brand', $brand, 'done');
    }

    public function getById($id)
    {
        $brand = $this->BrandModel::withTrans()->find($id);
        return $this->returnData('brand', $brand, 'done');
    }

    public function getTrashed()
    {
        $brand = $this->BrandModel::all()->where('is_active', 0);
        return $this->returnData('brand', $brand, 'done');
    }

//________________________________________________________________________//
    public function create(BrandRequest $request)
    {
        try {
            $allbrands = collect($request->brand)->all();
            DB::beginTransaction();
            $unTransbrand_id = Brands::insertGetId([
                'image' => $request['image'],
                'slug' => $request['slug'],
                'is_active' => $request['is_active'],
            ]);
            if (isset($allbrands)) {
                foreach ($allbrands as $allbrand) {
                    $transBrand[] = [
                        'name' => $allbrand ['name'],
                        'description' => $allbrand ['description'],
                        'locale' => $allbrand['locale'],
                        'brand_id' => $unTransbrand_id
                    ];
                }
                BrandTranslation::insert($transBrand);
            }
            DB::commit();
            return $this->returnData('brand', [$unTransbrand_id, $transBrand], 'done');
        }
           catch (\Exception $ex)
           {
           DB::rollback();
           return $this->returnError('brand', 'faild');
           }
}
//_____________________________________________________//
    public function update(BrandRequest $request,$id)
    {
        try{
            $brand= Brands::find($id);
            if(!$brand)
                return $this->returnError('400', 'not found this brand');
            $allbrand = collect($request->Brands)->all();
            if (!($request->has('brands.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newbrand=Brands::where('id',$id)
                ->update([
                    'image' => $request['image'],
                    'slug' => $request['slug'],
                    'is_active' => $request['is_active']
                ]);
            $ss=BrandTranslation::where('brand_id',$id);
            $collection1 = collect($allbrand);
            $allbrandlength=$collection1->count();
            $collection2 = collect($ss);

            $db_brand= array_values(BrandTranslation::where('brand_id',$id)
                ->get()
                ->all());
            $dbbrand = array_values($db_brand);
            $request_brand = array_values($request->brand);
            foreach($dbbrand as $dbbrands){
                foreach($request_brand as $request_brands){
                    $values= BrandTranslation::where('brand_id',$id)
                        ->where('locale',$request_brands['locale'])
                        ->update([
                            'name'=>$request_brands['name'],
                            'description'=>$request_brands['description'],
                            'locale'=>$request_brands['locale'],
                            'brand_id'=>$id
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('brand', $dbbrand,'done');
        }
        catch(\Exception $ex){
           // return $ex;
            return $this->returnError('400', 'saving failed');
        }
     }
//_______________________________________________________________________________//
    public function search($name)
    {
        $brand = DB::table('brands')
            ->where("name", "like", "%" . $name . "%")
            ->get();
        if (!$brand) {
            return $this->returnError('400', 'not found this brand');
        } else {
            return $this->returnData('brand', $brand, 'done');

        }
    }

    public function trash( $id)
    {
        $brand= $this->BrandModel::find($id);
        $brand->is_active=false;
        $brand->save();

        return $this->returnData('brand', $brand,'This brand is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $brand=Brands::find($id);
        $brand->is_active=true;
        $brand->save();

        return $this->returnData('brand', $brand,'This brand is trashed Now');
    }

    public function delete($id)
    {
        $brand = Brands::find($id);
        $brand->is_active = false;
        $brand->save();


        return $this->returnData('brand', $brand, 'This brand is deleted Now');

    }
}
