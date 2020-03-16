@extends('layouts.app')

@section('content')



    <div class="card card-default">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">

            <form enctype="multipart/form-data" action="{!! route('profileavatar') !!}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="file" name="avatar" class="form-control">
                    <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
                </div>

                <button class="btn btn-primary" type="submit">Upload Picture</button>

            </form>


        </div>
    </div>

@endsection
