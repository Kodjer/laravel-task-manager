<x-app-layout>
    <x-slot name="header">
        <h3>Статистика</h3>
    </x-slot>
    <div style="display: grid; grid-template-columns: repeat(3, 2fr); gap: 20px; padding: 20px;">
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
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #999;font-size: 14px; margin-bottom: 10px;">Просроченные</h3>
            <p style="font-size: 48px; font-weight: bold; margin: 0; color: #DC2626;">{{ $overdueTasks }}</p>
        </div>
        <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #999;font-size: 14px; margin-bottom: 10px;">Скоро дедлайн</h3>
            <p style="font-size: 48px; font-weight: bold; margin: 0; color: #F59E0B;">{{ $upcomingTasks }}</p>
        </div>
    </div>
    <div style="padding: 20px;">
        <h3 style="font-size: 25px; font-weight:bold; padding-bottom: 20px;">Задачи по категориям</h3>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px">
            @foreach ($categories as $category)
                <div
                    style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 15px;">
                    <div style="width: 40px; height: 20px; border-radius: 5px; background: {{ $category->color }};"></div>
                    <span style="flex: 1; font-weight: bold; font-size: 16px;">{{ $category->name }}</span>
                    <span style="font-size: 24px; font-weight: bold; color: #333;">{{ $category->tasks_count }}</span>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>