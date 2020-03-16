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

                    @can ('manage', $project)
                        <form method="POST" action="{{ $project->path() . '/invitations/{invitation}' }}">
                            @csrf
                            @method('Delete')
                            <button type="submit">Delete</button>
                        </form>
                    @endcan

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
{{--                            <a href="{{ $task->path() }}" class="text-default">{{ $task->body }}</a>--}}
                            <form method="POST" action="{{ $task->path()}}">
                                @method('PATCH')
                                @csrf
                                <input
                                    type="text"
                                    name="body"
                                    value="{{ $task->body }}"
                                    class="w-full {{ $task->completed ? 'text-gray-500' : ''}}" >

                                <input
                                    type="checkbox"
                                    name="completed"
                                    onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>

                                <input
                                    type="date"
                                    name="due_date"
                                    onChange="this.form.submit()"
                                    class="w-full">


                            </form>

                            <div class="text-default mb-4 flex-l">
                                <h1>
                                    Due At
                                    <span class="text-muted text-gray-500">{{ $task->due_date }}</span>
                                </h1>
                                <h1>
                                    Created At
                                    <span class="text-muted text-gray-500">{{ $task->created_at }}</span>
                                </h1>
                                <h1>
                                    Updated At
                                    <span class="text-muted text-gray-500">{{ $task->updated_at }}</span>
                                </h1>

                            </div>

                            <div class="card mb-4">
                                <form action="{{ $task->path() }}" class="dropzone" id="myDropzoneForm">
                                    @csrf
                                </form>
                            </div>
                            <div class="card mb-4">
                                @if($task->files()->count() > 0)
                                    <div>
                                        @foreach($task->files as $file)
                                            <div class="flex flex-col">
                                                <div class="flex">
                                                    <img src="{{ asset('storage/files') . '/' . $file->path}}" height="150px" width="150px">
                                                </div>
                                                <form action="{{ route('files.destroy', [ 'file' => $file])}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="button">Delete</button>
                                                </form>
                                            </div>

                                        @endforeach
                                    </div>
                                @else
                                    <p> No images for this post </p>

                                @endif
                            </div>

                            <div class="card mb-4">
                                <form action="{{ route('commentTask.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $task->id }}" name="task_id">
                                    <input placeholder="Add Comment" class="text-default bg-card" name="comment">
                                    <button class="button" type="submit">Add</button>
                                </form>
                            </div>

                            <div class="card">
                                @foreach($task->comments as $comment)
                                    <div class="card mb-2">
                                        {{ $comment->comment }}
                                        {{ $comment->user->name }}
                                        {{ $comment->created_at }}
                                        <a class="button" href="{{ route('commentTask.destroy', ['comment' => $comment->id]) }}">Delete</a>
                                        <br>
                                        <form action="{{ route('commentTask.update', ['comment' => $comment->id])  }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $task->id }}" name="task_id">
                                            <input placeholder="Update Comment" class="text-default bg-card" name="comment">
                                            <button class="button" type="submit">Update</button>
                                        </form>
                                    </div>

                                @endforeach

                            </div>

{{--                            <div class="card mt-4">--}}
{{--                                <h1>Choose Label</h1>--}}

{{--                                <br>--}}
{{--                                <h1>Label is..</h1>--}}
{{--                                @foreach($task->labels as $label)--}}

{{--                                    {{ $label->name }}--}}

{{--                                @endforeach--}}
{{--                            </div>--}}

                            @can ('manage', $project)
                                <form method="POST" action="{{ $task->path() }}">
                                    @csrf
                                    @method('Delete')
                                    <button type="submit">Delete</button>
                                </form>
                            @endcan
                        </div>



                    @endforeach


                    <div class="card">
                        <form action="{{ $project->path(). '/tasks' }}" method="POST">
                            @csrf
                            <input placeholder="Add new task" class="text-default bg-card w-full" name="body">
                        </form>
                    </div>

                </div>

{{--                <div>--}}
{{--                    <h2 class="font-normal text-lg mb-3">General Notes</h2>--}}

{{--                    <form method="POST" action="{{ $project->path() }}">--}}
{{--                        @csrf--}}
{{--                        @method('PATCH')--}}

{{--                        <textarea--}}
{{--                            name="notes"--}}
{{--                            class="card w-full mb-3"--}}
{{--                            style="min-height: 200px"--}}
{{--                            placeholder="Anything special that you want to make a note of?"--}}
{{--                        > {{ $project->notes }} </textarea>--}}

{{--                        <button type="submit" class="button">Save</button>--}}
{{--                    </form>--}}

{{--                    @include ('errors')--}}

{{--                </div>--}}
            </div>

            <div class="lg:w-1/4 px-3 pt-10">
                @include ('projects.card')
                @include ('projects.activity.card')
                @can ('manage', $project)
                    @include ('projects.invite')
                @endcan
            </div>
        </div>
    </main>

    <new-task-modal></new-task-modal>

@endsection
