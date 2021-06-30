<?php


namespace App\Scopes;

use App\Models\Doctors\DoctorTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class DoctorScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
      $builder->join('doctor_translation','doctors.id','=','doctor_translation.doctor_id')
          ->where('doctor_translation.locale','=',config::get('app.locale'))
          ->select(['doctors.id','doctors.is_active','doctors.is_approved','doctors.image',
              'doctor_translation.first_name', 'doctor_translation.last_name', 'doctor_translation.description']);
        $builder->join('doctor_translation','doctor_translation.doctor_id','=','doctor_id')
            ->where('doctor_translation.locale','=',Config::get('app.locale'))
            ->select('doctors.id','doctors.specialty_id','doctor_translation.*')->get();
        $builder->join('doctor_translation', 'doctors.id', '=', 'doctor_translation.doctor_id')
            ->where('doctor_translation.locale', '=', config::get('app.locale'))
            ->select(['doctors.id', 'doctors.is_active', 'doctors.is_approved', 'doctors.image',
                'doctor_translation.first_name', 'doctor_translation.last_name',
                'doctor_translation.description']);
    }
}
