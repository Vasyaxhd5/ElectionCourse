<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Models\Candidats;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidats::all();

        return view('candidate.candidate', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidate.create');
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
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'birthday' => 'required',
            'biography' => 'required|min:10',
            'filename' => 'required|mimes:jpg,png'
        ]);
        $file = $request->file('filename');
        //dd($file);

        $newFileName = Storage::putFile('public', new File($file->getPathname()));

        $candidate = new Candidats([
            'first_name' => $request->get('first_name'),
            'last_name' =>  $request->get('last_name'),
            'birthday' => $request->get('birthday'),
            'filename' => $newFileName,
            'biography' => $request->get('biography'),


        ]);
        $candidate->save();

          return redirect('/candidate')->with('success', 'Candidate saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = DB::table('candidats')->where('candidats.id', '=', $id)->first();
        $fileLink = '/storage/'. basename($candidate->filename);
        return view('candidate.show', compact('candidate','fileLink' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = Candidats::find($id);

        return view('candidate.edit', compact('candidate'));
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




     //  dd($request->get('filename'));
        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'birthday' => 'required',
            'biography' => 'required|min:2',
            'filename' => 'required|mimes:jpg,png',
        ]);

        $candidate = Candidats::find($id);
        Storage::delete($candidate->filename);

        $file = $request->file('filename');

        $newFileName = Storage::putFile('public', new File($file->getPathname()));


        $candidate->first_name = $request->get('first_name');
        $candidate->last_name = $request->get('last_name');
        $candidate->birthday = $request->get('birthday');
        $candidate->filename = $newFileName;
        $candidate->biography = $request->get('biography');

        $candidate->save();

        return redirect('/candidate')->with('success', 'Candidate updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidats::find($id);
        $candidate->delete();

        return redirect('/candidate')->with('success', 'Candidate deleted!');
    }
}
