<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index() {
        $files = File::all();

        return view("files", compact('files'));
    }

    public function download(Request $request, $file) {
       return response()->download(public_path('assets/'.$file));
    }

    public function view($id) {
        $data = File::find($id);
        return view('viewfile', compact("data"));
    }

    public function store(Request $request) {
        $data = new File();
        $file = $request->file;
        $filename=time().'.'.$file->getClientOriginalExtension();
        $request->file->move("assets", $filename);
        $data->file=$filename;
        $data->user_id=$request->user()->id;
        $data->save();
        return back();
    }
}
