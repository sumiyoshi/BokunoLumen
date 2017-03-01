@extends('layout')

@section('title')
    edit
@endsection

@section('content')
    <form action="{{route('users_update', ['id' => $user->id])}}" method="post">
        @include('users.form', ['errors' => $errors, 'user' => $user])
        <input type="submit" value="SEND">
    </form>
@endsection
