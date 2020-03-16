@extends('layouts.app')

@section('content')

    <a class="button" href="{{url('/posts/create')}}">Create a Post</a>


    <h2> List of all Posts </h2>
    <hr>
    <div>
        <div class="">
            <div class="">
                <div class="">
                    @foreach ($posts as $post)
                        <div class="">

                            <div class="" style="min-width: 50rem;">

                                <div class="">

                                    <p style="color:brown;">created by : {{$post->user->name}}
                                        <small class="text-muted">{{ date('F d,Y',strtotime($post->created_at)) }} at {{ date('j:ia',strtotime($post->created_at)) }}</small>
                                    </p>

                                </div>
                                <div class="">
                                    <h4>{{$post->title}}</h4>

                                </div>
                                <div class="">
                                    {{$post->body}}
                                </div>
                                <hr>
                                <a href="{{'/posts/' .$post->id}}" class="">show more</a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

{{--        <div class="col-md-3">--}}
{{--            <div class="card ml-3" style="min-width: 18rem;">--}}
{{--                <div class="card-header bg-dark text-white">Stats</div>--}}
{{--                <div class="card-body">--}}

{{--                    <p class="card-text">All Posts : {{$count}}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr/>--}}
{{--        </div>--}}

    </div>


    {{-- <div class="row"> --}}
{{--    <div class="col-md-12 d-flex justify-content-center">--}}
{{--        {{$posts->links()}}--}}
{{--        --}}{{-- </div> --}}
{{--    </div>--}}



@endsection
