<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function index(Request $request): View
    {
        $tasks = Task::query()
            ->latest()
            ->statusFilter($request)
            ->paginate(20);

        return view('tasks.index', compact('tasks'));
    }


    public function store(StoreTaskRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $task = Task::query()->create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => 'active'
            ]);

            $task->statusHistories()->create([
                'status' => $task->status
            ]);
        });

        return to_route('tasks.index');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function update(Task $task, StoreTaskRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($task, $request) {
            $task->update($request->validated());

            $task->statusHistories()->create([
                'status' => $request->input('status')
            ]);
        });

        return to_route('tasks.index');
    }


    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return back();
    }

    public function statusHistory(Task $task): View
    {
        $statusHistory = $task->statusHistories()->latest()->get();
        return view('tasks.status-history', compact('statusHistory'));
    }
}
