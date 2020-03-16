<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);

        $count = Post::count();

        return view('posts.index',compact('posts','count'));
    }

    public function  create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'body' =>'required|max:500'

        ]);

        $post = new Post();
        $post ->title =$request->title;
        $post->body = $request->body;
        $post ->user_id =auth()->user()->id;

        $post ->save();
        return redirect('/posts');
    }

    public function show($id)
    {
        $post=Post::find($id);
        // dd($post);
        return view('posts.show',compact('post'));
    }

    public function edit($id){

        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','You are not authorized');
        }
        return view('posts.edit' ,compact('post'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|max:200',
            'body' =>'required|max:500'
        ]);
        $post =Post::find($id);
        $post->title =$request->title;
        $post->body=$request->body;

        $post->save();
        return redirect('/posts')->with('status','Post was update !');
    }

    public function destroy($id){

        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('status','Post was delete !');
    }
}
