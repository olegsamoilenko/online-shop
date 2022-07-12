@extends('layouts.admin')

@section('content')

    <categories-admin :categories="{{$categories}}"></categories-admin>

@endsection
