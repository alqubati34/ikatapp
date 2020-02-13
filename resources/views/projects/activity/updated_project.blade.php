@if (count($activity->changes['after']) == 1)
    {{ $activity->user->name }} update the {{ key($activity->changes['after']) }} of the project
@else
    {{ $activity->user->name }} Update a Project
@endif
