@extends('layouts.app')

@section('content')

    <div class="">
        <div class="">

            <h3>Create Post Fore</h3>
            <hr>
            <form action="/posts" method="POST">
                @csrf
                <div class="">
                    <label for="title">Titl</label>
                    <input type="text" name="title" id="title" class="">
                </div>

                <div class="f">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="">
                    <button type="submit" class="">Create</button>
                </div>

            </form>
        </div>
    </div>

@endsection
