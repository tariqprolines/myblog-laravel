<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;
class PostController extends Controller
{
    public function index(){
      $user_id= Auth::user()->id;
      $posts = Post::orderby('id', 'DESC')->where('user_id',$user_id)->paginate(10);
      return view('posts',['posts' => $posts]);
    }
    public function create() {
      $categories= Category::all();
      return view('newpost',['categories' => $categories]);
   }
   public function store(Request $request){
     $request->validate([
       'title' => 'required',
       'featured_image' => 'required'
     ]);
     $post= new Post();
     $post->cat_id = $request->cat_id;
     $post->title = $request->title;
     $post->description = $request->description;
     $post->user_id= Auth::user()->id;
     $post->save();
     //Move Uploaded File
     if($request ->hasFile('featured_image')){
       $file=$request->file('featured_image');
       $destinationPath = 'uploads';
       $file->move($destinationPath,$file->getClientOriginalName());
       $post->avatar = $file->getClientOriginalName();
     }
     return redirect()->route('posts')->with('message','Post Published Successfully !');
   }
   public function edit($id){
     $post = Post::find($id);
     $user_id = $post->user_id;
     if(Auth::user()->id == $user_id){
       $categories= Category::all();
       return view('editpost',['post' => $post , 'categories' => $categories]);
     }else{
       return redirect()->route('home');
     }
  }
   public function update(Request $request, $id){
     $post= Post::find($id);
     $post->title= $request->title;
     $post->cat_id= $request->cat_id;
     $post->description = $request->description;
     $post->user_id= Auth::user()->id;
     if($request ->hasFile('featured_image')){
       $file=$request->file('featured_image');
       $destinationPath = 'uploads';
       $file->move($destinationPath,$file->getClientOriginalName());
       $post->avatar = $file->getClientOriginalName();
     }else{
       $post->avatar=$request->uploaded_avatar;
     }
     $post->save();
     return redirect()->route('posts')->with('message','Post Updated Successfully !');
   }
   public function destroy($id){
     $post = Post::find($id)->delete();
     return back()->with('message','Post Deleted Successfully !');
   }
}
