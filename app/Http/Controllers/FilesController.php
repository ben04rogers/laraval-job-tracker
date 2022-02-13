<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index() {
        $files =  DB::table("files")->get()->where("user_id", Auth::user()->id);
        return view("files", compact('files'));
    }

    public function download(Request $request, $file) {
       return response()->download(public_path('assets/'.$file));
    }

    public function view($id) {
        $data = File::find($id);
        return view('viewfile', compact("data"));
    }

    public function store($id = null, Request $request) {

        // 5MB Max Size
        $this->validate($request, [
            'file' => 'required|max:5000',
        ]);

        $data = new File();
        $file = $request->file;
        $filename=time().'.'.$file->getClientOriginalExtension();
        $request->file->move("assets", $filename);
        $data->file=$filename;
        $data->user_id=$request->user()->id;

        // If the file was uploaded on the job page, associate it with a job
        if (!is_null($id)) {
            $data->job_id = $id;
        }

        $data->save();
        return back();
    }
}
