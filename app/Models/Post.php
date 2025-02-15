<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'caption',
        'post_image'
    ];
    protected $table ="posts";
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);  // Many-to-many relationship
    }

}
