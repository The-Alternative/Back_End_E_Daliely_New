<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class MealTypeScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->join('meal_type_translations','meal_types.id','=','meal_type_translations.meal_type_id')
            ->where('meal_type_translations.locale','=',config::get('app.locale'))
            ->select('meal_types.id','meal_types.is_active','meal_types.is_approved','meal_types.image',
                'meal_type_translations.title','meal_type_translations.short_description','meal_type_translations.long_description','meal_type_translations.locale');

    }
}
