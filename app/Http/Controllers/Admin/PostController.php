<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;

class PostController extends Controller
{
  public function index(){
    $posts = Post::orderby('id', 'DESC')->paginate(10);
    return view('admin.posts',['posts' => $posts]);
  }
  public function create() {
    $categories= Category::all();
    return view('admin.newpost',['categories' => $categories]);
 }
 public function store(Request $request){
   $request->validate([
     'title' => 'required',
     'featured_image' => 'required'
   ]);
   $post= new POST();
   $post->cat_id = $request->cat_id;
   $post->title = $request->title;
   $post->description = $request->description;
   $post->user_id= Auth::user()->id;
   //Move Uploaded File
   if($request ->hasFile('featured_image')){
     $file=$request->file('featured_image');
     $destinationPath = 'uploads';
     $file->move($destinationPath,$file->getClientOriginalName());
     $post->avatar = $file->getClientOriginalName();
   }
   $post->save();
   return redirect()->route('admin.posts')->with('message','Post Published Successfully !');
 }
 public function edit($id){
   $post = Post::find($id);
   $user_id = $post->user_id;
   $categories= Category::all();
  return view('admin.editpost',['post' => $post , 'categories' => $categories]);
}
 public function update(Request $request, $id){
   $post= Post::find($id);
   $post->title= $request->title;
   $post->cat_id= $request->cat_id;
   $post->description = $request->description;
   $post->user_id= Auth::user()->id;
   if($request ->file('featured_image')){
     $file=$request->file('featured_image');
     $destinationPath = 'uploads';
     $file->move($destinationPath,$file->getClientOriginalName());
     $post->avatar = $file->getClientOriginalName();
   }else{
     $post->avatar=$request->uploaded_avatar;
   }
   $post->save();
   return redirect()->route('admin.posts')->with('message','Post Updated Successfully !');
 }
 public function destroy($id){
   $post = Post::find($id)->delete();
   return back()->with('message','Post Deleted Successfully !');
 }
}
