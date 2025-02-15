<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'gender',
        'picture'
    ];
    protected $table ="profiles";

    function user(){
        return $this->belongsTo(User::class);
    }
}
