<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'user_id',
        'tag_name'
    ];
    protected $table ="tags";
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function posts(){
        return $this->belongsToMany(Post::class);
    }

}
