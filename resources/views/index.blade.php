@extends('rh::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('rh.name') !!}</p>
@endsection
