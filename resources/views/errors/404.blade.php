@extends('errors::layout')

@section('title', __('Not Found'))
@section('gif')
<img src="{{ asset('img/404.gif') }}" alt="Not Found">
@endsection
@section('code', '404')
@section('message', __('Not Found'))
