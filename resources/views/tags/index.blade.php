@extends ('layouts.app')

@section('content')


    <ul>
        @foreach($tags as $tag)
            <li class="mb-4 mt-6">
                {{ $tag->name }}
            </li>
        @endforeach
    </ul>


@endsection
