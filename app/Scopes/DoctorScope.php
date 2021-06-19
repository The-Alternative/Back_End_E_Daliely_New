<?php


namespace App\Scopes;

use App\Models\Doctors\DoctorTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Scope;
class DoctorScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
//        $builder->join(DoctorTranslation::class,'doctors.id','=','doctor_translation.doctor_id')
//            ->where('doctor_translation.locale','=',config::get('app.locale'))
//            ->get(['doctors.id','doctors.is_active','doctors.is_approved']);

//        $builder->where('is_active','=',1);
    }

}
