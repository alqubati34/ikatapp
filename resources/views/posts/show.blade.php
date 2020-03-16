@extends('layouts.app')

@section('content')

    <div class="row mt-6">
        <div class="col-md-9 offset-md-2">

            <div class="card mb-3" style="min-width: 18rem;">
                <div class="card-body">
                    <div class="card-title">
                        <small class="text-muted"> <p>{{ date('F d,Y',strtotime($post->created_at)) }} at {{ date('j:ia',strtotime($post->created_at)) }}</p></small>
                        <p style="color:brown;">created by : {{$post->user->name}}</p>
                        <h4>{{$post->title}}</h4>

                    </div>
                    <div class="card-text">
                        {{$post->body}}
                    </div>
                    <br>
                    <br>
                    @foreach ($post->comments as $comment)
                        <tr>
                            <th>
                                <p style="color:brown">created by : {{$comment->user->name}} <small>{{ date('F d,Y',strtotime($comment->created_at)) }} at {{ date('j:ia',strtotime($comment->created_at)) }}</small></p>
                                <p> {{$comment->body}}</p>

                            </th>
                            <br>
                            <td class="td-actions text-right">
                                @auth
                                    @if(auth()->user()->id == $comment->user_id)
                                        <a href="{{'/comment/'.$comment->id .'/edit'}}" class="btn btn-primary  float-left mr-2">Edit</a>
                                    @endif
                                @endauth
                            </td>
                            <br>
                        </tr>
                        <br>
                    @endforeach
                    <br>

                    <form method="POST" action="/posts/{{$post->id}}/store">
                        {{ csrf_field() }}
                        {{-- @csrf
                        @method('PUT') --}}
                        <div class="form-group">

                            <textarea name="body" id="body" class="form-control" placeholder="Write Comment"></textarea>
                        </div>
                        @auth
                            @if(auth()->user()->id == empty($record))
                                <div class="form-group">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add Comment</button>
                                </div>
                            @endif
                        @endauth


                    </form>

                    <hr>

                    @auth
                        @if(auth()->user()->id == $post->user_id)
                            <a href="{{'/posts/'.$post->id .'/edit'}}" class="btn btn-primary  float-left mr-2">Edit</a>

                            <form action="{{route('posts.destroy',['id' => $post->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-left">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    </div>




@endsection
