<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



class StoreScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $builder->join('store_translations', 'store_translations.store_id', '=', 'stores.id')
            ->where('store_translations.local','=',get_current_local())
            ->select(['stores.*','store_translations.*']);
=======
        $builder->join('store_translations', 'stores.id', '=','store_translations.store_id' )
            ->where('store_translations.local','=',get_current_local())
            ->select(['stores.*','store_translations.title','store_translations.local']);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
=======
        $builder->join('store_translations', 'stores.id', '=','store_translations.store_id' )
            ->where('store_translations.local','=',get_current_local())
            ->select(['stores.*','store_translations.title','store_translations.local']);
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
    }
}
