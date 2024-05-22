<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index($id)
    {
        $tasks = Task::where([['status', '=', 'created'], ['project_id', '=', $id]])->get();
        return response()->json($tasks, 200);
    }

    public function store(Request $req)
    {
        Task::create(
            $req->validate([
                'title' => 'string|required',
                'project_id' => 'required|integer',
            ]),
        );
    }

    public function view($id)
    {
        $Task = Task::findOrFail($id);
        return Inertia::render('tasks/ViewTask', [
            'Task' => $Task,
        ]);
    }


}
