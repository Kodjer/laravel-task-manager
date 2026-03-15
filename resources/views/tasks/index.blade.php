<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои задачи
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Кнопки -->
            <div class="mb-4 flex gap-2">
                <a href="{{ route('tasks.create') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded">
                    Создать задачу
                </a>
                <a href="{{ route('categories.create') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded">
                    Создать категорию
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    @if($tasks->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-full">
                                <thead>
                                    <tr class="border-b-2 border-gray-300">
                                        <th class="px-4 py-3 text-left text-gray-600 font-semibold">ID</th>
                                        <th class="px-4 py-3 text-left text-gray-600 font-semibold">Название</th>
                                        <th class="px-4 py-3 text-left text-gray-600 font-semibold">Категория</th>
                                        <th class="px-4 py-3 text-left text-gray-600 font-semibold">Статус</th>
                                        <th class="px-4 py-3 text-left text-gray-600 font-semibold">Приоритет</th>
                                        <th class="px-4 py-3 text-left text-gray-600 font-semibold">Дата</th>
                                        <th class="px-4 py-3 text-left text-gray-600 font-semibold">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-4">{{ $task->id }}</td>
                                            
                                            <!-- Название -->
                                            <td class="px-4 py-4">
                                                @if($task->due_date && $task->due_date < now() && $task->status != 'completed')
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                                        {{ $task->title }}
                                                    </span>
                                                @elseif($task->due_date && $task->due_date >= now() && $task->due_date <= now()->addDays(3) && $task->status != 'completed')
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 text-orange-800">
                                                        {{ $task->title }}
                                                    </span>
                                                @else
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">
                                                        {{ $task->title }}
                                                    </span>
                                                @endif
                                            </td>
                                            
                                            <!-- Категория -->
                                            <td class="px-4 py-4">
                                                @if($task->category)
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold text-white" 
                                                          style="background-color: {{ $task->category->color }};">
                                                        {{ $task->category->name }}
                                                    </span>
                                                @else
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-500">
                                                        Без категории
                                                    </span>
                                                @endif
                                            </td>
                                            
                                            <!-- Статус -->
                                            <td class="px-4 py-4">
                                                @if($task->status == 'pending')
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                                        Ожидает
                                                    </span>
                                                @elseif($task->status == 'in_progress')
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                                        В работе
                                                    </span>
                                                @else
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                                        Завершена
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4">
                                                @if($task->priority == 'high')
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                                        Высокий
                                                    </span>
                                                @elseif($task->priority == 'normal')
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                                        Средний
                                                    </span>
                                                @else
                                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                                        Низкий
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 text-gray-600">
                                                {{ $task->due_date ? $task->due_date->format('d.m.Y') : '-' }}
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="flex gap-2">
                                                    <a href="{{ route('tasks.show', $task) }}" 
                                                       class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-1 rounded text-sm font-medium">
                                                        Просмотр
                                                    </a>
                                                    <a href="{{ route('tasks.edit', $task) }}" 
                                                       class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-1 rounded text-sm font-medium">
                                                        Изменить
                                                    </a>
                                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium" 
                                                                onclick="return confirm('Удалить задачу?')">
                                                            Удалить
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-8 text-lg">
                            У вас пока нет задач. Создайте первую!
                        </p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>