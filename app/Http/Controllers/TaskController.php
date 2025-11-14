<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService) {}

    // public function index(Request $request)
    // {
    //     $projects = Project::all();

    //     $tasks = Task::where('project_id', $request->project_id ?? $projects->first()?->id)
    //         ->orderBy('priority')
    //         ->get();

    //     return view('tasks.index', compact('tasks', 'projects'));
    // }

    public function index()
    {
        $projects = Project::orderBy('id')->get();

        return view('tasks.index', compact('projects'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'project_id' => 'required|exists:projects,id',
        ]);

        $this->taskService->create($request->all());

        return back();
    }

    public function update(Request $request, Task $task)
    {
        $this->taskService->update($task, $request->all());
        return back();
    }

    public function destroy(Task $task)
    {
        $this->taskService->delete($task);
        return back();
    }

    public function reorder(Request $request)
    {
        $this->taskService->reorder($request->order);
        return response()->json(['status' => 'ok']);
    }
}
