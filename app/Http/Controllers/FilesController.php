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
       return response()->download(public_path('assets/files/'.$file));
    }

    public function view($id) {

        $data = File::find($id);

        $user = Auth::user();

        // Make sure users can only access their own files
        if ($user->id === $data->user_id) {
            return view('viewfile', compact("data"));
        } else {
            return redirect('/dashboard');
        }
    }

    public function store(Request $request, $id = null) {

        // 5MB Max Size
        $this->validate($request, [
            'file' => 'required|max:5000',
            'file_name' => 'required'
        ]);

        $data = new File();
        $file = $request->file;
        $filename = $request->file_name.'.'.$file->getClientOriginalExtension();
        $request->file->move("assets/files", $filename);
        $data->file=$filename;
        $data->user_id=$request->user()->id;

        // If the file was uploaded on the job page, associate it with a job
        if (!is_null($id)) {
            $data->job_id = $id;
        } else {
            $data->job_id = null;
        }

        $data->save();
        return back();
    }

    public function delete($id) {
        $data = File::find($id);

        DB::table("files")->where("id", $id)->delete();

        // Delete file from /public/assets/files folder
        unlink(public_path('/assets/files/'.$data->file));

        return back();
    }
}
