<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
  public function index(){
    $categories= Category::orderby('id', 'DESC')->paginate(10);
    return view('admin.categories',array('categories' => $categories));
  }
  public function create(){
    return view('admin.newcategory');
  }
  public function store(Request $request){
    $request->validate([
      'name' => 'required',
    ]);
    $category = new Category();
    $category->name = $request->name;
    $count = Category::where('name',$category->name)->count();
    if($count > 0){
      return redirect()->route('admin.categories')->with('message','Category Already Exist !');
    }else{
      $category->save();
      return redirect()->route('admin.categories')->with('message','New Category Created Successfully !');
    }
  }
  public function edit($id){
    $category = Category::find($id);
    return view('admin.editcategory',['category'=> $category]);
  }
  public function update(Request $request, $id){
    $category = Category::find($id);
    $category->name=$request->name;
    $category->save();
    return redirect()->route('admin.categories')->with('message','Category Updated Successfully !');
  }
  public function destroy($id){
    $category = Category::find($id)->delete();
    return back()->with('message','Category Deleted Successfully !');
  }
}
