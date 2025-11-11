@extends('layouts.app')

@section('content')
    <h1>Create post</h1>
    {!! Form::open(['route' => 'posts.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '',['class' => 'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '',['class' => 'form-control','placeholder'=>'Body'])}}
    </div>
    <div class="form-group">
        {{Form::label('breed', 'Breed')}}
        {{Form::text('breed', '',['class' => 'form-control','placeholder'=>'Breed'])}}
    </div>
    <div class="form-group">
        {{Form::label('age', 'Age')}}
        {{Form::number('age', '',['class' => 'form-control','placeholder'=>'Age'])}}
    </div>
    <div class="form-group">
        {{Form::label('behavior', 'Behavior')}}
        {{Form::text('behavior', '',['class' => 'form-control','placeholder'=>'Behavior'])}}
    </div>
    <div class="form-group">
        {{Form::label('gender', 'Gender')}}
        {{ Form::select('gender', ['masculin' => 'Masculin', 'feminin' => 'Feminin'], null, ['class' => 'form-select']) }}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
