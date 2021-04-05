<?php

namespace App\Models\custom_Fields;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom_Field extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','image','is_active'];

    public function products()
    {
        return $this->belongsToMany(Product::class)
        ->withTimestamps()
        ->withPivot(['value','description']);
    }
}
