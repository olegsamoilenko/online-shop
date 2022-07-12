@extends('layouts.admin')

@section('content')

    <orders-admin :orders="{{ $orders }}"></orders-admin>

@endsection
