@extends('layout')

@section('title')
    List
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>List</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mail</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $user)
                        <tr>
                            <th scope="row">
                                <a href="{{route('users_show', ['id' => $user->id])}}">{{$user->id}}</a>
                            </th>
                            <td>{{$user->mail}}</td>
                            <td>{{$user->name}}</td>
                            <td><a href="{{route('users_edit', ['id' => $user->id])}}" class="btn btn-success">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
