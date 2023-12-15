@extends('layouts.main')

@section('title', 'Sign Up')

@section('style')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <h3 class="text-center mb-4">Sign Up</h3>
                        <h4 class="text-center mb-4"><a href="/login">or Sign In</a></h4>
                        <form action="/register" method="POST" class="login-form">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" name="name" placeholder="Name" value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password" placeholder="Password"
                                       required>
                            </div>
                            @error('password')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password_confirmation" placeholder="Confirm Password"
                                       required>
                            </div>
                            @error('system')
                            <div id="inputEmail" class="form-text text-danger mb-3">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
@endsection
