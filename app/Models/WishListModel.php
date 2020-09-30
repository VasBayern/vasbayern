<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishListModel extends Model
{
    use HasFactory;

    public $table = 'wishlist';

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product() {
        return $this->belongsTo('App\Model\ShopProductModel', 'user_id', 'id');
    }
}
