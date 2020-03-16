@extends ('layouts.app')

@section('content')

    <a href="{{ route('tags.index', ['project' => $project->id]) }}">Tags</a>

    <a href="{{ $project->path().'/edit' }}" class="">Edit</a>

    <a href="{{ $project->path().'/members' }}" class="">Members</a>




@endsection
