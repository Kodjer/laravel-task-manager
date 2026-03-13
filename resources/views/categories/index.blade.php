<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Категории') }}
            </h2>
            <a href="{{ route('categories.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Создать категорию
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($categories->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($categories as $category)
                                <div class="border rounded-lg p-4 flex items-center justify-between"
                                    style="border-left: 4px solid {{ $category->color }}">
                                    <div>
                                        <h3 class="font-bold text-lg">{{ $category->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $category->tasks->count() }} задач</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            Изменить
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Удалить категорию?')">
                                                Удалить
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-8">
                            У вас пока нет категорий. Создайте первую!
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>