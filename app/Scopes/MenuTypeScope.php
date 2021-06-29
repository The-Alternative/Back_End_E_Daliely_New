<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class MenuTypeScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->join('menu_type_translations','menu_types.id','=','menu_type_translations.menu_type_id')
            ->where('menu_type_translations.locale','=',config::get('app.locale'))
            ->select('menu_types.id','menu_types.is_active','menu_types.is_approved','menu_types.image',
                'menu_type_translations.title','menu_type_translations.short_description','menu_type_translations.long_description','menu_type_translations.locale');

    }
}
