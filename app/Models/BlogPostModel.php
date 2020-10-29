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
    public function user()
    {
        return $this->belongsTo('App\Models\User','author_id','id');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\BlogCommentModel','post_id','id');
    }
    public function tag()
    {
        return $this->belongsToMany('App\Models\TagModel', 'taggables', 'tag_id', 'product_id');
    }
}
