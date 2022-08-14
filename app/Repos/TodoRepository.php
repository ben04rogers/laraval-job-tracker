<?php

namespace App\Repos;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Collection;

class TodoRepository
{
    public function getJobTodos($job_id): Collection
    {
        return DB::table("todos")->get()->where("user_id", Auth::user()->id)->where("job_id", $job_id);
    }
}
