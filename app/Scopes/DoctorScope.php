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
        DB::table('doctor_translation')
            ->select('doctors.id','doctors.is_active','doctors.is_approved',
                'doctor_translation.first_name', 'doctor_translation.last_name','doctor_translation.description','doctor_translation.locale')
//            ->where('doctors.id','=','doctor_translation.doctor_id');
            ->where('doctor_translation.locale','=','ar');

//        $builder->where('is_active','=',1);
    }

}
