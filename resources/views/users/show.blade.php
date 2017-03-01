@extends('layout')

@section('title')
    show
@endsection


@section('content')
    <div>
        {{$user->id}}<br/>
    </div>
    <div>
        {{$user->name}}<br/>
    </div>
    <div>
        {{$user->login_id}}
    </div>
    <div>
        {{$user->mail}}
    </div>

    <form action="{{route('users_edit',['id' => $user->id])}}" method="get">
        <input type="submit" value="EDIT">
    </form>

    <form action="{{route('users_delete',['id' => $user->id])}}" method="post">
        <input type="submit" value="DELETE">
    </form>
@endsection
