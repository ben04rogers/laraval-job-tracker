<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Only logged in users can see dashboard

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {

        // Get all jobs for the currently signed in user
        $jobs = DB::table("jobs")->get()->where("user_id", Auth::user()->id);

        return view("dashboard", [
            'jobs' => $jobs
        ]);
    }

    public function store(Request $request) {
        // Validate request 
        
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'position_title' => 'required|max:255',
            'salary' => 'required|',
            'post_url' => 'required',
            'application_status' => 'required'
        ]);

        // This will automatically fill in user_id
        $request->user()->jobs()->create([
            'company_name' => $request->company_name,
            'job_title' => $request->position_title,
            'salary' => $request->salary,
            'post_url' => $request->post_url,
            'status' => $request->application_status,
            'date_applied' => date('Y-m-d H:i')
        ]);

        return back();
    }
}
