<?php

namespace App\Models\Categories;

use App\Scopes\SectionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\SectionTranslation;


class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable = [
        'slug', 'image', 'is_active'];

    public function getIsActiveAttribute($value)
    {
        return $value==1 ? 'Active' : 'Not Active';
    }
//________________ scopes begin _________________//

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new SectionScope);
    }

    //________________ scopes end _________________//

    public function SectionTranslation()
    {
        return $this->hasMany(SectionTranslation::class,'section_id');
    }
    public function Category()
    {
        return $this->hasMany(Category::class,'section_id');
    }

}
