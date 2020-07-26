@extends('layouts.app')

@section('title')
  Blog | Posts
@endsection
@section('content')
  @if(Session::has('message'))
       <p class="alert alert-success">{{ Session::get('message') }}</p>
  @endif
  <div class="panel panel-primary">
      <div class="panel-heading">
  <a href="{{ route('createpost') }}"  class="btn btn-secondary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add New Post</a>
      </div>
      <div class="panel-body">
    <table class="table table-hover table-bordered table-stripped">
      <thead>
        <tr>
        <th>S.N.</th>
        <th>title</th>
        <th>Category</th>
        <th style="width:200px;">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($posts as $post)
        <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->category->name }}</td>
        <td>
          <form  method="post" action="{{ route('deletepost',$post->id) }}" class="delete_form">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a href="{{ route('editpost',$post->id) }}" class="btn btn-xs btn-primary">Edit</a>
            <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are You Sure? Want to Delete It.');">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
    <p class="pull-right">
    {{ $posts->links() }}
    </p>
      </div>
    </div>
@endsection
