<x-app-layout>
    <x-slot name="header">
        <h3>Статистика</h3>
    </x-slot>
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; padding: 20px;">
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #999;font-size: 14px; margin-bottom: 10px;">Всего задач</h3>
            <p style="font-size: 48px; font-weight: bold; margin: 0; color: #333;">{{ $totalTasks }}</p>
        </div>
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #999;font-size: 14px; margin-bottom: 10px;">Выполнено</h3>
            <p style="font-size: 48px; font-weight: bold; margin: 0; color: #333;">{{ $completedTasks }}</p>
        </div>
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #999;font-size: 14px; margin-bottom: 10px;">В работе</h3>
            <p style="font-size: 48px; font-weight: bold; margin: 0; color: #333;">{{ $inProgressTasks }}</p>
        </div>
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #999;font-size: 14px; margin-bottom: 10px;">Ожидают</h3>
            <p style="font-size: 48px; font-weight: bold; margin: 0; color: #333;">{{ $pendingTasks }}</p>
        </div>
    </div>
    <div style="padding: 20px;">
        <h2>Задачи по категориям</h2>
        @foreach ($categories as $category)
            <div style="display: flex; gap: 10px; align-items: center">
                <div style="height: 20px; width: 20px; background-color: {{ $category->color }};"></div>
                <div> {{ $category->name }}</div>
                <div>{{ $category->tasks_count }}</div>
            </div>
        @endforeach
    </div>
</x-app-layout>