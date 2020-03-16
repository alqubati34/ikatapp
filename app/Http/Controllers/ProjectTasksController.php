<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCommentRequest;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    use CommentTrait, FileTrait;

    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate([
            'body' => 'required',
            'due_date' => 'nullable'
        ]);

        $project->tasks()->create([
            'body' => request('body'),
            'due_date' => request('due_date')
        ]);

//        $project->addTask(request(['body']));

        return redirect($project->path());
    }


    public function update(Project $project,Task $task)
    {
        $this->authorize('update', $task->project);

        $task->update(request()->validate([
            'body' => 'required',
            'due_date' => 'nullable'
        ]));

        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($project->path());
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('manage', $task->project);
        $task->delete();
        return redirect($project->path());
    }



    //    public function show(Project $project,Task $task)
//    {
//        $this->authorize('update', $project);
//
//        return view('tasks.show', compact('task'));
//    }


}
