@extends('layout')

@section('title')
    Edit
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>User Edit </h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form action="{{route('users_update', ['id' => $user->id])}}" method="post"
                      class="form-horizontal form-label-left">

                    @include('users.form', ['errors' => $errors, 'user' => $user])

                    <div class="ln_solid"></div>
                    <div class="form-group ">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                            <a href="{{route('users')}}" class="btn btn-default">Back</a>
                            <input type="submit" value="Update" class="btn btn-info">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
