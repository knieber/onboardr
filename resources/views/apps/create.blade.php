@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add An App for <strong>{{$role->name}}</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url("/app/roles/$role->id/apps") }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('app') ? ' has-error' : '' }}">
                                <label for="app" class="col-md-4 control-label">App</label>

                                <div class="col-md-6">
                                    <select id="app" class="form-control" name="app" required>
                                        <option value="GitHub">GitHub</option>
                                    </select>

                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="app_email" class="col-md-4 control-label">App Admin Email Address</label>

                                <div class="col-md-6">
                                    <input id="app_email" type="email" class="form-control" name="app_email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('app_password') ? ' has-error' : '' }}">
                                <label for="app_password" class="col-md-4 control-label">App Admin Password</label>

                                <div class="col-md-6">
                                    <input id="app_password" type="password" class="form-control" name="app_password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection