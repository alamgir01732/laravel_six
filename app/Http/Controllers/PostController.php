<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{


    public function addCategory(){
        return view('post.addcategory');
    }

    public function storeCategory(Request $req){
        $validatedData = $req->validate([
            'name' => 'required|unique:categories|max:25|min:3',
            'slug' => 'required|unique:categories|max:25|min:3',
        ]);
        $data=array();
        $data['name']=$req->name;
        $data['slug']=$req->slug;
        $category=DB::table('categories')->insert($data);
        if($category){
            $notification=array(
                'message'=>'Successfully Category Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }

    }

    public function allCategory(){
        $i=0;
        $category=DB::table('categories')->get();
        return view('post.all_category',compact(['category','i']));
    }

    public function viewCategory($id){
        $category=DB::table('categories')->where('id',$id)->first();
        return view('post.categoryview')->with('cat',$category);

    }

    public function deleteCategory($id){
        $category=DB::table('categories')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Successfully Category Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function editCategory($id){
        $category=DB::table('categories')->where('id',$id)->first();
        return view('post.editview',compact('category'));
    }

    public function updateCategory(Request $req, $id){
        $validatedData = $req->validate([
            'name' => 'required|max:25|min:3',
            'slug' => 'required|max:25|min:3',
        ]);
        $data=array();
        $data['name']=$req->name;
        $data['slug']=$req->slug;
        $category=DB::table('categories')->where('id',$id)->update($data);
        if($category){
            $notification=array(
                'message'=>'Successfully Category Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.category')->with($notification);
        }else {
            $notification = array(
                'message' => 'Nothing to Update',
                'alert-type' => 'error'
            );
            return Redirect()->route('all.category')->with($notification);
        }
    }
}
