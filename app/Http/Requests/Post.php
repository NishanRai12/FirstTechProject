<?php

namespace App\Http\Requests;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'caption',
        'post_image',
    ];
    protected $table ="posts";


    //
    public function comments(){
        return $this->hasMany(Comments::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }

}
