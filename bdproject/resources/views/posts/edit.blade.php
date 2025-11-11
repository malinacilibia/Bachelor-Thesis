@extends('layouts.app')

@section('content')
    <h1>Edit post</h1>
    {!! Form::open(['route' => ['posts.update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title ,['class' => 'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $post->body ,['class' => 'form-control','placeholder'=>'Body'])}}
    </div>
    <!-- Breed -->
    <div class="form-group">
        {{ Form::label('breed', 'Breed') }}
        {{ Form::text('breed', $post->breed, ['class' => 'form-control', 'placeholder' => 'Breed']) }}
    </div>

    <!-- Age -->
    <div class="form-group">
        {{ Form::label('age', 'Age') }}
        {{ Form::number('age', $post->age, ['class' => 'form-control', 'placeholder' => 'Age']) }}
    </div>

    <!-- Behavior -->
    <div class="form-group">
        {{ Form::label('behavior', 'Behavior') }}
        {{ Form::text('behavior', $post->behavior, ['class' => 'form-control', 'placeholder' => 'Behavior']) }}
    </div>

    <!-- Gender -->
    <div class="form-group">
        {{ Form::label('gender', 'Gender') }}
        {{ Form::select('gender', ['masculin' => 'Masculin', 'feminin' => 'Feminin'], $post->gender, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}


@endsection
