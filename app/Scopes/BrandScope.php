<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Config;


class BrandScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('brand_translation', 'brands.id', '=', 'brand_translation.brand_id')
            ->where('brand_translation.locale', '=', Config::get('app.locale'))
            ->select([
                'brands.id','brands.is_active',
                'brand_translation.name','brand_translation.description', 'brand_translation.locale']);
    }
}
