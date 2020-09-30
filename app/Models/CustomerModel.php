<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    public $table = 'customers';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
