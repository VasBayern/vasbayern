<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSizeModel extends Model
{
    use HasFactory;

    public $table = 'sizes';

    protected $fillable = [
        'name',
    ];

    public function product_properties() {
        return $this->hasMany('App\Models\ShopProductProperties','size_id','id');
    }
}
