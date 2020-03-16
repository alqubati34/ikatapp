@extends('layouts.app')

@section('content')



    <form  action="{!! route('changepassword') !!}" method="POST">
        {{-- {{ csrf_field() }}
        {{ method_field('patch') }} --}}
        @csrf
        <div class="form-group">
            <p>change password</p>
            <input type="password" id="current_password" class="form-control" placeholder="Enter old Password" name="current_password">
        </div>
        <div class="form-group">


            <input type="password"  id="new_password" name="new_password" placeholder="Enter new Password" class="form-control" />
            <hr/>
        </div>
        <div class="form-group">
            <input type="password" name="new_password_confirmation"  id="new_password_confirmation" placeholder="Enter confirm Password" class="form-control" />
        </div>
        <div class="form-group">
            <button class="btn btn-success">Change Password</button>
        </div>
    </form>

@endsection
