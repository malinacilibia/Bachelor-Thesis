<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'breed', 'age', 'behavior', 'gender', 'cover_image', 'adopted'];

//    //table name
//    protected $table = 'posts';
//    //primary key
//    public $primaryKey = 'id';
//    //timestamps
////    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function images()
    {
        return $this->hasMany(CatImage::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

}
