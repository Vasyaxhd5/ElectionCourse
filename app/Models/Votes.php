<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Votes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'candidate_id',
        'election_id',
    ];

    public static function findVote($user_id,$candidate_id,$election_id ) {

        return DB::table('votes')
            ->where('user_id', '=', $user_id)
            ->where(  'candidate_id', '=', $candidate_id)
            ->where(  'election_id', '=', $election_id)
            ->select('id')->first();
    }

    public static function voteCount($candidate_id,$election_id ) {

        return DB::table('votes')
            ->where(  'candidate_id', '=', $candidate_id)
            ->where(  'election_id', '=', $election_id)
            ->count();
    }

    public static function findVoteInElection($user_id,$election_id ) {

        return DB::table('votes')
            ->where('user_id', '=', $user_id)
            ->where(  'election_id', '=', $election_id)
            ->select('id')->first();
    }

}
