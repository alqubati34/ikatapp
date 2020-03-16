<?php


namespace App\Http\Controllers;


use App\Project;
use App\Task;

trait FileTrait
{
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
