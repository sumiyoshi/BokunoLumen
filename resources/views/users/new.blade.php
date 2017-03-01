@extends('layout')

@section('title')
    new
@endsection

@section('content')
    <form action="{{route('users_create')}}" method="post">
        @include('users.form', ['errors' => $errors, 'user' => $user])
        <input type="submit" value="SEND">
    </form>
@endsection
