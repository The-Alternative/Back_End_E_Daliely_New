<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class RestaurantScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
       $builder->join('restaurant_translations','restaurant_translations.restaurant_id','=','restaurants.id')
            ->where('restaurant_translations.locale','=', Config::get('app.locale'))
            ->select('restaurant.*','restaurant_translations.*')->get();
    }
}
