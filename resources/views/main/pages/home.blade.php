@extends('layouts.main')

@section('content')


    <home-main :categories="{{$categories}}" :products="{{$products}}" :tag="{{$tag}}" :images="{{$images}}"></home-main>

@endsection
