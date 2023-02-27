<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(Task::all()->toArray());
    }

    public function store(Request $request)
    {
        $project = Project::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => (bool)$project,
            'data' => $project,
            'message' => $project ? 'Project Created!' : 'Error Creating the Project'
        ]);
    }

    public function show(Project $project)
    {
        return response()->json($project);
    }

    public function update(Request $request, Project $project)
    {
        $status = $project->update(
            $request->only(['title', 'user_id', 'status'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Project Updated!' : 'Error Updating the Project'
        ]);
    }

    public function destroy(Project $project)
    {
        $status = $project->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Project Deleted!' : 'Error Deleting the Project'
        ]);
    }
}
