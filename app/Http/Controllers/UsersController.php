<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        if(Auth::user()->email == request('email')) {

            $this->validate(request(), [
                'name' => 'required',

                'email' => 'required|email|unique:users',
                'Bio' =>'required',

            ]);

            $user->name = request('name');
            $user->email = request('email');
            $user->Bio = request('Bio');


            $user->save();
            return back()->with('message',' changed successfully');
            // return back();

        }
        else{

            $this->validate(request(), [
                'name' => 'required',
                // 'email' => 'required|email|unique:users',
                // 'Bio' =>'required',

            ]);

            $user->name = request('name');
            // $user->email = request('email');
            // $user->Bio = request('Bio');
            // $user->password = bcrypt(request('password'));

            $user->save();
            // return back()->with('message',' changed successfully');
            return back();

        }
    }

    public function getProfileAvater()
    {
        return view('users.profilepicture');
    }

    public function profilePictureUpload(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpg,jpeg,gif,png|max:2048',
        ]);
        if($request->hasFile('avatar')){

            $avatar =$request->file('avatar');
            $filename =time() . "." . $avatar->getClientOriginalExtension();
            // Image::make($avatar)->resize(30,25)->save(public_path('/images/avatar/'.$filename));
            $request->avatar->move(public_path('images/avatar'),$filename);
            $user =Auth::user();
            $user->avatar =$filename;
            $user->save();

        }

        return back()->with('message','Profile Picture Uploaded Successfully');
    }

    public function changePasswordForm()
    {
        return view("users.changepassword");
    }

    public function changePassword(Request $request)
    {
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))){
            return back()->with('error','Your current password does not match with what you provided');
        }
        if(strcmp($request->get('current_password'),$request->get('new_password')) == 0 ){
            return back()->with('error','Your current password cannot be same with the new password');
        }
        $request->validate([
            'current_password' => 'required',
            'new_password' =>'required|string|min:6|confirmed'
        ]);
        $user = Auth::user();
        $user->password=bcrypt($request->get('new_password'));
        $user->save();
        return back()->with('message','Password changed successfully');

    }

    public function destroy(User $user)
    {
        $posts = Post::where('user_id', $user->id)->pluck('id');
        Comment::whereIn('post_id', $posts)->delete();
        Post::where('user_id', $user->id)->delete();
        $user->delete();
        return redirect('/login')->with('status','users was delete !');
    }
}
