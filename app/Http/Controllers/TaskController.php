<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        $task = new Task();
        $task->title = $validated['titulo'];
        $task->description = $validated['descricao'];
        $task->status = 'pending';
        $task->user_id = Auth::id();
        $task->save();

        return response()->json(['success' => true, 'task' => $task]);
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $tasks = Task::all();
        } else {
            $tasks = Task::where('user_id', $user->id)->get();
        }

        return response()->json([
            'success' => true,
            'tasks' => $tasks
        ]);
    }

}

