@extends('layouts.main')

@section('title', "Create Post")

@section('content')
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 pl-10">
                                <a href="{{route('post.index')}}" class="btn btn-secondary mb-3 col-2"><i class="bi bi-arrow-left"></i> Back</a>
                                <form action="{{route('post.store')}}" method="POST">
                                    @csrf
                                    <legend>Create Post</legend>
                                    <div class="mb-3">
                                        <label for="postTitle" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border-dark" value="{{ old('name') }}" id="postTitle" aria-describedby="postTitle" required>
                                    </div>
                                    @error('title')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="postSlug" class="form-label">Slug</label>
                                        <input type="text" class="form-control border-dark" value="{{ old('slug') }}" id="postTitle" name="slug" aria-describedby="postSlug" required>
                                    </div>
                                    @error('slug')
                                        <div class="form-text text-danger" >{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="postContent" class="form-label">Content</label>
                                        <textarea class="form-control border-dark" id="postContent" name="content" rows="3"  required>{{ old('content') }}</textarea>
                                    </div>
                                    @error('content')
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
