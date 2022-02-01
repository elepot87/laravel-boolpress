@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog Posts</h1>
    @if ($posts->isEmpty())
    <p>No posts found yet.
        <a href="{{route('admin.posts.create')}}">Create a new one</a>
    </p>
    @else

    @if(session('delete'))
    <div class="alert alert-success">
        <strong>{{session('delete')}}</strong> eliminato con successo.
    </div>
    @endif

    <table class="table my-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>
                    <a href="{{route('admin.posts.show', $post->slug)}}">SHOW</a>
                </td>
                <td>
                    <a href="{{route('admin.posts.edit', $post->id)}}">EDIT</a>
                </td>
                <td>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection