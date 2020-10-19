<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopColorModel extends Model
{
    use HasFactory;

    public $table = 'colors';

    protected $fillable = [
        'name, color',
    ];

    public function product_properties() {
        return $this->hasMany('App\Models\ShopProductProperties','color_id','id');
    }
}
