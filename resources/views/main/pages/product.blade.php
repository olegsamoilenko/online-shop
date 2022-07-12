@extends('layouts.main')

@section('content')

    <product-main :category="{{$category}}" :product="{{ $product }}"></product-main>

@endsection
