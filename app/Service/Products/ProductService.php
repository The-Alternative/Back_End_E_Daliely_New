<?php
namespace App\Service\Products;

use App\Models\Categories\Category;
use App\Models\Categories\Section;
use App\Models\Products\ProductTranslation;
use App\Traits\GeneralTrait;
use App\Models\Custom_Fildes\Custom_Field;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use LaravelLocalization;

class ProductService
{
    use GeneralTrait;
    private $productModel;
    private $productTranslation;
    private $categoryModel;
    private $SectionModel;

    /**
     * ProductService constructor.
     * @param Product $product
     * @param ProductTranslation $productTranslation
     * @param Category $category
     */

    public function __construct(Product $product ,ProductTranslation $productTranslation ,Category $category,Section $sectionModel )
    {
        $this->productModel=$product;
        $this->productTranslation=$productTranslation;
        $this->categoryModel=$category;
        $this->SectionModel=$sectionModel;
    }
    /*__________________________________________________________________*/
    /****Get All Active Products  ****/
    public function getAll()
    {
        try{
          $products = $this->productModel->get();
            return $this->returnData('Product',$products,'done');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
    public function getProductByCategory($id)
    {
        try{
            $products = $this->categoryModel->with('Product')->find($id);
            return $this->returnData('Category',$products,'done');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }
        /*__________________________________________________________________*/
    /****Get Active Product By ID  ***
     * @param $id
     * @return JsonResponse
     */
    public function getById(/*Request $request,*/ $id)
    {
        try{
        $product = $this->productModel->find($id);
        return $this->returnData('Product',$product,'done');
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
          return $this -> returnData('Product',$product,'done');
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
            $product->is_active=true;
            $product->save();
            return $this->returnData('Product', $product,'This Product Is trashed Now');
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
        try{
        $product= $this->productModel->find($id);
            $product->is_active=false;
            $product->save();
            return $this->returnData('Product', $product,'This Product Is trashed Now');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
    }

        /*__________________________________________________________________*/

    /****  Create Products   ***
     * @param ProductRequest $request
     * @return JsonResponse
     */

    public function create(ProductRequest $request)
    {
        try{
//                validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
                $request->is_appear?$is_appear=true:$is_appear=false;
                //transformation to collection
                $allproducts = collect($request->product)->all();
                ///select folder to save the image
                // $fileBath = "" ;
                //     if($request->has('image'))
                //     {
                //         $fileBath=uploadImage('images/products',$request->image);
                //     }
                DB::beginTransaction();
                // //create the default language's product
                $unTransProduct_id=$this->productModel->insertGetId([
                    'slug' =>$request['slug'],
                    'image' =>$request['image'],
                    'barcode' =>$request['barcode'],
                    'is_active' =>$request['is_active'],
                    'is_appear' =>$request['is_appear'],
                    'custom_feild_id' =>$request['custom_feild_id'],
                    'rating_id' =>$request['rating_id'],
                    'brand_id' =>$request['brand_id'],
                    'offer_id' =>$request['offer_id'],
                    'category_id'=>$request['category_id']
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

    /*___________________________________________________________________________*/
    /****  Update Product   ***
     * @param ProductRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request,$id)
    {
//        $validated = $request->validated();
        try{
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
            $unTransProduct=$this->productModel->where('id',$id)
                ->update([
                    'slug' =>$request['slug'],
                    'image' =>$request['image'],
                    'barcode' =>$request['barcode'],
                    'is_active' =>$request['is_active'],
                    'is_appear' =>$request['is_appear'],
                    'custom_feild_id' =>$request['custom_feild_id'],
                    'rating_id' =>$request['rating_id'],
                    'brand_id' =>$request['brand_id'],
                    'offer_id' =>$request['offer_id'],
                    'category_id'=>$request['category_id']
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
            DB::commit();
            return $this->returnData('Category', $dbdproducts,'done');
        }
        catch(\Exception $ex){
            DB::rollback();
            return $this->returnError('400', 'saving failed');
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
