<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function store(Request $request, Task $task) 
    {
      $validated = $request->validate([
        'title' => 'required|max:255',
      ]);

      $task->subtasks()->create([
        'title' => $validated['title'],
        'order' => $task->subtasks()->count(),
      ]);

      return redirect()->route('tasks.show', $task);
    }

    public function toggle(Subtask $subtask)
    {
      $subtask->is_completed = !$subtask->is_completed;
      $subtask->save();

      return redirect()->route('tasks.show', $subtask->task);
    }

    public function destroy(Subtask $subtask)
    {
        $subtask->delete();
        return redirect()->route('tasks.show', $subtask->task);
    }
}
