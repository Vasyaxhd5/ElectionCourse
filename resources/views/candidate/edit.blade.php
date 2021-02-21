@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit a Candidate</h1>
            <div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif

                <form enctype="multipart/form-data" method="post" action="{{ route('candidate.update', $candidate->id) }}">
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $candidate->first_name }}"/>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $candidate->last_name }}" />
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" class="form-control" name="birthday" value="{{ $candidate->birthday }}" />
                    </div>
                    <div class="form-group">
                        <label for="biography">Biography:</label>
                        <input type="text" class="form-control" name="biography" value="{{ $candidate->biography }}" />
                    </div>
                    <div class="form-group">
                        <label for="file">File:</label>
                        <input type="file" class="form-control" name="filename"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Candidate</button>
                </form>
            </div>
        </div>
    </div>
@endsection
