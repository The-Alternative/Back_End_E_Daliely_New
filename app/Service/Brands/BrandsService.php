<?php

namespace App\Service\Brands;

use App\Models\Brands\Brand;
use App\Models\Brands\BrandTranslation;
use App\Models\Images\BrandImages;
use Illuminate\Support\Facades\DB;
use App\Traits\GeneralTrait;
use App\Http\Requests\Brands\BrandRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BrandsService
{
    private $BrandModel;
    private $brandTranslation;
    use GeneralTrait;

    public function __construct(Brand $brand, BrandTranslation $brandTranslation)
    {
        $this->brandTranslation = $brandTranslation;
        $this->BrandModel = $brand;
    }
    /****Get All Active Products  ****/
    public function getAll()
    {
        try {
            $brands = $this->BrandModel->with(['Product', 'BrandImages'=>function($q){
                return $q->where('is_cover',1)->get();}])->paginate(10);
            if (count($brands) > 0) {
                return $response = $this->returnData('Brand', $brands, 'done');
            } else {
                return $response = $this->returnSuccessMessage('Brand', 'Brands doesnt exist yet');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****Get Active Product By ID  ***
     * @param $id
     * @return JsonResponse
     */
    public function getById($id)
    {
        try {
            $brand = $this->BrandModel->with('Product','BrandImages')->find($id);
//            return $brand->Product()->get();

            if (!isset($brand)) {
                return $response = $this->returnSuccessMessage('This Brand not found', 'done');
            }
            return $response = $this->returnData('Brand', $brand, 'done');
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****ــــــ This Functions For Trashed Productsــــــ  ****/
    /****Get All Trashed Products Or By ID  ****/
    public function getTrashed()
    {
        try {
            $brand = $this->BrandModel->where('is_active', 0)->get();

            if (count($brand) > 0) {
                return $response = $this->returnData('Brand', $brand, 'done');
            } else {
                return $response = $this->returnSuccessMessage('Brand', 'Brands trashed doesnt exist yet');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****Restore Products Fore Active status  ***
     * @param $id
     * @return JsonResponse
     */
    public function restoreTrashed($id)
    {
        try {
            $brand = $this->BrandModel->find($id);
            if (is_null($brand)) {
                return $response = $this->returnSuccessMessage('Brand', 'This Products not found');
            } else {
                $brand->is_active = true;
                $brand->save();
                return $this->returnData('Brand', $brand, 'This Brand Is trashed Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****   Product's Soft Delete   ***
     * @param $id
     * @return JsonResponse
     */
    public function trash($id)
    {
        try {
            $brand = $this->BrandModel->find($id);
            if (is_null($brand)) {
                return $response = $this->returnSuccessMessage('Brand', 'This Brands not found');
            } else {
                $brand->is_active = false;
                $brand->save();
                return $this->returnData('Brand', $brand, 'This Brand Is trashed Now');
            }

        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****  Create Products   ***
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
//                $validated = $request->validated();
            $request->is_active ? $is_active = true : $is_active = false;
            /////////////////////transformation to collection///////////////////////////
            $allbrands = collect($request->brands)->all();
            DB::beginTransaction();
            // //create the default language's product
            $unTransBrand_id = $this->BrandModel->insertGetId([
                'slug' => $request['slug'],
                'is_active' => $request['is_active'],
            ]);
            //check the Brand and request
            if (isset($allbrands) && count($allbrands)) {
                //insert other traslations for Brands
                foreach ($allbrands as $allbrand) {
                    $transBrand_arr[] = [
                        'name' => $allbrand ['name'],
                        'locale' => $allbrand['locale'],
                        'description' => $allbrand['description'],
                        'brand_id' => $unTransBrand_id
                    ];
                }
                $this->brandTranslation->insert($transBrand_arr);
            }
            $images = $request->images;
            foreach ($images as $image) {
                $arr[] = $image['image'];
            }
            foreach ($arr as $ar) {
                if (isset($image)) {
                    if ($request->hasFile($ar)) {
                        //save
                        $file_extension = $ar->getClientOriginalExtension();
                        $file_name = time() . $file_extension;
                        $path = 'images/brands';
                        $ar->move($path, $file_name);
                    }
                }
            }
            if ($request->has('images')) {
                foreach ($images as $image) {
                    $brandImages = $this->BrandModel->find($unTransBrand_id);
                    $brandImages->BrandImages()->insert([
                        'brand_id' => $unTransBrand_id,
                        'image' => $image['image'],
                        'is_cover' => $image['is_cover'],
                    ]);
                }
            }
            DB::commit();
            return $this->returnData('Brand', [$unTransBrand_id, $transBrand_arr], 'done');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError('Brand', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****  Update Product   ***
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
//        $validated = $request->validated();
        try {
            $brand = $this->BrandModel->find($id);
            if (!$brand)
                return $this->returnError('400', 'not found this Category');
            $allbrands = collect($request->brands)->all();
            if (!($request->has('brand.is_active')))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $unTransBrand = $this->BrandModel->where('brands.id', $id)
                ->update([
                    'slug' => $request['slug'],
                    'image' => $request['image'],
                    'is_active' => $request['is_active'],
                ]);
            $ss = $this->brandTranslation->where('brand_id', $id);
            $collection1 = collect($allbrands);
            $allbrandslength = $collection1->count();
            $collection2 = collect($ss);

            $db_brand = array_values(
                $this->brandTranslation
                    ->where('brand_id', $id)
                    ->get()
                    ->all());
            $dbdbrands = array_values($db_brand);
            $request_brands = array_values($request->brands);
            foreach ($dbdbrands as $dbdbrand) {
                foreach ($request_brands as $request_brand) {
                    $values = $this->brandTranslation->where('brand_id', $id)
                        ->where('locale', $request_brand['locale'])
                        ->update([
                            'name' => $request_brand ['name'],
                            'locale' => $request_brand['locale'],
                            'description' => $request_brand['description'],
                            'brand_id' => $id
                        ]);
                }
            }
//            DB::commit();
            return $this->returnData('Brand', $dbdbrands, 'done');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    public function search($title)
    {
        try {
            $brand = $this->BrandModel->searchTitle();
            if (!$brand) {
                return $this->returnError('400', 'not found this Brand');
            } else {
                return $this->returnData('brands', $brand, 'done');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****  Delete Product   ***
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $brand = $this->BrandModel->find($id);

                $brand ->destroy($id);
                return $this->returnData('Brand', $brand, 'This Brand Is deleted Now');


        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
