<div class="card flex flex-col mt-6">
    <h3 class="font-normal text-xl mb-3 py-2 -ml-5 mb-2 border-l-4 border-orange-400 pl-4">
        Invite a User
    </h3>

    <form method="POST" action="{{ $project->path() . '/invitations' }}">
        @csrf

        <div class="mb-3">
            <input type="email" name="email" class="border-muted border rounded w-full py-2 px-3" placeholder="Email address">
        </div>

        <button type="submit" class="button">Invite</button>
    </form>

    @include ('errors', ['bag' => 'invitations'])
</div>
