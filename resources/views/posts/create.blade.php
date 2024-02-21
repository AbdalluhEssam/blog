@extends('layouts.app')

@section('title')
Create
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Post Creator</label>
        <select class="form-control" name="post_creator">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success">Submit</button>
</form>
@endsection
