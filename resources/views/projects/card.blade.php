<div class="card flex flex-col" style="height: 200px">
    <h3 class="font-normal text-xl mb-3 py-2 -ml-5 mb-2 border-l-4 border-orange-400 pl-4 ">

        <a href="{{ $project->path() }}" class="text-default">{{ $project->title }}</a>
    </h3>

    <div class="text-default mb-4 flex-l">

        <span class="text-muted text-gray-500">{{ $project->created_at->diffForHumans(null, true) }}</span>
{{--        {{ \Illuminate\Support\Str::limit($project->description, 100) }}--}}
    </div>

    @can ('manage', $project)
        <footer>
            <form method="POST" action="{{ $project->path() }}" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs">Delete</button>
            </form>
{{--            <a href="{{ $project->path().'/edit' }}" class="">Edit</a>--}}
            <a href="{{ route('project.settings', ['project' => $project->id]) }}" class="">Setting</a>
        </footer>
    @endcan

</div>

