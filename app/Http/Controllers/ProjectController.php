<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = Project::withCount('tasks')
            ->withCount([
            'tasks as pending_tasks_count' => function ($query) {
                $query->where('status', Task::STATUS_PENDING);
            },
            'tasks as in_progress_tasks_count' => function ($query) {
                $query->where('status', Task::STATUS_IN_PROGRESS);
            },
            'tasks as done_tasks_count' => function ($query) {
                $query->where('status', Task::STATUS_DONE);
            },
            ])
            ->where('owner_id', Auth::id())
            ->paginate(5);

        //Add Resource so it returns only selected fields

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
        ]);
    }

    
    public function create()
    {
        //return view
    }

    
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $validated['owner_id'] = $request->user()->id;
        Project::create($validated);
        return redirect()->route('projects.index');
    }

    
    public function show(Project $project)
    {
        $tasks = $project->tasks()
            ->with('assignee:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return Inertia::render('Projects/Show', [
            'project'=>$project,
            'tasks' => TaskResource::collection($tasks)->response()->getData(true),
            'users' => UserResource::collection(User::all()),
            'statusList' => Task::STATUS_LIST,
        ]);
    }

    
    public function edit(Project $project)
    {
        //return view
    }

    
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();
        $project->update($validated);
        return redirect()->route('projects.index');
    }

    
    public function destroy(Project $project)
    {
        //authorize with policy
        $project->delete();
        return redirect()->route('projects.index');
    }
}
