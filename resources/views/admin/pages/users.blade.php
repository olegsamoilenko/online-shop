@extends('layouts.admin')

@section('content')

    <users-admin :user="{{ Auth::user() }}"></users-admin>


@endsection
