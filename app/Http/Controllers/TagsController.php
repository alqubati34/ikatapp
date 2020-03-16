<?php

namespace App\Http\Controllers;

use App\Project;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Project $project)
    {
        $project = $tags->projects();

        return view('tags.index', [
            'tags' => Tag::all()
        ]);
    }
}
