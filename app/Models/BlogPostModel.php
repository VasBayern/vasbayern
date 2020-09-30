<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostModel extends Model
{
    use HasFactory;

    public $table = 'content_post';

    public function category()
    {
        return $this->belongsTo('App\Models\BlogCategoryModel','category_id','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\AdminModel','author_id','id');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\BlogCommentModel','post_id','id');

    }
}
