<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperModel extends Model
{
    use HasFactory;

    public static function getDateTimeInterval($startTime, $endTime, $type)
    {
        $start = new DateTime($startTime);
        $end = new DateTime($endTime);
        $interval = $start->diff($end);
        $result = '';
        switch ($type) {
            case 0:
                $result = $interval->h;
                break;
            case 1:
                $result = $interval->days;
                break;
            case 2:
                $result = $interval->days;
                break;
            case 3:
                $result = $interval->y * 12 + $interval->m + $interval->d / 30;
                break;
            default:
                break;
        }
        return $result + 1;
    }
}
