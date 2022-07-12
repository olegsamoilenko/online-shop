@extends('layouts.admin')

@section('content')

    <products-admin :products="{{$products}}" :categories="{{$categories}}" :tags="{{$tags}}"></products-admin>

@endsection
