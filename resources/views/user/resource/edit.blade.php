@extends('layouts.main')

@section('title', "Edit User")

@section('content')
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 pl-10">
                                <a href="{{route('user.index')}}" class="btn btn-secondary mb-3 col-2"><i class="bi bi-arrow-left"></i> Back</a>
                                <form action="{{route('user.update', [$item->id])}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <legend>Edit User</legend>
                                    <div class="mb-3">
                                        <label for="userName" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border-dark" value="{{$item->name}}" id="userName" aria-describedby="userName" required>
                                    </div>
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email</label>
                                        <input type="text" class="form-control border-dark" value="{{$item->email }}" id="userEmail" name="email" aria-describedby="userEmail" required>
                                    </div>
                                    @error('email')
                                        <div class="form-text text-danger" >{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control border-dark" value="{{$item->email }}" id="userPassword" name="password" aria-describedby="userPassword" required>
                                    </div>
                                    @error('password')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                    @error('system')
                                    <div id="inputEmail" class="form-text text-danger mb-3">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
