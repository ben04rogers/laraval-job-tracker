<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function deleteTodo(Request $request) {

        // Check user can delete job
        if (Auth::user()->id != Todo::find($request->todo_id)->user_id) {
            dd("You can't delete this job");
        }

        DB::table("todos")->where("id", $request->todo_id)->delete();

        Session::flash('message', 'Todo was deleted');

        return back();
    }
}
