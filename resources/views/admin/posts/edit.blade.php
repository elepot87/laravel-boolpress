@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Edit: {{$post->title}}</h1>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">Title*</label>
            <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
            <!-- Visualizzazione mirata per l'errore -->
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content*</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"
                value="{{ old('content', $post->content) }}">{{$post->content}}</textarea>
            <!-- Visualizzazione mirata per l'errore -->
            @error('content')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button class="btn btn-warning" type="subit">Edit</button>
    </form>

</div>
@endsection