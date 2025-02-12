<?php

namespace App\Models;

use App\Http\Requests\Post;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'post_id',   // ID of the post the comment belongs to
        'user_id',   // ID of the user who created the comment
        'description',
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
