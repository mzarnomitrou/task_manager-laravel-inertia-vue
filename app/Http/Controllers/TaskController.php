<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use App\Policies\TaskPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $task=Task::create($validated);
        return Inertia::location(route('projects.show', $task->project_id));

    }

    
    public function show(Task $task)
    {
        //
    }

    
    public function edit(Task $task)
    {
       //
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {     
            Gate::authorize('update', $task);
            $validated= $request->validated();
            $task->update($validated);
            return Inertia::location(route('projects.show', $task->project_id));


    }

    
    public function destroy(Task $task)
    {   
        Gate::authorize('delete', $task);
        $task->delete();
        return Inertia::location(route('projects.show', $task->project_id));
    }
}
