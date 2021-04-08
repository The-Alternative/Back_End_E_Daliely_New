<?php

namespace App\Models\Brands;

use App\Models\Language\Language;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

//    protected $table='brands';

    protected $fillable=['id','name','slug','description','image','is_active'];

    public function language()
    {
        return $this->belongsToMany(language::class);
    }
}
