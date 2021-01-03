<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PostimController extends Controller
{
    public function writePost(){
        $category=DB::table('categories')->get();
        return view('post.writepost',compact('category'));
    }

    public function storePost(Request $req){
        $validatedData = $req->validate([
            'title' => 'required|max:125',
            'details' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png,PNG | max:3000',
        ]);
        $data=array();
        $data['title']=$req->title;
        $data['category_id']=$req->category_id;
        $data['details']=$req->details;
        $image=$req->file('image');
        if($image) {
            $image_name=strtolower(Str::random(6));
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function allPost(){
        $i=0;
        $post=DB::table('posts')
                ->join('categories','posts.category_id','categories.id')
                ->select('posts.*','categories.name')
                ->get();
        return view('post.allpost',compact(['post','i']));
    }

    public function viewPost($id){

        $post=DB::table('posts')
            ->join('categories','posts.category_id','categories.id')
            ->select('posts.*','categories.name')
            ->where('posts.id',$id)
            ->first();
        return view('post.viewpost',compact('post'));
    }

    public function editPost($id){
        $category=DB::table('categories')->get();
        $post=DB::table('posts')->where('id',$id)->first();

        return view('post.editpost',compact('category','post'));
    }

    public function updatePost(Request $req, $id) {
        $validatedData = $req->validate([
            'title' => 'required|max:125',
            'details' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:3000',
        ]);
        $data=array();
        $data['title']=$req->title;
        $data['category_id']=$req->category_id;
        $data['details']=$req->details;
        $image=$req->file('image');
        if($image) {
            $image_name=strtolower(Str::random(6));
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            unlink($req->old_photo);
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Successfully Post Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }else{
            $data['image']=$req->old_photo;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Successfully Post Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }
    }

    public function deletePost($id) {
        $post=DB::table('posts')->where('id',$id)->first();
        $image=$post->image;
        $delete=DB::table('posts')->where('id',$id)->delete();
        if($delete) {
            unlink($image);
            $notification=array(
                'message'=>'Successfully Post Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went wrong',
                'alert-type'=>'error'
            );
            return Redirect()->route('all.post')->with($notification);
        }
    }

}
