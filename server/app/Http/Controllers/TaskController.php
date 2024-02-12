<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'title' => $request->title,
        ]);
        return response()->json(['message' => 'Task added successfully']);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title,
        ]);
        return response()->json(['message' => 'Task updated successfully']);
    }

    public function complete(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
        return response()->json(['message' => 'Task updated successfully']);
    }

    public function delete(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
