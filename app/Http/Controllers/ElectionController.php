<?php

namespace App\Http\Controllers;

use App\Models\ElectionCandidat;
use App\Models\Elections;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Candidats;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elections = Elections::all();

        return view('elections.elections', compact('elections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $candidates = Candidats::all();

        return view('elections.create', compact('candidates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tittle' => 'required|min:5',
            'start_dt' => 'required',
            'finish_dt' => 'required',
        ]);

        $election = new Elections([
            'tittle' => $request->get('tittle'),
            'start_dt' =>  $request->get('start_dt'),
            'finish_dt' => $request->get('finish_dt'),
        ]);
        $election->save();

        $electionId = Elections::findLastElectionId($request->get('tittle'),$request->get('start_dt'),$request->get('finish_dt'));

        for ($i=0;$i< count($request->get('candidates'));$i++){
            $electionCandidate = new ElectionCandidat([
                'election_id' =>$electionId->id,
                'candidate_id' =>$request->get('candidates')[$i],
            ]);
            $electionCandidate->save();
        }
        return redirect('/election')->with('success', 'Election saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $election =Elections::find($id);
        $isActive = Elections::checkActivity($election->start_dt, $election->finish_dt);
        $candidates = Candidats::getByElectionId($id);

        return view('elections.show', compact('election', 'candidates', 'isActive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $candidates = Candidats::all();
        $election = Elections::find($id);
        $candidatesOfElection =Candidats::getCandidatesIdByElectionId($id);

        return view('elections.edit', compact('election', 'candidates', 'candidatesOfElection'));
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
        $request->validate([
            'tittle' => 'required|min:5',
            'start_dt' => 'required',
            'finish_dt' => 'required',
        ]);

        $election = Elections::find($id);
        $election->tittle = $request->get('tittle');
        $election->start_dt = $request->get('start_dt');
        $election->finish_dt = $request->get('finish_dt');
        $election->save();
        ElectionCandidat::deleteByElectionId($id);

        for ($i=0;$i< count($request->get('candidates'));$i++){
            $electionCandidate = new ElectionCandidat([
                'election_id' =>$id,
                'candidate_id' =>$request->get('candidates')[$i],
            ]);
            $electionCandidate->save();
        }

        return redirect('/election')->with('success', 'Election saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $election = Elections::find($id);
        $election->delete();
        ElectionCandidat::deleteByElectionId($id);

        return redirect('/election')->with('success', 'Election deleted!');
    }
}
