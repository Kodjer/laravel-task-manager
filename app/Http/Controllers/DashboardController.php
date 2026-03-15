<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        $today = now();
        $totalTasks = $tasks->count();
        $inProgressTasks = $tasks->where('status', 'in_progress')->count();
        $pendingTasks = $tasks->where('status', 'pending')->count();
        $completedTasks = $tasks->where('status', 'completed')->count();
        $categories = auth()->user()->categories()->withCount('tasks')->get();
        $overdueTasks = $tasks->where('due_date', '<', $today)
            ->where('status', '!=', 'completed')
            ->count();
        $threeDaysLater = $today->addDays(3);
        $upcomingTasks = $tasks->whereBetween('due_date', [$today, $threeDaysLater])
            ->where('status', '!=', 'completed')
            ->count();

        return view('dashboard.index', compact('tasks', 'totalTasks', 'inProgressTasks', 'pendingTasks', 'completedTasks', 'categories', 'overdueTasks', 'upcomingTasks'));
    }


}
