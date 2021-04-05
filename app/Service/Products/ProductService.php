<?php
namespace App\Service\Products;

use App\Models\Products\ProductTranslation;
use App\Traits\GeneralTrait;
use App\Models\custom_Fields\Custom_Field;
use App\Http\Requests\ProductRequest;
use App\Models\Products\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Exceptions\GeneralHandler;
use Exception;
use LaravelLocalization;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class ProductService
{
    use GeneralTrait;
    private $productModel;
    private $productTranslation;

    /**
     * ProductService constructor.
     * @param Product $product
     * @param ProductTranslation $productTranslation
     */

    public function __construct(Product $product ,ProductTranslation $productTranslation)
    {
        $this->productModel=$product;
        $this->productTranslation=$productTranslation;
    }
    /*__________________________________________________________________*/
    /****Get All Active Products  ****/
    public function getAll()
    {
<<<<<<< HEAD
<<<<<<< HEAD



        $product= Product::all()->where('is_active',1);
            return $this->returnData('Product',$product,'done');
    //     try{
    //     $response= ($id?Product::find($id)->firstOrFail()->where('is_active',true):Product::all()->where('is_active',true));
    //         return $this->returnData('Product',$response,'done');
    // }
    // catch (\Exception $exception){
    //     throw new QueryException();
    // }
    // catch (\Exception $exception){
    //     throw new BadMethodCallException();
    // }

        $default_lang=get_default_languages();
        $product= Product::where('trans_lang', $default_lang)->selection();
        return $this->returnData('Product',$product,'done');


        $default_lang=get_default_languages();
        $product= Product::where('trans_lang', $default_lang)->selection();
        return $this->returnData('Product',$product,'done');

//        try
//        {
          $products = Product::withTrans()->get();
            return $this->returnData('Product',$products,'done');
//        }
//            catch(\Exception $ex)
//        {
//            return $this->returnError('400', 'nothing to get');
//        }



        $default_lang=get_default_languages();
        $product= Product::where('trans_lang', $default_lang)->selection();
        return $this->returnData('Product',$product,'done');


=======
        try{
          $products = $this->productModel->get();
            return $this->returnData('Product',$products,'done');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
        try{
          $products = $this->productModel->get();
            return $this->returnData('Product',$products,'done');
        }catch(\Exception $ex){
            return $this->returnError('400','faild');
        }
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
        /*__________________________________________________________________*/
    /****Get Active Product By ID  ***
     * @param $id
     * @return JsonResponse
     */
    public function getById(/*Request $request,*/ $id)
    {
<<<<<<< HEAD
<<<<<<< HEAD
       // $response=DB::table('products')->where('id','=',$id)->where('is_active','=',1)->get();


        $product= Product::find($id);

       $product= Product::selectActiveValue()->find($id);


       $product= Product::selectActiveValue()->find($id);


       $product= Product::selectActiveValue()->find($id);

        $product = Product::withTrans()->find($id);

=======
        try{
        $product = $this->productModel->find($id);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
        try{
        $product = $this->productModel->find($id);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
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
<<<<<<< HEAD
     * @return \Illuminate\Http\JsonResponse
=======
     * @return JsonResponse
>>>>>>> d9314851cee71a1a9ad7a8b610ab100989fe4dcd
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

                        $products_arr=[];
                        //insert other traslations for products
                        foreach ($product as $product)
                        {
                            $products_arr[]=[
                                'trans_lang' => $product['abbr'],
                                'trans_of' => $default_product_id,
                                'title' => $product['title'],


                                'slug' => ['slug'],

                                'slug' => $product['slug'],


                                'slug' => $product['slug'],

                                'meta' => $product['meta'],
                                'short_des' => $product['short_des'],
                                'description' => $product['description'],
                                'brand_id' => $request->brand_id,
                                'barcode' => $request['barcode'],
                                'is_active' => $request['is_active'],
                                'is_appear'=> $request['is_appear'],
                                'image' => $request['image']
                            ];
                        }
                        Product::insert($products_arr);

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
                    return $this->returnError('400', 'saving failed');
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
