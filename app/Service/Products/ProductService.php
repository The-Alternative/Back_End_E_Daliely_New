<?php
namespace App\Service\Products;

use App\Models\Categories\Category;
use App\Models\Categories\Section;
use App\Models\Custom_Fieldes\Custom_Field;
use App\Models\Products\ProductTranslation;
use App\Models\Stores\Store;
use App\Models\Stores\StoreProduct;
use App\Scopes\BrandScope;
use App\Scopes\CategoryScope;
use App\Scopes\ProductScope;
use App\Traits\GeneralTrait;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Laratrust\Laratrust;

class ProductService
{
    use GeneralTrait;

    private $customFieldModel;
    private $productModel;
    private $productTranslation;
    private $categoryModel;
    private $SectionModel;
    private $storeModel;
    private $storeProductModel;
    public function __construct(
        Product $product, ProductTranslation $productTranslation,
        Category $category, Section $sectionModel, Store $storeModel,
        StoreProduct $storeProduct, Custom_Field $CustomField
    )
    {
        $this->productModel = $product;
        $this->productTranslation = $productTranslation;
        $this->categoryModel = $category;
        $this->SectionModel = $sectionModel;
        $this->storeModel = $storeModel;
        $this->storeProductModel = $storeProduct;
        $this->customFieldModel = $CustomField;
    }
    /*** this function for dashboard ***/
    public function dashgetAll()
    {
        try {
            $products = Product::withoutGlobalScope(ProductScope::class)->active()
                ->with([
                    'ProductTranslation' => function ($q) {
                    return $q->where('product_translations.local', '='
                        , Config::get('app.locale'))
                        ->select('product_translations.name',
                            'product_translations.short_des',
                            'product_translations.product_id',
                            'product_translations.local')
                        ->get();
                }, 'ProductImage' => function ($q) {
                    return $q->where('product_images.is_cover', 1)
                        ->select('product_id', 'image')
                        ->get();
                }, 'Category' => function ($q) {
                    return $q->withoutGlobalScope(CategoryScope::class)
                        ->select(['categories.id'])
                        ->with(['CategoryTranslation' => function ($q) {
                            return $q->where('category_translations.local', '='
                                , Config::get('app.locale'))
                                ->select(['category_translations.name',
                                    'category_translations.local',
                                    'category_translations.category_id'])
                                ->get();
                        }])->get();
                }])->paginate(10);
            if (count($products) > 0) {
                return $response = $this->returnData('Products', $products, 'done');
            } else {
                return $response = $this->returnSuccessMessage('Product', 'Products doesnt exist yet');
            }
        } catch (\Exception $e) {
            return $this->returnError('400', $e->getMessage());
        }
    }
    public function dashgetById($id)
    {
        try {
            $product = $this->productModel->with([
                'Category' => function ($q) {
                return $q->withoutGlobalScope(CategoryScope::class)
                    ->select(['categories.id'])
                    ->with([
                        'CategoryTranslation' => function ($q) {
                        return $q->where('category_translations.local', '='
                            , Config::get('app.locale'))
                            ->select(['category_translations.name',
                                'category_translations.local',
                                'category_translations.category_id'])
                            ->get();
                    }])->get();
            },
                'ProductImage'=> function ($q) {
                return $q->select('product_id', 'image')
                    ->get();
            },
                'Brand' => function ($q) {
                return $q->withoutGlobalScope(BrandScope::class)
                    ->select(['brands.id'])
                    ->with(['BrandTranslation'=>function($q){
                        return $q->where('brand_translation.local','='
                            , Config::get('app.locale'))
                            ->select(['brand_translation.name','brand_translation.brand_id'
                            ])->get();
                }])->get();
            },
                'Custom_Field'=> function ($q) {
                    return $q->withoutGlobalScope(BrandScope::class)
                        ->select(['custom_fields.id'])
                        ->with(['custom__fields__translations'=>function($q){
                            return $q->where('custom__fields__translations.local','='
                                , Config::get('app.locale'))
                                ->select(['custom__fields__translations.name'
                                    ,'custom__fields__translations.custom_field_id'
                                ])->get();
                        }])->get();
                },
                'Custom_Field_Value'=> function ($q) {
                    return $q->withoutGlobalScope(BrandScope::class)
                        ->select(['custom_field_value.id'])
                        ->with(['BrandTranslation'=>function($q){
                            return $q->where('brand_translation.local','='
                                , Config::get('app.locale'))
                                ->select(['brand_translation.name','brand_translation.brand_id'
                                ])->get();
                        }])->get();
                }])
                ->find($id);
            if (!isset($product)) {
                return $response = $this->returnSuccessMessage('This Product not found', 'done');
            }
            return $response = $this->returnData('product', $product, 'done');
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****Get All Active Products  ****/
    public function getAll()
    {
        try {
            $products = $this->productModel
                ->with(['Store', 'ProductImage'])
                ->where('products.is_active','=',1)
                ->paginate(10);
            if (count($products) > 0) {
                return $response = $this->returnData('Products', $products, 'done');
            } else {
                return $response = $this->returnSuccessMessage('Product', 'Products doesnt exist yet');
            }
        } catch (\Exception $e) {
            return $this->returnError('400', $e->getMessage());
        }


//        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
//        $models = [];
//        foreach ((array)data_get($composer, 'autoload.psr-4') as $name => $path) {
//            $models = array_merge(collect(File::allFiles(base_path($path)))
//                ->map(function ($item) use ($name) {
//                    $path = $item->getRelativePathName();
//                    return sprintf('\%s%s',
//                        $name,
//                        strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));
//                })
//                ->filter(function ($class) {
//                    $valid = false;
//                    if (class_exists($class)) {
//                        $reflection = new \ReflectionClass($class);
//                        $valid = $reflection->isSubclassOf(\Illuminate\Database\Eloquent\Model::class) &&
//                            !$reflection->isAbstract();
//                    }
//                    return $valid;
//                })
//                ->values()
//                ->toArray(), $models);
//        }
//        return $models;
    }
    public function getProductByCategory($id)
    {
        try {
            $products = $this->categoryModel->with('Product')->find($id);
            if (is_null($products)) {
                return $this->returnSuccessMessage('This category not have products', 'done');
            } else {
                return $this->returnData('Products',$products, 'done');
            }
        } catch (\Exception $e) {
            return $this->returnError('400', $e->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****Get Active Product By ID  ***/
    public function getById($id)
    {
        try {
            $product = $this->productModel
                ->with(['Store', 'Category', 'ProductImage', 'Brand', 'StoreProduct'])
                ->where('products.is_active','=',1)
                ->find($id);
            if (!isset($product)) {
                return $response = $this->returnSuccessMessage('This Product not found', 'done');
            }
            return $response = $this->returnData('product', $product, 'done');
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
            $product = $this->productModel->where('products.is_active','=',0)->get();

            if (count($product) > 0) {
                return $response = $this->returnData('Store', $product, 'done');
            } else {
                return $response = $this->returnSuccessMessage('product', 'Products trashed doesnt exist yet');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****Restore Products Fore Active status  ***/
    public function restoreTrashed($id)
    {
        try {
            $product = $this->productModel->find($id);
            if (is_null($product)) {
                return $response = $this->returnSuccessMessage('Product', 'This Products not found');
            } else {
                $product->is_active = true;
                $product->save();
                return $this->returnData('Product', $product, 'This Product Is trashed Now');
            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****   Product's Soft Delete   ***/
    public function trash($id)

    {
        try {
            $product = $this->productModel->find($id);
            if (is_null($product)) {
                return $response = $this->returnSuccessMessage('Product', 'This Products not found');
            } else {
                $product->is_active = false;
                $product->save();
                return $this->returnData('Product', $product, 'This Product Is trashed Now');
            }

        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****  Create Products   ***/
    public function create(ProductRequest $request)
    {

        try {
//            dd($request->all());
            $request->validated();
            $request->is_active ? $is_active = true : $is_active = false;
            $request->is_appear ? $is_appear = true : $is_appear = false;
            /////////////transformation to collection/////////////////////////
            $allproducts = collect($request->product)->all();
            DB::beginTransaction();
            // //create the default language's product
            $unTransProduct_id = $this->productModel->insertGetId([
                'slug' => $request['slug'],
                'barcode' => $request['barcode'],
                'is_active' => $request['is_active'],
                'is_appear' => $request['is_appear'],
                'brand_id' => $request['brand_id'],
            ]);
            //check the product and request
            if (isset($allproducts) && count($allproducts)) {
                //insert other traslations for products
                foreach ($allproducts as $allproduct) {
                    $transProduct_arr[] = [
                        'name' => $allproduct ['name'],
                        'short_des' => $allproduct['short_des'],
                        'local' => $allproduct['local'],
                        'long_des' => $allproduct['long_des'],
                        'meta' => $allproduct['meta'],
                        'product_id' => $unTransProduct_id
                    ];
                }
                $this->productTranslation->insert($transProduct_arr);
            }
            if ($request->has('category')) {
                $product = $this->productModel->find($unTransProduct_id);
                $product->Category()->syncWithoutDetaching($request->get('category'));
            }
            if ($request->has('CustomFieldValue')) {
                $product = $this->productModel->find($unTransProduct_id);
                $product->Custom_Field_Value()->syncWithoutDetaching($request->get('CustomFieldValue'));
            }
            if ($request->has('Sections')) {
                $product = $this->productModel->find($unTransProduct_id);
                $product->Section()->syncWithoutDetaching($request->get('Sections'));
            }
            $images = $request->images;
            foreach ($images as $image) {
                $arr[] = $image['image'];
            }
            foreach ($arr as $ar) {
                if (isset($image)) {
//                    if ($request->hasFile($ar)) {
                        //save
                        $folder = storage_path('/app/public/images/products' . '/' . $unTransProduct_id . '/');
                        if (!File::exists($folder)) {
                            File::makeDirectory($folder, 0775, true, true);
                            $file_extension = $ar->getClientOriginalExtension();
                            $file_name = time() . $file_extension;
//                            $path = 'images/products';
                            $request->image->move($folder, $file_name);
                        }
                    }
//                    }
                }
            if ($request->has('images')) {
                foreach ($images as $image) {
                    $product = $this->productModel->find($unTransProduct_id);
                    $product->ProductImage()->insert([
                        'product_id' => $unTransProduct_id,
                        'image' => $image['image'],
                        'is_cover' => $image['is_cover'],
                    ]);
                }
            }
            DB::commit();
            return $this->returnData('Product', [$unTransProduct_id, $transProduct_arr], 'done');
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****  Update Product   ***/
    public function update(ProductRequest $request,$id)
    {
        $validated = $request->validated();
        try {
            $product = $this->productModel->find($id);
            if (!$product)
                return $this->returnError('400', 'not found this Product');
            $allproducts = collect($request->product)->all();
            if (!($request->has('products.is_active')))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);
            DB::beginTransaction();
            $unTransProduct = $this->productModel->where('products.id', $id)
                ->update([
                    'slug' => $request['slug'],
                    'barcode' => $request['barcode'],
                    'is_active' => $request['is_active'],
                    'is_appear' => $request['is_appear'],
//                    'rating_id' => $request['rating_id'],
                    'brand_id' => $request['brand_id'],
//                    'offer_id' => $request['offer_id'],
                ]);
            $ss = $this->productTranslation->where('product_translations.product_id', $id);
            $collection1 = collect($allproducts);
            $allcategorieslength = $collection1->count();
            $collection2 = collect($ss);

            $db_product = array_values(
                $this->productTranslation
                    ->where('product_translations.product_id', $id)
                    ->get()
                    ->all());
            $dbdproducts = array_values($db_product);
            $request_products = array_values($request->product);
            foreach ($dbdproducts as $dbdproduct) {
                foreach ($request_products as $request_product) {
                    $values = $this->productTranslation->where('product_translations.product_id', $id)
                        ->where('product_translations.local', $request_product['local'])
                        ->update([
                            'name' => $request_product ['name'],
                            'short_des' => $request_product['short_des'],
                            'local' => $request_product['local'],
                            'long_des' => $request_product['long_des'],
                            'meta' => $request_product['meta'],
                            'product_id' => $id
                        ]);
                }
                if ($request->has('category')) {
                    $product = $this->productModel->find($id);
                    $product->Category()->syncWithoutDetaching($request->get('category'));
                }
                if ($request->has('CustomFieldValue')) {
                    $product = $this->productModel->find($id);
                    $product->Custom_Field_Value()->syncWithoutDetaching($request->get('CustomFieldValue'));
                }
                if ($request->has('Sections')) {
                    $product = $this->productModel->find($id);
                    $product->Section()->syncWithoutDetaching($request->get('Sections'));
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
                            $path = 'images/products';
                            $ar->move($path, $file_name);
                        }
                    }
                }
                if ($request->has('images')) {
                    foreach ($images as $image) {
                        $product = $this->productModel->find($id);
                        $product->ProductImage()->insert([
                            'product_id' => $id,
                            'image' => $image['image'],
                            'is_cover' => $image['is_cover'],
                        ]);
                    }

                }
                DB::commit();
                return $this->returnData('Product', [['old data', $dbdproducts], ['new data', $request_products]], 'done');
            }
        }
        catch(\Exception $ex){
            DB::rollback();
            return $this->returnError('400', $ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    public function search($title)
    {
        try{
        $product= $this->productModel->searchTitle();
        if (!$product)
        {
            return $this->returnError('400', 'not found this Product');
        }
          else
            {
                return $this->returnData('products', $product,'done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
    /*__________________________________________________________________*/
    /****  Delete Product   ****/
    public function delete( $id)
    {
        try{
        $product=$this->productModel->find($id);
        if ($product->is_active=0)
            {
                $product=$this->productModel->destroy($id);
                 return $this->returnData('Product', $product,'This Product Is deleted Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
}
