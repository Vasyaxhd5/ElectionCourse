@extends('base')

@section('main')

    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Candidates</h1>
            @if( Auth::user() && ( Auth::user()->hasRole('Admin') ) )
            <a href="{{ route('candidate.create') }}" class="mb-3 btn btn-primary">Add Candidate</a>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>FirstName</td>
                        <td>LastName</td>
                        <td>Birthday</td>
                        <td>Biography</td>
                        <td colspan="3">Actions</td>
                    </tr>
                </thead>
                <tbody id="table_candidate">
                @foreach($candidates as $candidate)
                    <tr>
                        <td>{{$candidate->id}}</td>
                        <td><img src="{{'/storage/'. basename($candidate->filename)}}" style="width: 50px;height: 40px"></td>
                        <td>{{$candidate->first_name}}</td>
                        <td>{{$candidate->last_name}}</td>
                        <td>{{$candidate->birthday}}</td>
                        <td>{{$candidate->biography}}</td>
                        <td>
                            @if( Auth::user() && ( Auth::user()->hasRole('Admin') ) )
                                <a href="{{ route('candidate.edit',$candidate->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('candidate.show',$candidate->id)}}" class="btn btn-primary">View</a>
                        </td>
                        <td>
                            @if( Auth::user() && (Auth::user()->hasRole('Admin') ) )
                                <form action="{{ route('candidate.destroy', $candidate->id)}}" method="post">
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
