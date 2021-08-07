<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class PostScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->join('post_translations','post_translations.post_id','posts.id')
            ->where('post_translations.locale',config::get('app.locale'))
            ->select('posts.id','posts.image','posts.is_active','posts.is_approved',
            'post_translations.name','post_translations.short_description','post_translations.long_description'
                ,'post_translations.locale');
    }
}
