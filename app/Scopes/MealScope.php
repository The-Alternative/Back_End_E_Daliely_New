<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class MealScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->join('meal_translations','meals.id','=','meal_translations.meal_id')
            ->where('meal_translations.locale','=',config::get('app.locale'))
            ->select('meals.id','meals.is_active','meals.is_approved','meals.image',
                'meal_translations.title','meal_translations.short_description','meal_translations.long_description','meal_translations.locale');

    }
}
