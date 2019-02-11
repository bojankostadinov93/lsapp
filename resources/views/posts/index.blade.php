@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Posts</h1>
        @if(count($posts)>0)
            @foreach($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:100%"  src="http://localhost/lsapp/storage/app/public/cover_images/{{$post->cover_image}}">
                            <br>

                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="http://localhost/lsapp/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small> Created on {{$post->created_at}} by {{$post->user->name}}</small><br>
                        </div>
                    
                </div>
                </div>
            <hr>
            @endforeach
            {{$posts->links()}}            {{--ovoa ga dodavamo za ako samo pagination na stranite a toa kolku postovi na edna strana sakamo da ni se pojavuva ga pravemo u postsController--}}


        @else
            <p>No posts found </p>
        @endif

    </div>

@endsection