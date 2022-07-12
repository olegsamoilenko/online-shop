@extends('layouts.main')

@section('content')

    <search-result-main :products="{{ $products }}"></search-result-main>

@endsection
