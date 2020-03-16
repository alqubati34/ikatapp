<?php


namespace App\Http\Controllers;


use App\Http\Requests\TaskCommentRequest;
use App\TaskComment;

trait CommentTrait
{
    public function commentStore(TaskCommentRequest $request) {
        $requestArray = $request->all() + ["user_id" => auth()->user()->id];

        TaskComment::create($requestArray);

        return redirect()->back();
    }

    public function commentDestroy($id) {
        $row = TaskComment::findOrFail($id);

        $row->delete();

        return redirect()->back();
    }

    public function commentUpdate($id, TaskCommentRequest $request)
    {
        $row = TaskComment::findOrFail($id);

        $row->update($request->all());

        return redirect()->back();
    }

}
