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
        $createdTasks = Task::where([['status', '=', 'created'], ['project_id', '=', $id]])->get();
        $inProgressTasks = Task::where([['status', '=', 'inProgress'], ['project_id', '=', $id]])->get();
        $doneTasks = Task::where([['status', '=', 'done'], ['project_id', '=', $id]])->get();
        return response()->json(
            [
                'createdTasks' => $createdTasks,
                'inProgressTasks' => $inProgressTasks,
                'doneTasks' => $doneTasks,
            ],
            200,
        );
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

    public function update($id, Request $request)
    {
        $task = Task::findOrFail($id);
        $status = $request->input('status');
        $type = $request->input('type');

        $newStatus = $this->getNewStatus($status, $type);

        if ($newStatus) {
            $task->update(['status' => $newStatus]);
        } else {
            return response()->json(['message' => 'Invalid status update request'], 400);
        }
    }

    private function getNewStatus($status, $type)
    {
        $statusMap = [
            'created' => 'inProgress',
            'inProgress' => $type === 'rev' ? 'created' : 'done',
            'done' => $type === 'rev' ? 'inProgress' : null,
        ];

        return $statusMap[$status] ?? null;
    }
}
