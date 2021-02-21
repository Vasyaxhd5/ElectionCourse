<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ElectionCandidat extends Model
{
    use HasFactory;

    protected $fillable = [
        'election_id',
        'candidate_id',
    ];

    public static function deleteByElectionId($id) {

        $electionCandidats = DB::table('election_candidats')
            ->where('election_id', '=', $id)->get();
        foreach ($electionCandidats as $electionCandidat)
        {
            $elCandForDelete =ElectionCandidat::find($electionCandidat->id);
            $elCandForDelete->delete();
        }

    }

}
