@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Organizations I'm A Member Of</div>
                <div class="panel-body">
                    <ul>
                        @foreach(Auth::user()->organizations as $org)
                            @if(strtolower($org->pivot->user_type) == 'member')
                                <li><a href="{{ url("/app/organization/$org->id") }}">{{$org->name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <a class="btn btn-default" href="{{ url("/app/organization/join") }}" role="button">Join An Existing Organization</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Organizations I Manage</div>
                <div class="panel-body">
                    <ul>
                        @foreach(Auth::user()->organizations as $org)
                            @if(strtolower($org->pivot->user_type) == 'manager')
                                <li><a href="{{ url("/app/organization/$org->id/manage") }}">{{$org->name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <a class="btn btn-default" href="{{ url("/app/organization/create") }}" role="button">Create A New Organization</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
