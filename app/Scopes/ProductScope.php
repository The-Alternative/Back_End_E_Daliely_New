<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



class ProductScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('product_translations', 'product_translations.product_id', '=', 'products.id')
            ->where('product_translations.locale','=',get_current_local())
<<<<<<< HEAD
<<<<<<< HEAD
            ->select(['products.*','product_translations.*']);
=======
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
            ->select(['products.*',
                'product_translations.name',
                'product_translations.short_des',
                'product_translations.long_des',
                'product_translations.meta',
                'product_translations.locale']);
<<<<<<< HEAD
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
}
