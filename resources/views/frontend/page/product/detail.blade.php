@extends('frontend.layout.layout')

@section('title', $item->name)

@section('content')
    <div class="wrapper" id="app">
        <product-detail></product-detail>
    </div>
@endsection