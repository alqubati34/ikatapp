<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Label;
use App\TaskComment;
use Illuminate\Http\Request;

class LabelsController extends Controller
{

    public function index()
    {
        $labels = Label::all();
//        $labels = Label::where('project_id', $this->id)->get();
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

//    public function store(LabelRequest $request)
//    {
//        $requestArray = $request->all();
//        Label::create($requestArray);
//
//        return redirect()->route('labels.index');
//    }
//
//
//    public function update($id, LabelRequest $request)
//    {
//        $row = Label::findOrFail($id);
//
//        $row->update($request->all());
//
//        return redirect()->back();
//    }
//
//
//    public function destroy($id)
//    {
//        $row = Label::findOrFail($id);
//
//        $row->delete();
//
//        return redirect()->back();
//    }


}
