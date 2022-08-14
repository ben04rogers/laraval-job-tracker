<?php

namespace App\Repos;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Collection;

class FileRepository
{

    public function getJobFiles($job_id): Collection
    {
        return DB::table("files")->get()->where("user_id", Auth::user()->id)->where("job_id", $job_id);
    }
}
