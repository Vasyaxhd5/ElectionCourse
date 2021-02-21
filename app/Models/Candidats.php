<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidats extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'filename',
        'biography',

    ];

    public static function getByElectionId($id) {

        return DB::table('candidats')
            ->join('election_candidats', 'candidats.id', '=', 'election_candidats.candidate_id')
            ->join('elections', 'elections.id', '=', 'election_candidats.election_id')
            ->where('election_id', '=', $id)
            ->select('candidats.filename as filename','candidats.id as id','candidats.first_name as first_name','candidats.last_name as last_name'
                ,'candidats.birthday as birthday', 'candidats.biography as biography')
            ->get();

    }
    public static function getCandidatesIdByElectionId($id) {

        return DB::table('candidats')
            ->join('election_candidats', 'candidats.id', '=', 'election_candidats.candidate_id')
            ->join('elections', 'elections.id', '=', 'election_candidats.election_id')
            ->where('election_id', '=', $id)
            ->select('candidats.id as id')
            ->pluck('id')->toArray();

    }
}
