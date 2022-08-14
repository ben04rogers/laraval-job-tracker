<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Repos\FileRepository;
use App\Repos\JobRepository;
use App\Repos\TodoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request, JobRepository $job_repo, FileRepository $file_repo, TodoRepository $todo_repo) {

        // Get the id passed in url 'jobs/{id}/details'
        $job_id = $request->route('id');

        $job_details = $job_repo->getJobDetails($job_id);
        $files = $file_repo->getJobFiles($job_id);
        $todos = $todo_repo->getJobTodos($job_id);

        // Format contract_type data from 'full-time' to 'Full Time'
        $job_details->contract_type = str_replace('-', ' ', $job_details->contract_type);
        $job_details->contract_type = ucwords($job_details->contract_type);

        return view("job", [
            'job_details' => $job_details,
            'files' => $files,
            'job_id' => $job_id,
            'todos' => $todos
        ]);
    }

    public function update($id, Request $request) {

        $this->validate($request, [
            'company_name' => 'required|max:255',
            'position_title' => 'required|max:255',
            'salary' => 'required|',
            'description' => 'required',
            'post_url' => 'required',
            'contract_type' => 'required',
            'application_status' => 'required'
        ]);

        Job::where('id', $id)->update([
            'company_name' => $request->company_name,
            'job_title' => $request->position_title,
            'salary' => $request->salary,
            'description' => $request->description,
            'post_url' => $request->post_url,
            'contract_type' => $request->contract_type,
            'status' => $request->application_status
        ]);

        Session::flash('message', 'Successfully updated job');

        return back();
    }

    public function delete($id) {

        // Check user can delete job
        if (Auth::user()->id != Job::find($id)->user_id) {
            dd("You can't delete this job");
        }

        DB::table("jobs")->where("id", $id)->delete();
        Session::flash('message', 'Job was deleted');
        return back();
    }
}
