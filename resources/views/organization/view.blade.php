@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard for {{$organization->name}}</div>
                </div>


                @foreach($roles as $role)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{$role->name }}</div>
                        <div class="panel-body">
                            <strong>Apps:</strong>
                            <ul>
                                @foreach($role->apps as $app)
                                    <li>{{$app->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
