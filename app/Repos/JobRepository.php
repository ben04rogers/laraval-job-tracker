<?php

namespace App\Repos;

use Illuminate\Support\Facades\DB;

class JobRepository
{
    public function getJobDetails($job_id) {
        return DB::table("jobs")->where("id", $job_id)->first();
    }
}
