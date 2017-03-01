@extends('layout')

@section('title')
    list
@endsection


@section('content')
    <a href="{{route('users_new')}}">new</a>

    @foreach($list as $user)

        <div>
            {{$user->id}}:<a href="{{route('users_edit',['id' => $user->id])}}">edit</a>
        </div>

    @endforeach
@endsection
