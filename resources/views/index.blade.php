@extends('layouts.main')

@section('title', "Dashboard")

@section('content')
    <div id="wrapper">
        @include('layouts.sidebar')
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="w-9 text-center">
                                    <h1>Welcome, {{auth()->user()?->name}}</h1>
                                    <h4>Select menu item on the left</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
