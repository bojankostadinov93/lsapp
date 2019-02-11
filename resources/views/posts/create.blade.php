@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">

        <h1>Create Post</h1>

            {!! Form::open(['action' => 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title','',['class'=>'form-control', 'placeholder' =>'Title Placeholder'])}}
            </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control', 'placeholder' =>'Body Placeholder'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}


    </div>

@endsection

