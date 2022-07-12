@extends('layouts.admin')

@section('content')

    <one-click-orders-admin :one-click-orders="{{ $oneClickOrders }}"></one-click-orders-admin>

@endsection
