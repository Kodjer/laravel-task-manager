<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.index', compact('tasks'));
    }


    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
        // Проверка данных 
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,normal,high'
        ]);

        auth()->user()->tasks()->create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Задача успешно выполнена');
    }


    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }


    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }


    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'required|in:low,normal,high'
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Задача обновлена');
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Задача удалена!');
    }
}
