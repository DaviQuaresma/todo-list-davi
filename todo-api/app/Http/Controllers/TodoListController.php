<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = auth()->user()->todoLists()->withCount('tasks')->get();

        return response()->json($lists);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        $list = auth()->user()->todoLists()->create([
            'title' => $request->title
        ]);

        return response()->json($list, 201);
    }

    public function show($id)
    {
        $list = auth()->user()->todoLists()->with('tasks')->findOrFail($id);

        return response()->json($list);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required|string|max:255']);

        $list = auth()->user()->todoLists()->findOrFail($id);
        $list->update(['title' => $request->title]);

        return response()->json($list);
    }

    public function destroy($id)
    {
        $list = auth()->user()->todoLists()->findOrFail($id);
        $list->delete();

        return response()->json(['message' => 'Lista excluída com sucesso']);
    }
}
