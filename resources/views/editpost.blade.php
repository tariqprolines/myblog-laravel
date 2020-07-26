@extends('layouts.app')

@section('title')
  Blog | Edit Post
@endsection
@section('content')
  <h3>Add New Post</h3>
  <form method="post" action="{{route('updatepost', $post->id)}}" enctype="multipart/form-data">
    {{csrf_field()}}
    {{ method_field('PUT') }}
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" value="{{$post->title}}" class="form-control" id="title" placeholder="Enter Title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" class="form-control" id="description" rows="3">{{$post->description}}</textarea>
    </div>
    <div class="form-group">
      <label for="category">Categories</label>
      <select class="form-control" name="cat_id" id="category">
        @foreach ($categories as $category)
          <option value="{{$category->id}}" {{$post->cat_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="category">Uploaded Image</label><br/>
      <input type="hidden" name="uploaded_avatar" value="{{$post->avatar}}"/>
      <img src="{{ asset('uploads/'.$post->avatar) }}" class="img-fluid img-thumbnail" alt="{{$post->avatar}}" width="200" height="200">
    </div>
    <div class="form-group">
      <div class="custom-file">
        <input type="file" name="featured_image" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Featured Image</label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{route('posts')}}" class="btn btn-primary">Back to Posts</a>
  </form>
@endsection
