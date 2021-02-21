@extends('base')

@section('main')

    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="row">
                    <div class="col col-4">
                        <div class="row">
                            <div class="col-12">ID:</div>
                        </div>
                        <div class="row">
                            <div class="col-12">FirstName:</div>
                        </div>
                        <div class="row">
                            <div class="col-12">LastName:</div>
                        </div>
                        <div class="row">
                            <div class="col-12">Birthday:</div>
                        </div>
                        <div class="row">
                            <div class="col-12">Biography:</div>
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
{{--            <table class="table table-striped">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <td>ID</td>--}}
{{--                        <td>FirstName</td>--}}
{{--                        <td>LastName</td>--}}
{{--                        <td>Birthday</td>--}}
{{--                        <td>Biography</td>--}}

{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody id="table_candidate">--}}

{{--                    <tr>--}}
{{--                        <td>{{$candidate->id}}</td>--}}
{{--                        <td>{{$candidate->first_name}}</td>--}}
{{--                        <td>{{$candidate->last_name}}</td>--}}
{{--                        <td>{{$candidate->birthday}}</td>--}}
{{--                        <td>{{$candidate->biography}}</td>--}}

{{--                    </tr>--}}

{{--                </tbody>--}}
{{--            </table>--}}


            <a href="{{ route('candidate.index')}}" class="btn btn-primary">Back to candidates</a>
            <div>

        </div>
    </div>


@endsection
