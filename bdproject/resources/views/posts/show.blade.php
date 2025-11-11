@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default"> Go back</a>

    <h1>{{$post->title}}</h1>
    <div class="row">
        <div class="col-md-12">
            <img style="width: 50%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
        </div>
    </div>
    <p>{{$post->body}}</p>
    <h4>Details</h4>
    <p><strong>Breed:</strong> {{ $post->breed }}</p>
    <p><strong>Age:</strong> {{ $post->age }} years</p>
    <p><strong>Behavior:</strong> {{ $post->behavior }}</p>
    <p><strong>Gender:</strong> {{ ucfirst($post->gender) }}</p>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    <a href="{{ route('adoption.form', ['post_id' => $post->id]) }}" class="btn btn-primary">
        Adoptă-mă acum
    </a>


@endsection
