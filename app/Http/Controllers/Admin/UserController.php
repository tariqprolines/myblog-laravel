<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Post;
class UserController extends Controller
{
    public function index(){
      $users= User::where('role_id','2')->orderby('id', 'DESC')->paginate(10);
      return view('admin.users',['users' => $users]);
    }
    public function edit($id){
      $user= User::find(decrypt($id));
      return view('admin.edituser',['user' => $user]);
    }
    public function update(Request $request, $id){
      $user = User::find($id);
      $user->name  = $request->name;
      $user->email = $request->email;
      $user->save();
      return redirect()->route('admin.users')->with('message','User updated successfully !');
    }
    public function destroy($id){
      $uid=decrypt($id);
      $user = User::find($uid)->delete();
      if($user){
        $post = Post::where('user_id',$uid)->delete();
      }
      return back()->with('message','User deleted successfully !');
    }
}
