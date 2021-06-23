@extends('frontend.layout.layout')

@section('title','Bá Quý - B19DCCN536')

@section('content')
    <div class="wrapper enable-header-transparent" id="app">
        <div class="breadcrumb-area bg--white-6 breadcrumb-bg-1 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Login &amp; Register</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="https://demo.hasthemes.com/airi-preview/airi/index.html">Home</a></li>
                            <li class="current"><span>Login Register</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <login></login>
    </div>
@endsection