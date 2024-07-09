<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //

    public function show($id){

        $post = Post::findOrFail($id);
        return view('blog-post', ['post' => $post]);
    }

    public function create(){

        return view('admin.posts.create');
    }

    public function store(){

        // dd(auth()->user());
        // dd(request()->all());

        $inputs = request()->validate([
            'title' => 'required|min:8|max:225',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        return back();
    }

    public function allPost(){

        $posts = Post::all();
        return view('admin.tables.post-datatables', ['posts' => $posts]);
    }
}
