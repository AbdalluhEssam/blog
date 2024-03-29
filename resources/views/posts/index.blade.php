@extends('layouts.app')

@section('content')

    @section('title')
        Home
    @endsection
    <div class="text-xl-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
    </div>
    <br>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($allPosts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>
                    <div class="card" style="width: 4rem;">
                        <img src="{{ asset($post->image) }}" class="card-img-top" alt="...">
                    </div>
                </td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('posts.show',$post->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary">Edit</a>
                    <form style="display: inline;" action="{{ route('posts.destroy',$post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
@endsection
