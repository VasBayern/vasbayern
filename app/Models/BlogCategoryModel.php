<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    use HasFactory;

    public $table = 'content_category';

    public function page() {
        return $this->hasMany('App\Models\BlogPostModel','category_id','id');
    }
}
