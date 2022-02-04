@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{$post->title}}</h1>

    <div class="mb-5">
        <div class="mb-3">
            <strong>Category</strong>:
            <!-- Verifica se post category non è null, quindi è valore truthy -->
            @if ($post->category)
            {{$post->category->name}}
            @else Uncategorized
            @endif
        </div>
        <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
        <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Back to archive</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{!! $post->content !!}}
        </div>
        <div class="col-md-6">
            image here
        </div>
    </div>

    @if (! $post->tags->isEmpty())
    <h5>Tags</h5>

    @foreach ($post->tags as $tag)
    <span class="badge badge-primary">
        {{ $tag->name }}
    </span>
    @endforeach
    @else
    <p>No tags for this post.</p>
    @endif

</div>
@endsection