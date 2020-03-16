@extends('layouts.app')

@section('content')

    <div class="">
        <div class="">

            <h3>Edit Post Fore</h3>
            <hr>
            <form action="{{'/posts/' . $post->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="">
                    <label for="title">Titl</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
                </div>

                <div class="">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" cols="30" rows="5" class="form-control">{{$post->body}}</textarea>
                </div>

                <div class="form-groug">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>



@endsection
