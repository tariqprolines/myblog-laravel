<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomeController extends Controller
{
  /*
    When user Land on website this controller run
  */
    public function index()
    {
        $posts= POST::orderby('id', 'DESC')->paginate(10);
        return view('home',['posts' => $posts]);
    }
    public function post_detail($id){
      $post = POST::find($id);
      return view('post_detail',['post' => $post]);
    }
    public function postsbycategory($id){
       $posts=Post::where('cat_id', '=', $id)->paginate(15);
       return view('home',['posts' => $posts]);
    }
    public function search(Request $request){
      $request->validate([
        'search' => 'required'
      ]);
      $s=$request->search;
      $category = Category::where('name', '=', $s)->first();
      if(!empty($category->id)){
        $id=$category->id;
      }else{
        $id=NULL;
      }
      $posts=Post::where('title', 'Like', "%{$s}%")
              ->orwhere('cat_id', '=', $id)
              ->paginate(15);
      return view('home',['posts' => $posts]);
    }
}
