<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

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

        // $posts = Post::all();
        // dd(auth()->user());
        $posts = auth()->user()->posts()->paginate(3);
        return view('admin.tables.post-datatables', ['posts' => $posts]);
    }

    public function edit(Post $post){

        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function destroy(Post $post){

        $this->authorize('update');

        $post->delete();

        // dd(back());
        Session::flash('message', 'Post was deleted!');
        return back();
    }

    public function update(Post $post){

        $inputs = request()->validate([
            'title' => 'required|min:8|max:225',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update');

        auth()->user()->posts()->save($post);

        Session::flash('edit_message', 'Edited Successfully!');
        return redirect('/allpost');
    }
}
