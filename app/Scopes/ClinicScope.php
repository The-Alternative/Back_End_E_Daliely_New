<?php


namespace App\Scopes;


use App\Models\Clinic\Clinic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ClinicScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
       $builder->join('clinic_translation','clinic_translation.clinic_id','=','clinics.id')
            ->where('clinic_translation.locale','=', Config::get('app.locale'))
            ->select(['clinics.id','clinics.is_active','clinics.is_approved',
                'clinic_translation.name'])->get();
    }
}
