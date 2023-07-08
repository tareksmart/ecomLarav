<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PostsController extends Controller
{
    public function create(){
        return view('posts.create');
    }
    public function insert(Request $req){
       \Illuminate\Support\Facades\DB::table('posts')->insert([
           'title'=>$req->title,
           'body'=>$req->body
       ]);
        return redirect()->route('data');
    }

    public  function  getData(){
       $posts= \Illuminate\Support\Facades\DB::table('posts')->get();
       return view('posts.data',compact('posts'));
    }

    public function edite($id){
        $post=\Illuminate\Support\Facades\DB::table('posts')->where('id',$id)->first();
        return view('posts.edite',compact('post'));
    }
    public function ed(Request $req,$id){
        \Illuminate\Support\Facades\DB::table('posts')->where('id',$id)-> update([
            'title'=>$req->title,
            'body'=>$req->body
        ]);
        return redirect()->route('data');
    }

    public function delete($id){
        $deleted=\Illuminate\Support\Facades\DB::table('posts')->where('id','=',$id)->delete();

        return redirect()->route('data');
    }
}
