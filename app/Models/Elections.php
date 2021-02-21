<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Elections extends Model
{
    use HasFactory;

    protected $fillable = [
        'tittle',
        'start_dt',
        'finish_dt',
    ];

    public static function findLastElectionId($tittle,$start_dt,$finish_dt ) {

        return DB::table('elections')
            ->where('tittle', '=', $tittle)
            ->where(  'start_dt', '=', $start_dt)
            ->where(  'finish_dt', '=', $finish_dt)
            ->select('id')->first();

    }

    public static function checkActivity($start_dt,$finish_dt ) {
        $isActive = false;
        date_default_timezone_set('Europe/Kiev');
        $dateCurrent =  Carbon::parse(date('Y/m/d h:i:s ', time()))->format('Y-m-d\TH:i');
        $electionDateStart = Carbon::parse($start_dt)->format('Y-m-d\TH:i');
        $electionDateFinish = Carbon::parse($finish_dt)->format('Y-m-d\TH:i');
        if($dateCurrent>$electionDateStart && $dateCurrent<$electionDateFinish)$isActive = true;
        return $isActive;
    }

}
