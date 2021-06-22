<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class AppointmentScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->join('appointment_translations','appointment_translations.appointment_id','=','appointments.id')
            ->where('appointment_translations.locale','=', config::get('app.local'))
            ->select('appointments.id','appointments.is_active','appointments.is_approved',
                'appointment_translations.description');
    }
}
