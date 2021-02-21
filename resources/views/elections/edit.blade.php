@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit an Election</h1>
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

                <form  method="post" action="{{ route('election.update', $election->id) }}">
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <label for="tittle">Title:</label>
                        <input type="text" class="form-control" name="tittle"  value="{{ $election->tittle }}" />
                    </div>
                    <div class="form-group">
                        <label for="start_dt">Start Date:</label>
                        <input type="datetime-local" class="form-control" name="start_dt"
                               value="{{ Carbon\Carbon::parse($election->start_dt)->format('Y-m-d\TH:i') }}" />
                    </div>
                    <div class="form-group">
                        <label for="finish_dt">Finish Date:</label>

                        <input type="datetime-local" class="form-control" name="finish_dt"
                               value="{{ Carbon\Carbon::parse($election->finish_dt)->format('Y-m-d\TH:i') }}" />
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="candidates[]" multiple=""  >
                            @foreach($candidates as $candidate)
                              @if(in_array($candidate->id, $candidatesOfElection))
                                <option selected value="{{ $candidate->id }}">{{ $candidate->first_name }}{{ $candidate->last_name }}</option>
                                  @else
                                    <option value="{{ $candidate->id }}">{{ $candidate->first_name }}{{ $candidate->last_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit Election</button>
                </form>
            </div>
        </div>
    </div>
@endsection
