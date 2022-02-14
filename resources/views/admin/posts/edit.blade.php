@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Edit: {{$post->title}}</h1>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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

        <!-- Categories  -->
        <div class="mb-3">
            <label for="category_id">
                Category
            </label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Uncategorized</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($category->id == old('category_id', $post->category_id))
                    selected @endif>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            <!-- Visualizzazione mirata per l'errore -->
            @error('category_id')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <!-- Tags -->
        <div class="mb-3">
            <h4>Tags</h4>

            @foreach ($tags as $tag)
            <span class="d-inline-block mr-4">
                <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}"
                    @if($errors->any() && in_array($tag->id, old('tags')))
                checked
                @elseif(!$errors->any() && $post->tags->contains($tag->id))
                checked
                @endif>
                <label for="tag{{ $loop->iteration }}">
                    {{ $tag->name }}
                </label>
            </span>
            @endforeach
            <!-- Visualizzazione mirata per l'errore -->
            @error('tags')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <!-- Image cover post -->
        <div class="mb-4">
            <label class="form-label" for="cover"> <strong>Post Image</strong></label>
            @if($post->cover)
            <img width="200" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
            @endif
            <input type="file" name="cover" id="cover" class="form-control-file">
            <!-- Visualizzazione mirata per l'errore -->
            @error('cover')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button class="btn btn-warning" type="subit">Edit</button>
    </form>

</div>
@endsection