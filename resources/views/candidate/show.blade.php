@extends('base')

@section('main')

    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="row">
                    <div class="col col-4">
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">ID:</div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">FirstName:</div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">LastName:</div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">Birthday:</div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="font-weight: 700;">Biography:</div>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="row">
                            <div class="col-12">{{$candidate->id}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{$candidate->first_name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{$candidate->last_name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{$candidate->birthday}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">{{$candidate->biography}}</div>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="row">
                            <div class="col-12">Photo:</div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <img src="{{$fileLink}}" height="150" width="200">
                            </div>
                        </div>
                    </div>

            <a href="{{ route('candidate.index')}}" class="btn btn-primary">Back to candidates</a>
            <div>

        </div>
    </div>


@endsection
