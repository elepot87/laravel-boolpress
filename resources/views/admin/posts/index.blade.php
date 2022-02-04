@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-10">
            <section>
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
                                <th>Category</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>
                                    @if ($post->category)
                                    <a
                                        href="{{route('admin.category', $post->category->id)}}">{{$post->category->name}}</a>
                                    @else Uncategorized
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success"
                                        href="{{route('admin.posts.show', $post->slug)}}">SHOW</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">EDIT</a>
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
            </section>
        </div>
        <div class="col-12 col-lg-2">
            <section>
                <div class="container">
                    <h3>Posts by Tag</h3>

                    @foreach ($tags as $tag)
                    <h4>{{ $tag->name }}</h4>

                    @if($tag->posts->isEmpty())
                    <p>No post for this tag</p>
                    @else
                    <ul>
                        @foreach ($tag->posts as $post)
                        <li>
                            <a href="{{ route('admin.posts.show', $post->slug) }}">
                                {{ $post->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    @endforeach
                </div>
            </section>
        </div>
    </div>


</div>



@endsection