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
    public function tag(){
        return $this->belongsToMany(Tag::class);
    }
}
