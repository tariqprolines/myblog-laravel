@extends('layouts.admin')
@section('title')
  Laravel | Edit Post
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- error message -->
  @if ($errors->any())
      <div class="alert alert-danger m-2">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Post</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Post</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Post</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('admin.storepost')}}" enctype="multipart/form-data">
              {{@csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="title" id="name" value="{{$post->title}}" placeholder="Enter Title">
                </div>
                <div class="form-group">
                  <label for="name">Description</label>
                  <textarea name="description" class="form-control" id="description" rows="3">{{$post->description}}</textarea>
                </div>
                <div class="form-group">
                  <label for="name">Categories</label>
                  <select class="form-control" name="cat_id" id="exampleFormControlSelect1">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{$post->cat_id == $category->id?'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Uploaded Image</label><br/>
                  <input type="hidden" name="uploaded_avatar" value="{{$post->avatar}}"/>
                  <img src="{{ asset('uploads/'.$post->avatar) }}" class="img-fluid img-thumbnail" alt="{{$post->avatar}}" title="{{$post->avatar}}" width="200" height="200"/>
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="featured_image" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Featured Image</label>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
