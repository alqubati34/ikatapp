@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-9 offset-md-2">

            <h3>Edit Comment Fore</h3>
            <form action="{{'/comment/' . $comment->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">

                    <textarea name="body" id="body" class="form-control" placeholder="Write Comment">{{$comment->body}}</textarea>
                </div>

                <div class="form-groug">
                    <button type="submit" class="btn btn-primary">Update</button>


                </div>

            </form>
            <form action="{{route('comment.destroy',['id' => $comment->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger float-left">Delete</button>
            </form>


        </div>

    </div>





@endsection
