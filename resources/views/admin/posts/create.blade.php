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

    <form action="{{ route('admin.posts.store') }}" method="POST">
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

        <button class="btn btn-primary" type="subit">Create</button>
    </form>

</div>
@endsection