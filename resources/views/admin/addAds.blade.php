@extends('layout.admin')
@section('title', 'Add Ads')

@section('custom-style')
    <style>

    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'ad', 'subtitle'=>'addAds'])
@endsection

@section('content')
    this is Add Ads page
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@show
