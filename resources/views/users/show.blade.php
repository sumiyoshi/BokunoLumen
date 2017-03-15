@extends('layout')

@section('title')
    Show
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Show </h2>
                <div class="text-right">
                    <form action="{{route('users_delete',['id' => $user->id])}}" method="post">
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <div class="form-horizontal form-label-left">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p class="form-control col-md-7 col-xs-12"> {{$user->id}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mail
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p class="form-control col-md-7 col-xs-12"> {{$user->mail}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p class="form-control col-md-7 col-xs-12"> {{$user->name}}</p>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group ">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                            <a href="{{route('users')}}" class="btn btn-default">Back</a>
                            <a href="{{route('users_edit', ['id' => $user->id])}}" class="btn btn-success">Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
