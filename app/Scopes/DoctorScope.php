<?php


namespace App\Scopes;


use App\Models\Doctors\doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class DoctorScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.locale','=',Config::get('app.locale'))
            ->select('doctors.id','doctors.is_active','doctors.is_approved',
                'doctor_translation.first_name','doctor_translation.last_name','doctor_translation.description')->get();
    }
}
