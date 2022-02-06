<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index(Request $request) {
        
        // Get the id passed in url 'jobs/{id}/details'
        $job_id = $request->route('id');

        // Get all jobs for the currently signed in user
        $job_details = DB::table("jobs")->where("id", $job_id)->first();

        return view("job", [
            'job_details' => $job_details
        ]);    
    }
}
