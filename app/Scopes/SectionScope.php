<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



class SectionScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('section_translations', 'sections.id', '=','section_translations.section_id' )
            ->where('section_translations.local','=',get_current_local())
            ->select(['sections.*','section_translations.name','section_translations.description','section_translations.local']);
    }
}
