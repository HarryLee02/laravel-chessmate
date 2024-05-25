@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('gif')
<img src="{{ asset('img/401.gif') }}" alt="Unauthorized">
@endsection
@section('code', '401')
@section('message', __('Unauthorized'))
