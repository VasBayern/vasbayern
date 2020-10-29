<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    use HasFactory;

    public $table = 'tags';

    public function product()
    {
        return $this->belongsToMany('App\Models\ShopProductModel', 'taggables', 'product_id', 'tag_id');
    }
    public function post()
    {
        return $this->belongsToMany('App\Models\BlogPostModel', 'taggables', 'product_id', 'tag_id');
    }
}
