@extends('layouts.app')
@section('title')
  Blog | {{$post->title}}
@endsection
@section('content')
    <div class="blog-post">
      <p class="text-center">
        <img src="{{ asset('uploads/'.$post->avatar) }}" class="img-fluid"/>
      </p>
      <h2 class="blog-post-title">{{$post->title}}</h2>
      <p class="blog-post-meta">{{$post->created_at->format('M j,Y')}} by <a href="#">{{$post->user->name}}</a>, Category: <a href="{{route('postsbycategory',$post->cat_id)}}">{{$post->category->name}}</a></p>
      <hr>
      <p>{{$post->description}}</p>
    </div>
@endsection
