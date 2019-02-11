@extends('layouts.app')

@section('content')
    <a href="http://localhost/lsapp/public/posts" class="btn btn-info"><< Back</a>

    <div class="jumbotron text-center">

        <h1>{{$post->title}}</h1>
        <img style="width:80%"  src="http://localhost/lsapp/storage/app/public/cover_images/{{$post->cover_image}}">
        <br>
        <div>
            {!! $post->body!!}
            </div>
        <hr>
        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>

    </div>
    @if(!auth::guest())
        @if(auth::user()->id ==$post->user_id)
    <a href="http://localhost/lsapp/public/posts/{{$post->id}}/edit" class="btn btn-primary" >Edit</a>

    {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}

        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}

    {!! Form::close()!!}
        @endif
    @endif


@endsection