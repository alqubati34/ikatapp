@extends('layouts.app')

@section('content')

    <header class="flex itmes-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-muted font-light">
                <a href="/projects">My Projects</a> / {{ $project->title}}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach

                <img
                    src="{{ gravatar_url($project->owner->email) }}"
                    alt="{{ $project->owner->name }}'s avatar"
                    class="rounded-full w-8 mr-2">


            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="font-normal text-lg mb-3">Tasks</h2>

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <a href="{{ $task->path() }}" class="text-default">{{ $task->body }}</a>
                        </div>
                    @endforeach

                    <div class="card">
                        <form action="{{ $project->path(). '/tasks' }}" method="POST">
                            @csrf
                            <input placeholder="Add new task" class="text-default bg-card w-full" name="body">
                        </form>
                    </div>

                </div>

                <div>
                    <h2 class="font-normal text-lg mb-3">General Notes</h2>

                    <form method="POST" action="{{ $project->path() }}">
                        @csrf
                        @method('PATCH')

                        <textarea
                            name="notes"
                            class="card w-full mb-3"
                            style="min-height: 200px"
                            placeholder="Anything special that you want to make a note of?"
                        > {{ $project->notes }} </textarea>

                        <button type="submit" class="button">Save</button>
                    </form>

                    @include ('errors')

                </div>
            </div>

            <div class="lg:w-1/4 px-3 pt-10">
                @include('projects.card')
                @include('projects.activity.card')
                @can ('manage', $project)
                    @include ('projects.invite')
                @endcan
            </div>
        </div>
    </main>

    <new-task-modal></new-task-modal>

@endsection
