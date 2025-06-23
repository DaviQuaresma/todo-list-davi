<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($listId)
    {
        $list = auth()->user()->todoLists()->with('tasks')->findOrFail($listId);
        
        return response()->json($list->tasks);
    }

    public function store(Request $request, $listId)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $list = auth()->user()->todoLists()->findOrFail($listId);

        $task = $list->tasks()->create([
            'title' => $request->title,
            'is_done' => false
        ]);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->todoList->user_id !== auth()->id()) {
            return response()->json(['error' => 'Acesso negado'], 403);
        }

        $task->update([
            'is_done' => !$task->is_done
        ]);

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->todoList->user_id !== auth()->id()) {
            return response()->json(['error' => 'Acesso negado'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Tarefa removida']);
    }
}
