<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function show(Project $project,Task $task)
    {
        $this->authorize('update', $project);

        return view('tasks.show', compact('task'));
    }


    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate([
            'body' => 'required'
        ]);

        $project->addTask(request('body'));

        return redirect($project->path());
    }


    public function update(Project $project,Task $task)
    {
        $this->authorize('update', $task->project);

        $task->update(request()->validate(['body' => 'required']));

        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($task->path());
    }

    public function upload(Project $project,Task $task)
    {
        if (request()->hasFile('file'))
        {
            $file = request()->file('file');
            $fileName = uniqid(). '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public\files', $fileName);

            if ($path)
            {
                $task->files()->create([
                   'path' => $fileName
                ]);

                return response()->json([
                    'upload_status' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'upload_status' => 'failed'
                ], 401);
            }
        }
    }
}
