@extends ('layouts.app')

@section('content')


    <div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Create Your Label
        </h1>

        <form method="POST" action="{{ route('labels.store') }}">
            @csrf
{{--            <input type="hidden" value="{{ $project->id }}" name="project_id">--}}

            <input
                placeholder="Create Label"
                type="text"
                class="input bg-transparent border border-muted-light rounded p-2 mb-2 text-xs w-full"
                name="name">

            <button type="submit" class="button">Create Label</button>
        </form>
    </div>


@endsection
