<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreFlightLogView extends Model
{
    use HasFactory;

    public static function getPreFlightLog($opsId)
    {
        $preFlightLogs = DB::table('pre_flight_log_view')
        ->where('id', $opsId)
        ->select("*")
        ->get()
        ->toArray();
        return $preFlightLogs;
    }
}
