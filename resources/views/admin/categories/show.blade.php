@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">
        {{$category->name}}
    </h1>
    @foreach ($category->posts as $post)
        <article class="my-4">
            <h2>{{$post->title}}</h2>
            <a class="btn btn-success" href="{{route('admin.posts.show', $post->slug)}}">Show</a>
            <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
            <hr>
        </article>     
    @endforeach
</div>
@endsection