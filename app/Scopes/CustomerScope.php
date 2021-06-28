<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class CustomerScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->join('customer_translations','customer_translations.customer_id','=','customers.id')
            ->where('customer_translations.locale','=',config::get('app.locale'))
            ->select('customers.id','customers.is_active','customers.is_approved',
                'customer_translations.first_name', 'customer_translations.last_name',
                'customer_translations.address' ,'customer_translations.locale');
    }

}
