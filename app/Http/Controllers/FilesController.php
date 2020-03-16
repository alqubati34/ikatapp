<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function destroy(File $file)
    {
        if (Storage::delete('public/files/' . $file->path) ) {
            $file->delete();
            return back()->with('success', ' Image was deleted succefuly');
        } else {
            return back()->with('error', ' there was a problem ');
        }
    }

}
