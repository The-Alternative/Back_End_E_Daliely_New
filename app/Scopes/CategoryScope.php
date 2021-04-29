<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Config;


class CategoryScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->where('category_translations.local', '=', Config::get('app.locale'))
            ->select([
//                'categories.*',
                'categories.id','categories.is_active','categories.image','categories.section_id',
                'category_translations.name', 'category_translations.local']);
    }
}
