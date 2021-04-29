<?php
namespace App\Service\Products;

use App\Models\Categories\Category;
use App\Models\Categories\Section;
use App\Models\Products\ProductTranslation;
use App\Models\Stores\Store;
use App\Models\Stores\StoreProduct;
use App\Traits\GeneralTrait;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class ProductService
{
    use GeneralTrait;
    private $productModel;
    private $productTranslation;
    private $categoryModel;
    private $SectionModel;
    private $storeModel;
    private $storeProductModel;

    /**
     * ProductService constructor.
     * @param Product $product
     * @param ProductTranslation $productTranslation
     * @param Category $category
     * @param Section $sectionModel
     */
    public function __construct(
        Product $product ,ProductTranslation $productTranslation ,
        Category $category,Section $sectionModel,Store $storeModel ,
        StoreProduct $storeProduct
    )
    {
        $this->productModel=$product;
        $this->productTranslation=$productTranslation;
        $this->categoryModel=$category;
        $this->SectionModel=$sectionModel;
        $this->storeModel=$storeModel;
        $this->storeProductModel=$storeProduct;
    }
    /*__________________________________________________________________*/
    /****Get All Active Products  ****/
    public function getAll()
    {
        try{
        $products = $this->productModel
            ->with(['Category','Section'])
            ->get();

            if (count($products) > 0)
            {
                return $response=$this->returnData('Products',$products,'done');
            }else
            {
                return $response=$this->returnSuccessMessage('Product','Products doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    public function getProductByCategory($id)
    {
        try{
            $products = $this->categoryModel->with('Product')->find($id);
            if (is_null($products) ){
                return $response= $this->returnSuccessMessage('This category not have products','done');
            }else{
                return $response= $this->returnData($products,'$products','done');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*__________________________________________________________________*/
    /****Get Active Product By ID  ***
     * @param $id
     * @return JsonResponse
     */
    public function getById( $id)
    {
        try{
        $product = $this->productModel->with(['Store','Category','ProductImage'])
            ->find($id);
//            $prices = $this->storeProductModel->where('product_id','=',$id)->get();
////            if(isset($prices) && count($prices)){
//            foreach($product->prices as $price)
//            {
//                $collection1[]=[
//                $price['price']
//            ];
//            }
//        $max = collect($collection1)->max();
//        $min = collect($collection1)->min();
        return $response=$this->returnData('Product',$product,'done');
//            }

//            if (!isset($product) ){
////                return $response= $this->returnSuccessMessage('This Product not found','done');
//                return $response=$this->returnData('Product',[$product,],'done');
//            }
//            return $response=$this->returnData('Product',$product,$max,$min,'done');

        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*__________________________________________________________________*/
    /****ــــــThis Functions For Trashed Productsــــــ  ****/
    /****Get All Trashed Products Or By ID  ****/
    public function getTrashed()
    {
        try{
        $product= $this->productModel->where('is_active',0)->get();

            if (count($product) > 0){
                return $response= $this->returnData('Store',$product,'done');
            }else{
                return $response= $this->returnSuccessMessage('Product','Products trashed doesnt exist yet');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*__________________________________________________________________*/
    /****Restore Products Fore Active status  ***
     * @param $id
     * @return JsonResponse
     */
    public function restoreTrashed( $id)
    {
        try{
        $product=$this->productModel->find($id);
            if (is_null($product) ){
                return $response= $this->returnSuccessMessage('Product','This Products not found');
            }else {
                $product->is_active = true;
                $product->save();
                return $this->returnData('Product', $product, 'This Product Is trashed Now');
            }
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*__________________________________________________________________*/
    /****   Product's Soft Delete   ***
     * @param $id
     * @return JsonResponse
     */
    public function trash( $id)
    {
        try {
        $product= $this->productModel->find($id);
            if (is_null($product) ){
                return $response= $this->returnSuccessMessage('Product','This Products not found');
            }else {
                $product->is_active=false;
                $product->save();
                return $this->returnData('Product', $product,'This Product Is trashed Now');
            }

        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    /*__________________________________________________________________*/
    /****  Create Products   ***
     * @param ProductRequest $requests
     * @return JsonResponse
     */
    public function create(ProductRequest $request)
    {
        try{
//                validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
                $request->is_appear?$is_appear=true:$is_appear=false;
                /////////////transformation to collection/////////////////////////
                $allproducts = collect($request->product)->all();
                DB::beginTransaction();
                // //create the default language's product
                $unTransProduct_id=$this->productModel->insertGetId([
                    'slug' =>$request['slug'],
                    'image' =>$request['image'],
                    'barcode' =>$request['barcode'],
                    'is_active' =>$request['is_active'],
                    'is_appear' =>$request['is_appear'],
                    'rating_id' =>$request['rating_id'],
                    'brand_id' =>$request['brand_id'],
                    'offer_id' =>$request['offer_id'],
                ]);
                //check the category and request
                if(isset($allproducts) && count($allproducts))
                {
                    //insert other traslations for products
                    foreach ($allproducts as $allproduct)
                    {
                        $transProduct_arr[]=[
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
                DB::commit();
                return $this->returnData('Product', [$unTransProduct_id,$transProduct_arr],'done');
            }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Product','faild');
        }
    }
    /*__________________________________________________________________*/
    /****  Update Product   ***
     * @param ProductRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request,$id)
    {
//        $validated = $request->validated();
//        try{
            $product= $this->productModel->find($id);
            if(!$product)
                return $this->returnError('400', 'not found this Category');
            $allproducts = collect($request->product)->all();
            if (!($request->has('category.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);
            //save image
            // if($request->has('image')) {
            //     $filePath = uploadImage('products', $request->photo);
            //     Product::where('id', $pro_id)
            //         ->update([
            //             'image' => $filePath,
            //         ]);
            // }
            $unTransProduct=$this->productModel->where('products.id',$id)
                ->update([
                    'slug' =>$request['slug'],
                    'image' =>$request['image'],
                    'barcode' =>$request['barcode'],
                    'is_active' =>$request['is_active'],
                    'is_appear' =>$request['is_appear'],
//                    'custom_feild_id' =>$request['custom_feild_id'],
                    'rating_id' =>$request['rating_id'],
                    'brand_id' =>$request['brand_id'],
                    'offer_id' =>$request['offer_id'],
//                    'category_id'=>$request['category_id']
                ]);
            $ss=$this->productTranslation->where('product_id',$id);
            $collection1 = collect($allproducts);
            $allcategorieslength=$collection1->count();
            $collection2 = collect($ss);

            $db_product= array_values(
                $this->productTranslation
                    ->where('product_id',$id)
                    ->get()
                    ->all());
            $dbdproducts = array_values($db_product);
            $request_products = array_values($request->product);
            foreach($dbdproducts as $dbdproduct){
                foreach($request_products as $request_product){
                    $values= $this->productTranslation->where('product_id',$id)
                        ->where('local',$request_product['local'])
                        ->update([
                            'name' => $request_product ['name'],
                            'short_des' => $request_product['short_des'],
                            'local' => $request_product['local'],
                            'long_des' => $request_product['long_des'],
                            'meta' => $request_product['meta'],
                            'product_id' => $id
                        ]);
                }
            }
//            DB::commit();
            return $this->returnData('Category', $dbdproducts,'done');
//        }
//        catch(\Exception $ex){
//            DB::rollback();
//            return $this->returnError('400', 'saving failed');
//        }
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
            return $this->returnError('400','faild');
        }
    }
    /*__________________________________________________________________*/
    /****  Delete Product   ***
     * @param $id
     * @return JsonResponse
     */
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
            return $this->returnError('400','faild');
        }
    }
}
