<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;
    protected $table='post_translations';
    protected $fillable=['id','post-id','name','short_description','long_description','locale'];

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}
