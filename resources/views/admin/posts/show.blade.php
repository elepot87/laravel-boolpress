@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">{{ $post->title }}</h1>

    <h4 class="mb-3">{{ $post->created_at->isoFormat('dddd DD/MM/YYYY') }}</h4>
    <h4 class="mb-3">{{ $post->created_at->diffForHumans() }}</h4>

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
        <div class="{{ $post->cover ? 'col-md-6' : 'col' }}">
            {!! $post->content !!}
        </div>
        @if ($post->cover)
        <div class="col-md-6">
            <img class="img-fluid" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
        </div>

        @endif

    </div>

    @if (! $post->tags->isEmpty())
    <h5 class="mt-3">Tags</h5>

    @foreach ($post->tags as $tag)
    <span class="badge badge-primary">
        {{ $tag->name }}
    </span>
    @endforeach
    @else
    <p class="mt-3"> <strong>No tags for this post.</strong></p>
    @endif

</div>
@endsection