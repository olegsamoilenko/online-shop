@extends('layouts.admin')

@section('content')

    <tags-admin :tags="{{ $tags }}"></tags-admin>

@endsection
