<?php

namespace App\Http\Controllers;

use App\Mail\NewJob;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class DashboardController extends Controller
{
    public function index() {

        // Get all jobs for the currently signed in user
        $jobs = DB::table("jobs")->get()->where("user_id", Auth::user()->id)->where('status');

        // Chain where() for multiple conditions
        $sent_jobs = DB::table("jobs")->get()->where("user_id", Auth::user()->id)->where("status", "Sent")->count();

        $interviewing_jobs = DB::table("jobs")->get()->where("user_id", Auth::user()->id)->where("status", "Interviewing")->count();

        $offer_jobs = DB::table("jobs")->get()->where("user_id", Auth::user()->id)->where("status", "Offer")->count();

        $expired_jobs = DB::table("jobs")->get()->where("user_id", Auth::user()->id)->where("status", "Expired")->count();

        return view("dashboard", [
            'jobs' => $jobs,
            'sent_jobs' => $sent_jobs,
            'interviewing_jobs' => $interviewing_jobs,
            'offer_jobs' => $offer_jobs,
            'expired_jobs' => $expired_jobs
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'position_title' => 'required|max:255',
            'salary' => 'required|',
            'description' => 'required',
            'post_url' => 'required',
            'application_status' => 'required'
        ]);

        // This will automatically fill in user_id
        $request->user()->jobs()->create([
            'company_name' => $request->company_name,
            'job_title' => $request->position_title,
            'salary' => $request->salary,
            'description' => $request->description,
            'post_url' => $request->post_url,
            'status' => $request->application_status,
            'date_applied' => date('Y-m-d H:i')
        ]);

        return back();
    }
}
