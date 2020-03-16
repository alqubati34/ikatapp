@extends ('layouts.app')

@section('content')


    <h1>Labels</h1>

    <a href="labels/create" class="button">Create</a>

    <ul>
        @foreach($labels  as $label)
            <li class="mb-4 mt-6">
                {{ $label->name }}
{{--                <a class="button" href="{{ route('labels.destroy', ['label' => $label->id]) }}">Delete</a>--}}
{{--                <br>--}}
{{--                <form action="{{ route('labels.update', ['label' => $label->id])  }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <input placeholder="update Label" class="text-default bg-card" name="name">--}}
{{--                    <button class="button" type="submit">Update</button>--}}
{{--                </form>--}}
            </li>
        @endforeach
    </ul>


@endsection
