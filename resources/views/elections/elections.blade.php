@extends('base')

@section('main')

    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Elections</h1>
            @if( Auth::user() && ( Auth::user()->hasRole('Admin') ) )
            <a href="{{ route('election.create') }}" class="mb-3 btn btn-primary">Add Election</a>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Tittle</td>
                        <td>Start Date</td>
                        <td>Finish Date</td>
                        <td>Candidates List</td>
                        <td colspan="3">Actions</td>
                    </tr>
                </thead>
                <tbody id="table_election">

                @foreach($elections as $election)
                    <tr>
                        <td>{{$election->id}}</td>
                        <td>{{$election->tittle}}</td>
                        <td>{{$election->start_dt}}</td>
                        <td>{{$election->finish_dt}}</td>
                    <td>
                        @foreach(App\Models\Candidats::getByElectionId($election->id) as $candidate)
                        <p>{{$candidate->first_name}} {{$candidate->last_name}}, {{$candidate->birthday}}</p>
                        @endforeach
                    </td>

                        <td>
                            @if( Auth::user() && ( Auth::user()->hasRole('Admin') ) )
                                <a href="{{ route('election.edit',$election->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('election.show',$election->id)}}" class="btn btn-primary">View</a>
                        </td>
                        <td>
                            @if( Auth::user() && (Auth::user()->hasRole('Admin') ) )
                                <form action="{{ route('election.destroy', $election->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>

        </div>
    </div>


@endsection
