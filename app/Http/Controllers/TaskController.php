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

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Task::query();

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $orderBy = $request->get('order_by', 'created_at');
        $direction = $request->get('order_direction', 'desc');

        if ($orderBy === 'updated_at') {
            $query->orderBy($orderBy, $direction);
        } else {
            $query->orderBy($orderBy, 'desc');
        }

        $tasks = $query->get();

        return response()->json([
            'success' => true,
            'tasks' => $tasks,
        ]);
    }


    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);

            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tarefa excluída com sucesso.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir tarefa: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:500',
            'status' => 'required|in:pending,completed,in_progress',
        ]);

        $task = Task::findOrFail($id);

        $task->title = $validated['titulo'];
        $task->description = $validated['descricao'];
        $task->status = $validated['status'];
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Tarefa atualizada com sucesso!',
        ]);
    }

}
