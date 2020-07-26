@extends('layouts.app')
@section('title')
  Blog | Laravel Blog Post
@endsection
@section('content')
      <div class="row">
        @forelse($posts as $post)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <a href="{{route('post-detail', $post->id)}}">
              <img src="{{ asset('uploads/'.$post->avatar) }}" class="bd-placeholder-img card-img-top"/>
            </a>
            <div class="card-body">
              <p class="card-text"><i class="fa fa-check"></i>
                <a href="{{route('postsbycategory',$post->cat_id)}}">
                   {{$post->category->name}}
                </a>
              </p>
              <p class="card-text">{{$post->title}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <p class="card-text"><i class="fa fa-user"></i> {{$post->user->name}}</p>
                </div>
                <small class="text-muted"><i class="fa fa-calendar"></i> {{$post->created_at->format('M j,Y') }}</small>
              </div>
            </div>
          </div>
        </div>
        @empty
          <p>No Data Available</p>
        @endforelse
        <p class="pull-right">
        {{ $posts->links() }}
        </p>
      </div>
@endsection
