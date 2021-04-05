<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;


class CategoryScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->where('category_translations.local', '=', get_current_local())
            ->select(['categories.*', 'category_translations.name', 'category_translations.local']);
    }
}
