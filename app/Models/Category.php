<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
       'name'
    ];
    protected $table ="categories";
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function users(){
        return $this->hasManyThrough(User::class,Post::class,'category_id','id','id','user_id');
    }

}
