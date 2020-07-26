<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Category;

class DashboardController extends Controller{
    public function index(){
      $users = User::all()->count();
      $categories = Category::all()->count();
      $posts = Post::all()->count();
      return view('admin.index',['users' => $users,'categories' => $categories, 'posts' => $posts]);
    }
}
