@extends ('layouts.app')

@section('content')

    <ul>
        @foreach ($project->members as $member)
            <img
                src="{{ gravatar_url($member->email) }}"
                alt="{{ $member->name }}'s avatar"
                class="rounded-full w-8 mr-2">

            @can ('manage', $project)
                <form method="POST" action="{{ $project->path() . '/invitations/{invitation}' }}">
                    @csrf
                    @method('Delete')
                    <button type="submit">Delete</button>
                </form>
            @endcan

        @endforeach
    </ul>




@endsection
