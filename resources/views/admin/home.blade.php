@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Welcome to {{ Auth::user()->name }}'s Dashboard</h1>
                </div>

                <div class="card-body">
                   <h2>What's next?</h2>
                   <ul>
                       <li>
                           <a href="#">Lorem ipsum dolor</a>
                        </li>
                         <li>
                           <a href="#">Lorem ipsum dolor</a>
                        </li>
                         <li>
                           <a href="#">Lorem ipsum dolor</a>
                        </li>
                   </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
