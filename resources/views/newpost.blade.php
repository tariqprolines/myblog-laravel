@extends('layouts.app')

@section('title')
  Blog | Add New Post
@endsection
@section('content')
  <h3>Add New Post</h3>
  <form method="post" action="{{route('storepost')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" class="form-control" id="description" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Categories</label>
      <select class="form-control" name="cat_id" id="exampleFormControlSelect1">
        @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <div class="custom-file">
        <input type="file" name="featured_image" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Featured Image</label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
