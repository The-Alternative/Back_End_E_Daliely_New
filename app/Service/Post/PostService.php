<?php


namespace App\Service\Post;


use App\Http\Requests\Post\PostRequest;
use App\Models\Doctors\Doctor;
use App\Models\Post\Post;
use App\Models\Post\PostTranslation;
use App\Models\Stores\Store;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class PostService
{
    private $PostModel;
    use GeneralTrait;

    public function __construct(Post $Post)
    {
        $this->PostModel=$Post;
    }
    public function get()
    {
        try {
            $Post = $this->PostModel::paginate(5);
            return $this->returnData('Post', $Post, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getById($id)
    {
        try{
            $Post= $this->PostModel::find($id);
            if (is_null($Post)){
                return $this->returnSuccessMessage('this Post not found','done');
            }
            else{
                return $this->returnData('Post',$Post,'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    //__________________________________________________________//
    public function create( PostRequest $request )
    {
        try {
            $allPost = collect($request->Post)->all();
            DB::beginTransaction();
            $unTransPost_id = Post::insertGetId([
                'image'   => $request['image'],
                'is_approved' => $request['is_approved'],
                'is_active'   => $request['is_active'],
            ]);
            if (isset($allPost)) {
                foreach ($allPost as $allPosts) {
                    $transPost[] = [
                        'name' => $allPosts ['name'],
                        'short_description' => $allPosts ['short_description'],
                        'long_description' => $allPosts ['long_description'],
                        'locale' => $allPosts['locale'],
                        'post_id' => $unTransPost_id,
                    ];
                }
                PostTranslation::insert($transPost);
            }
            DB::commit();
            return $this->returnData('Post',[$unTransPost_id, $transPost],'done');
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return $this->returnError('Post', $ex->getMessage());
        }

    }
    //___________________________________________________________________//
    public function update(PostRequest $request,$id)
    {
        try{
            $Post= Post::find($id);
            if(!$Post)
                return $this->returnError('400', 'not found this Post');
            $allPost = collect($request->Post)->all();
            if (!($request->has('posts.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            $newPost=Post::where('posts.id',$id)
                ->update([
                    'image'   => $request['image'],
                    'is_approved' => $request['is_approved'],
                    'is_active'   => $request['is_active'],
                ]);

            $ss=PostTranslation::where('post_translations.post_id',$id);
            $collection1 = collect($allPost);
            $allPostlength=$collection1->count();
            $collection2 = collect($ss);

            $db_Post= array_values(PostTranslation::where('Post_translations.post_id',$id)
                ->get()
                ->all());
            $dbPost= array_values($db_Post);
            $request_Post= array_values($request->Post);
            foreach($dbPost as $dbPosts){
                foreach($request_Post as $request_Posts){
                    $values=PostTranslation::where('post_translations.post_id',$id)
                        ->where('locale',$request_Posts['locale'])
                        ->update([
                            'name' => $request_Posts ['name'],
                            'short_description' => $request_Posts ['short_description'],
                            'long_description' => $request_Posts ['long_description'],
                            'locale' => $request_Posts['locale'],
                            'post_id' => $id,
                        ]);
                }
            }
            DB::commit();
            return $this->returnData('Post', [$dbPost,$values],'done');
        }
        catch(\Exception $ex){
            return $this->returnError('400', $ex->getMessage());
        }
    }
    //____________________________________________________________//
    public function search($name)
    {
        try {
            $Post = DB::table('post_translations')
                ->where("name", "like", "%" . $name . "%")
                ->get();
            if (!$Post) {
                return $this->returnError('400', 'not found this Post');
            } else {
                return $this->returnData('Post', $Post, 'done');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try{
            $Post= $this->PostModel::find($id);
            if (is_null($Post)) {
                return $this->returnSuccessMessage('This Post not found', 'done');
            }
            else
            {
                $Post->is_active=0;
                $Post->save();
                return $this->returnData('Post', $Post,'This  Post is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
    public function getTrashed()
    {
        try{
            $post=$this->PostModel::NotActive();
            return $this->returnData('post',$post,'done');
        }
        catch (\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }

    public function restoreTrashed( $id)
    {
        try{
            $Post=Post::find($id);
            if (is_null($Post)) {
                return $this->returnSuccessMessage('This Post not found', 'done');
            }
            else
            {
               $Post->is_active=1;
               $Post->save();
                return $this->returnData('Post', $Post,'This Post is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    //________________________________________//
    public function delete($id)
    {
        try{
            $Post = Post::find($id);
            if ($Post->is_active == 0) {
                $Post->delete();
                $Post->PostTranslation()->delete();
                return $this->returnData('Post', $Post, 'This Post is deleted Now');
            }
            else{
                return $this->returnData('Post', $Post, 'This Post can not deleted Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getOffers($store_Id)
    {
        try {
            $Post= Store::with('Post')->find($store_Id);
            return $this->returnData('Store', $Post, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getInteractions($post_Id)
    {
        try {
            $Post= Post::with('Customer')->find($post_Id);
            return $this->returnData('Post', $Post, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    public function getAd()
    {
        try{
            $post=$this->PostModel::GetAD();
            return $this->returnData('post',$post,'done');
        }
        catch (\Exception $ex){
            return $this->returnError('400',$ex->getMessage());
        }
    }
}
