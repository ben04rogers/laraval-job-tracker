<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    public function index(Request $request) {
        
        // Get the id passed in url 'jobs/{id}/details'
        $job_id = $request->route('id');

        // Get all jobs for the currently signed in user
        $job_details = DB::table("jobs")->where("id", $job_id)->first();

        // Get files for this specific job
        $files = DB::table("files")->get()->where("user_id", Auth::user()->id)->where("job_id", $job_id);

        return view("job", [
            'job_details' => $job_details,
            'files' => $files
        ]);    
    }

    public function update($id, Request $request) {
        // Validate request 
        
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'position_title' => 'required|max:255',
            'salary' => 'required|',
            'description' => 'required',
            'post_url' => 'required',
            'application_status' => 'required'
        ]);

        Job::where('id', $id)->update([
            'company_name' => $request->company_name,
            'job_title' => $request->position_title,
            'salary' => $request->salary,
            'description' => $request->description,
            'post_url' => $request->post_url,
            'status' => $request->application_status,
        ]);

        return back();
    }

    public function delete($id) {

        DB::table("jobs")->where("id", $id)->delete();

        Session::flash('message', 'Job was deleted'); 

        return back();
    }
}
