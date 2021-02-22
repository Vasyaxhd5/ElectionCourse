@extends('base')

@section('main')

    <div class="row">
        <div class="col-12">
            <h1 class="display-5">{{$election->tittle}}</h1>

            @if ($message = Session::get('success'))
                <div class="alert alert-success font-weight-bold alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('exist'))
                <div class="alert alert-primary font-weight-bold alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('existInThisElection'))
                <div class="alert alert-primary font-weight-bold alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('notExist'))
                <div class="alert alert-primary font-weight-bold alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('alert'))
                <div class="alert alert-danger font-weight-bold alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="container">
                <div class="row">
                    <div class="col col-5">
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">ID:</div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">Title:</div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">Start Date:</div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">Finish Date:</div>
                        </div>
                    </div>
                    <div class="col col-5">
                        <div class="row">
                            <div class="col-12">{{$election->id}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{$election->tittle}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{$election->start_dt}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{$election->finish_dt}}</div>
                        </div>
                    </div>
                    <div class="col col-2">
                        <a href="{{ route('election.index')}}" class="btn btn-primary">Back to elections</a>
                    </div>
                </div>
                @if (!$isActive)
                    <div class="row">
                        <p style="font-size: 18px; font-weight: bold">Election is not active</p>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <h3 >Candidates:</h3>
                    </div>
                </div>

                <div class="row">

                        @foreach($candidates as $candidate)
                        <div class="col-4">
                            <div class="col-12">
                                <img src="{{'/storage/'. basename($candidate->filename)}}" style="width: 150px;height: 120px">
                            </div>
                            <div class="row">
                                 <div class="col-4">First Name:</div>
                                <div class="col-8">{{$candidate->first_name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4">Last Name:</div>
                                <div class="col-8">{{$candidate->last_name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4">Birthday:</div>
                                <div class="col-8">{{$candidate->birthday}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4">Biography:</div>
                                <div class="col-8">{{$candidate->biography}}</div>
                            </div>
                            <div class="row">
                                <div class="col-4">Vote count:</div>
                                <div class="col-8">{{App\Models\Votes::voteCount($candidate->id,$election->id)}}</div>
                            </div>

                            <div class="row">
                                @if ($isActive)
                                <form action="{{ route('vote.destroy',$election->id )}}" method="post">
                                    @csrf
                                    @method('DElETE')
                                    <input type="hidden" class="form-control" name="election_id" value={{ $election->id }}/>
                                    <input type="hidden" class="form-control" name="candidate_id" value={{ $candidate->id }}/>
                                    <button id="vDelete" class="btn btn-danger" type="submit">Cancel Vote</button>
                                </form>
                                <form action="{{ route('vote.store')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" class="form-control" name="election_id" value={{ $election->id }}/>
                                    <input type="hidden" class="form-control" name="candidate_id" value={{ $candidate->id }}/>
                                    <button id="vCreate" class="btn btn-success" type="submit">Vote</button>
                                </form>
                                @endif
                            </div>

                        </div>
                        @endforeach

                </div>
            </div>
            </div>

            <div>

        </div>
    </div>

@endsection
