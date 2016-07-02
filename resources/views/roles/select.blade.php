@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard for {{$organization->name}}</div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Choose a Role</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url("#") }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('app') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-4 control-label">Roles</label>

                                <div class="col-md-6">
                                    <select id="role" class="form-control" name="role" required>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
