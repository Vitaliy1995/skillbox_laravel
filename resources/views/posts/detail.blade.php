@extends('layouts.main')

@section('content')
    <div class="container">
        @include('posts.post')

        <hr>
        @auth
            @include('posts.history')
        @endauth

        <hr>

        @include('posts.comments')
    </div>
@endsection
