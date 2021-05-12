<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Config;

class ProductScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('product_translations', 'product_translations.product_id', '=', 'products.id')
            ->where('product_translations.local','=',Config::get('app.locale'))
            ->select([
                'products.id','products.image','products.is_appear','products.created_at',
                'product_translations.name',
                'product_translations.short_des','product_translations.long_des',]);
//        $builder->join('product_translations', 'product_translations.product_id', '=', 'products.id')
//            ->where('product_translations.local','=',Config::get('app.locale'))
//            ->join('stores_products', 'stores_products.product_id', '=', 'products.id')
//            ->select([
//                'products.id','products.image','products.is_appear','products.created_at',
//                'product_translations.name',
//                'product_translations.short_des','product_translations.long_des',
//                'stores_products.price','stores_products.quantity']);
    }
}
