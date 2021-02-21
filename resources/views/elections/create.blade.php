@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add an Election</h1>
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

                <form enctype="multipart/form-data" method="post" action="{{ route('election.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="tittle">Tittle:</label>
                        <input type="text" class="form-control" name="tittle"/>
                    </div>
                    <div class="form-group">
                        <label for="start_dt">Start Date:</label>
                        <input type="datetime-local" class="form-control" name="start_dt"/>
                    </div>
                    <div class="form-group">
                        <label for="finish_dt">Finish Date:</label>
                        <input type="datetime-local" class="form-control" name="finish_dt"/>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="candidates[]" multiple=""  >
                            @foreach($candidates as $candidate)
                                <option value="{{ $candidate->id }}">{{ $candidate->first_name }}{{ $candidate->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Election</button>
                </form>
            </div>
        </div>
    </div>
@endsection
