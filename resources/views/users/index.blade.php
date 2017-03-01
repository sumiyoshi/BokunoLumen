@extends('layout')

@section('title')
タイトル
@endsection


@section('content')
    <h1>Hi {{ $name }} !!</h1>
    <h2>ID is {{ $id }} .</h2>
@endsection
