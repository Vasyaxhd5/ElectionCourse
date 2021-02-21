<?php

namespace App\Http\Controllers;

use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $electionId = stristr($request->get('election_id'), '/', true);
        $candidateId =stristr($request->get('candidate_id'), '/', true);
        $votes = Votes::findVote($userId,$candidateId,$electionId);
        $votesInElection =Votes::findVoteInElection($userId,$electionId);

        if(!$votes && $votesInElection) {

            return redirect('/election/' . $electionId)->with('existInThisElection',
                'You cannot vote for more than 1 candidate!');
        }
       else if(!$votes && !$votesInElection){
            $vote = new Votes([
                'user_id'=>$userId,
                'candidate_id'=>$candidateId,
                'election_id'=>$electionId
            ]);
          //  dd($vote);
            $vote->save();
            return redirect('/election/'.$electionId)->with('success', 'Vote saved!');
        }
        else
        return redirect('/election/'.$electionId)->with('exist', 'Your vote ia allready exist!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $userId = Auth::user()->id;
        $electionId = stristr($request->get('election_id'), '/', true);
        $candidateId =stristr($request->get('candidate_id'), '/', true);
        $voteFind = Votes::findVote($userId,$candidateId,$electionId);
        if($voteFind) {
            $vote = Votes::find($voteFind->id);
            $vote->delete();
            return redirect('/election/'.$electionId)->with('alert', 'Vote deleted!');
        }
         else
         return redirect('/election/'.$electionId)->with('notExist', 'Your vote is not exist');
    }
}
