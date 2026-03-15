<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Изменить задачу #{{ $task->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Название задачи <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Категория
                            </label>
                            <select name="category_id" id="category_id"
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="" {{ old('category_id', $task->category_id) == null ? 'selected' : '' }}>
                                    Без категории
                                </option>
                                @foreach(auth()->user()->categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">
                                Приоритет <span class="text-red-500">*</span>
                            </label>
                            <select name="priority" id="priority" required
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>
                                    Низкий</option>
                                <option value="normal" {{ old('priority', $task->priority) == 'normal' ? 'selected' : '' }}>Нормальный</option>
                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>
                                    Высокий</option>
                            </select>
                            @error('priority')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Описание
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Статус <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                                    Ожидает</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>В работе</option>
                                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Завершена</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="due_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Дата выполнения
                            </label>
                            <input type="date" name="due_date" id="due_date"
                                value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            @error('due_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="bg-cyan-500 hover:bg-cyan-600 text-white font-medium px-6 py-3 rounded-md">
                                Сохранить изменения
                            </button>
                            <a href="{{ route('tasks.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-6 py-3 rounded-md inline-block">
                                Отмена
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>