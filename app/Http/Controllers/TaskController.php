<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function addTask(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'user_id' => $request->user_id,
            'task' => $request->task,
            'status' => 'pending',
        ]);

        return response()->json([
            'task' => $task,
            'status' => 1,
            'message' => 'Successfully created a task',
        ]);
    }

    public function updateTaskStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tasks,id',
            'status' => 'required|in:pending,done',
        ]);

        $task = Task::find($request->id);
        $task->status = $request->status;
        $task->save();

        $message = $task->status == 'done' ? 'Marked task as done' : 'Marked task as pending';

        return response()->json([
            'task' => $task,
            'status' => 1,
            'message' => $message,
        ]);
    }
}
