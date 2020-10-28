<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagProductModel extends Model
{
    use HasFactory;

    public $table = 'tags';

    protected $fillable = [
        'name',
    ];

    public function tag_product() {
        return $this->belongsToMany('App\Models\ShopProductModel');
    }
}
