<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return Inertia::render('Projects/index', [
            'projects' => $projects,
        ]);
    }

    public function store(Request $req)
    {
        Project::create(
            $req->validate([
                'title' => 'string|required',
                'description' => 'string|required',
            ]),
        );
    }

    public function view($id)
    {
        $project = Project::findOrFail($id);
        return Inertia::render('Projects/ViewProject', [
            'project' => $project,
        ]);
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project, 200);
    }

    public function update($id, Request $req)
    {
        $project = Project::findOrFail($id);
        $project->update(
            $req->validate([
                'title' => 'string|required',
                'description' => 'string|required',
            ]),
        );
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id)->delete();
    }
}
