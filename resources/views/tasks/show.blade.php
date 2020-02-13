@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <form method="POST" action="{{ $task->path()}}">
        @method('PATCH')
        @csrf
        <input
            type="text"
            name="body"
            value="{{ $task->body }}"
            class="w-full {{ $task->completed ? 'text-gray' : ''}}">

        <input
            type="checkbox"
            name="completed"
            onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>

    </form>
</div>

<form action="{{ $task->path()}}" class="dropzone" id="myDropzoneForm">
    @csrf
</form>

@endsection
