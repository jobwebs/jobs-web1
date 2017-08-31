@extends('layout.master')
@section('title', 'Title')

@section('custom-style')

@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => true])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 1])
@endsection

@section('content')

@endsection

@section('custom-script')

@endsection
