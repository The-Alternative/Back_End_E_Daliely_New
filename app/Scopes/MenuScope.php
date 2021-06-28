<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class MenuScope implements \Illuminate\Database\Eloquent\Scope
{
    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.

        $builder->join('menu_translations','menus.id','=','menu_translations.menu_id')
            ->where('menu_translations.locale','=',config::get('app.locale'))
            ->select('menus.id','menus.is_active','menus.is_approved','menus.image',
                'menu_translations.title','menu_translations.short_description','menu_translations.long_description','menu_translations.locale');

    }
}
