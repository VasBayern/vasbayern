<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShopBannerModel extends Model
{
    use HasFactory;

    public $table = 'shop_banners';

    public static function getBannerLocations() {
        $locations = array();
        $locations[0] = 'Main banner';
        $locations[1] = 'Sale 1';
        $locations[2] = 'Sale 2';
        $locations[3] = 'Sale 3';

        return $locations;
    }

    public static function getBannerByLocation($location_id) {

        $banner = DB::table('shop_banners')->where('location_id', $location_id)->take(2)->get();

        return $banner;

    }
}
