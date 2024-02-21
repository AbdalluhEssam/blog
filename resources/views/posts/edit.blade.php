@extends('layouts.app')

@section('title')
Edit
@endsection

@section('content')

<div class="card" style="width: 18rem;">
  <img src="{{ asset($post->image) }}" class="card-img-top" alt="...">
</div>
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" name="description">{{ $post->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Post Creator</label>
        <select class="form-control" name="post_creator">
            @foreach ($users as $user)
            <option @selected($post->user_id == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach


        </select>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
