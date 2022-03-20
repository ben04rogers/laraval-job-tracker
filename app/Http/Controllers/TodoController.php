<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function addtodo(Request $request, $job_id)
    {
        $this->validate($request, [
            'todo_description' => 'required'
        ]);

        $request->user()->todos()->create([
            'description' => $request->todo_description,
            'job_id' => $job_id
        ]);

        return back();
    }
    public function updatetodo(Request $request) {
        $todo = DB::table("todos")->where("id", $request->todo_id);

        $todo->update(["completed" => $todo->first()->completed == 1 ? 0 : 1]);

        return back();
    }
}
