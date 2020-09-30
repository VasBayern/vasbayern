<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCommentModel extends Model
{
    use HasFactory;

    public $table = 'comment_post';

    public function post() {
        return $this->belongsTo('App\Models\BlogPostModel','post_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
