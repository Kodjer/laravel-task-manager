<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        $totalTasks = $tasks->count();
        $inProgressTasks = $tasks->where('status', 'in_progress')->count();
        $pendingTasks = $tasks->where('status', 'pending')->count();
        $completedTasks = $tasks->where('status', 'completed')->count();
        $categories = auth()->user()->categories()->withCount('tasks')->get();
        return view('dashboard.index', compact('tasks', 'totalTasks', 'inProgressTasks', 'pendingTasks', 'completedTasks', 'categories'));
    }


}
