@extends('layouts.app')
@section('content')
    @section('title')
        Show
    @endsection
    <div class="card" style="width: 18rem;">
        <img src="{{ asset($post->image) }}" class="card-img-top" alt="...">
    </div>
    <div class="card mt-4">
        <h5 class="card-header">Post Info</h5>
        <div class="card-body">
            <h5 class="card-title">Title: {{ $post->title }}</h5>
            <p class="card-text">Description : {{ $post->description }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <h5 class="card-header">Post Creator Info</h5>
        <div class="card-body">
            <h5 class="card-title">Name : {{ $post->user->name }}</h5>
            <p class="card-text">Email : {{ $post->user->email }}</p>
            <p class="card-text">Created At: {{ $post->user->created_at }}</p>
        </div>
    </div>
@endsection
