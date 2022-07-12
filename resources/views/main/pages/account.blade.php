@extends('layouts.main')

@section('content')

    <account-main :user="{{ Auth::user()->load('roles') }}"></account-main>

@endsection
