@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Create new post</h1>

    <!-- Lista di erorri -->
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title*</label>
            <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}">
            <!-- Visualizzazione mirata per l'errore -->
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content*</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"
                value="{{old('content')}}"></textarea>
            <!-- Visualizzazione mirata per l'errore -->
            @error('content')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <!-- Categories -->
        <div class="mb-3">
            <label for="category_id">
                Category
            </label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Uncategorized</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>
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
                    @if(in_array($tag->id, old('tags', []))) checked @endif>

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
            <input type="file" name="cover" id="cover" class="form-control-file">
            <!-- Visualizzazione mirata per l'errore -->
            @error('cover')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="subit">Create</button>
    </form>

</div>
@endsection