<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function index()
    {
        $count =Comment::count();

        return view('posts.show',compact('count'));
    }

    public function store(Post $post , Request $request)
    {
        $request->validate([
            'body' =>'required|max:500',

        ]);
        Comment::create([
            'body' => request('body'),
            'post_id' => $post->id,
            'user_id' => $post ->user_id =auth()->user()->id
        ]);

        return back();
    }

    public function edit($id){

        $comment = Comment::find($id);
        if (auth()->user()->id !== $comment->user_id){
            return redirect('/comment');
        }
        return view('comments.edit' ,compact('comment'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'body' =>'required|max:500'
        ]);
        $comment =Comment::find($id);
        $comment->body=$request->body;

        $comment->save();
        return redirect('/posts');
    }

    public function destroy($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('/posts');
    }
}
