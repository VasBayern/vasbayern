<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    public $table = 'comments';

    public function product() {
        return $this->belongsTo('App\Models\ShopProductModel','product_id', 'id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
