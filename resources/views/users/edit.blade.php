@extends('layouts.app')

@section('content')

    <a href="{!! route('profileavatar') !!}" class="button">UploadeProfilePicture </a>

    <a href="{{ route('changepassword')}}" class="button">Change password</a>

    {{-- <form method="post" action="{{route('users.update', $user)}}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <hr/>

        <input type="text" name="name"  value="{{ $user->name }}" />
        <hr/>
        <input type="email" name="email"  value="{{ $user->email }}" />
        <hr/>
        <p>change password</p>
        <input type="password" name="password" />
        <hr/>
        <input type="password" name="password_confirmation" />
        <hr/>
        <button type="submit">Send</button>
    </form> --}}


    <div class="card card-default">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            <form    method="POST" action="{{route('users.update', $user)}}">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control"  value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="text" name="email" class="form-control" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="name">Bio:</label>
                    <input type="text" name="email" class="form-control" value="{{$user->Bio}}">
                </div>
                <div class="form-group">

                    <div class="form-group">
                        <button class="btn btn-success">Update Profile</button>
                    </div>
            </form>



        </div>
    </div>


    <form action="{{route('users.destroy',['user' => Auth::user()->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="button">Delete My Account</button>

    </form>

@endsection
