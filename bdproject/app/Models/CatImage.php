<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatImage extends Model
{
    use HasFactory;
    protected $fillable = ['image_path', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
