<?php


namespace App\Scopes;


use App\Models\Specialty\Specialty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SpecialtyScope implements \Illuminate\Database\Eloquent\Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
//        join('specialty_translation','specialty_translation.specialty_id','=','specialties.id')
        DB::table('specialty_translation')
            ->select('specialties.id','specialties.is_active',
            'specialty_translation.name','specialty_translation.description','specialty_translation.locale')
            ->where('specialties.id','=','specialty_translation.specialty_id')
            ->where('specialty_translation.locale','=',config::get('app.locale'));


        $builder->where('is_active',1);
    }
}
