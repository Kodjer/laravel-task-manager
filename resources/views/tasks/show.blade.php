<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Просмотр задачи #{{ $task->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">
                    <div class="border-b pb-4">
                        <div class="text-sm font-semibold text-gray-600 mb-2">Название:</div>
                        <div class="text-lg text-gray-900">{{ $task->title }}</div>
                    </div>
                    <div class="border-b pb-4">
                        <div class="text-sm font-semibold text-gray-600 mb-2">Категория:</div>
                        <div>
                            @if($task->category)
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold text-white"
                                    style="background-color: {{ $task->category->color }};">
                                    {{ $task->category->name }}
                                </span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-500">
                                    Без категории
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="border-b pb-4">
                        <div class="text-sm font-semibold text-gray-600 mb-2">Описание:</div>
                        <div class="text-gray-900">
                            @if($task->description)
                                {{ $task->description }}
                            @else
                                <em class="text-gray-400">Нет описания</em>
                            @endif
                        </div>
                    </div>
                    <div class="border-b pb-4">
                        <div class="text-sm font-semibold text-gray-600 mb-2">Статус:</div>
                        <div>
                            @if($task->status == 'pending')
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                    Ожидает
                                </span>
                            @elseif($task->status == 'in_progress')
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                    В работе
                                </span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    Завершена
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="border-b pb-4">
                        <div class="text-sm font-semibold text-gray-600 mb-2">Приоритет:</div>
                        <div>
                            @if($task->priority == 'high')
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                    Высокий
                                </span>
                            @elseif($task->priority == 'normal')
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                    Средний
                                </span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    Низкий
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="border-b pb-4">
                        <div class="text-sm font-semibold text-gray-600 mb-2">Дата выполнения:</div>
                        <div class="text-gray-900">
                            @if($task->due_date)
                                {{ $task->due_date->format('d.m.Y') }}
                            @else
                                <em class="text-gray-400">Не указана</em>
                            @endif
                        </div>
                    </div>
                    <div class="border-b pb-4">
                        <div class="text-sm font-semibold text-gray-600 mb-2">Создана:</div>
                        <div class="text-gray-900">{{ $task->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-600 mb-2">Обновлена:</div>
                        <div class="text-gray-900">{{ $task->updated_at->format('d.m.Y H:i') }}</div>
                    </div>

                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Подзадачи</h3>

                    @php
                        $total = $task->subtasks->count();
                        $completed = $task->subtasks->where('is_completed', true)->count();
                        $percentage = $total > 0 ? round(($completed / $total) * 100) : 0; 
                    @endphp

                    <p class="text-sm text-gray-600 mb-4">
                        {{ $completed }} из {{ $total }} выполнено ({{ $percentage }}%)
                    </p>
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-6">
                        <div class="bg-green-500 h-3 rounded-full transition-all duration-300"
                            style="width: {{ $percentage }}%"></div>
                    </div>
                    <form action="{{ route('subtasks.store', $task) }}" method="POST" class="mb-6">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text" name="title" placeholder="Новая подзадача" required
                                class="flex-1 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-md">
                                Добавить
                            </button>
                        </div>
                    </form>
                    <div class="space-y-3">
                        @foreach($task->subtasks as $subtask)
                            <div
                                class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <form action="{{ route('subtasks.toggle', $subtask) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" {{ $subtask->is_completed ? 'checked' : '' }}
                                        onchange="this.form.submit()"
                                        class="w-5 h-5 text-green-500 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                                </form>
                                <span
                                    class="flex-1 {{ $subtask->is_completed ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                    {{ $subtask->title }}
                                </span>
                                <form action="{{ route('subtasks.destroy', $subtask) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Удалить подзадачу?')"
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    @if($task->subtasks->count() == 0)
                        <p class="text-center text-gray-400 py-4">Нет подзадач. Добавьте первую!</p>
                    @endif
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <a href="{{ route('tasks.edit', $task) }}"
                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-medium px-6 py-3 rounded-md">
                    Изменить
                </a>
                <a href="{{ route('tasks.index') }}"
                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-medium px-6 py-3 rounded-md">
                    Назад к списку
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить задачу?')"
                        class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-md">
                        Удалить
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>