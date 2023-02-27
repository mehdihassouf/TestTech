<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::all()->orderBy('created_at', 'DESC')->paginate(5));
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'project_id' => $request->category_id,
            'user_id' => $request->user_id,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => (bool)$task,
            'data' => $task,
            'message' => $task ? 'Task Created!' : 'Error Creating Task'
        ]);
    }

    public function show($status)
    {
        $task = Task::allowedFilters(['status'])->get();

        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $status = $task->update(
            $request->only(['title', 'project_id', 'user_id', 'status'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Task Updated!' : 'Error Updating Task'
        ]);
    }

    public function destroy(Task $task)
    {
        $status = $task->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Task Deleted!' : 'Error Deleting Task'
        ]);
    }
}
