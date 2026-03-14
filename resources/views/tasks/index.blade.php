<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список задач</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #f8f9fa;
            font-weight: bold;
        }

        .status {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status.in_progress {
            background: #cfe2ff;
            color: #084298;
        }

        .status.completed {
            background: #d1e7dd;
            color: #0f5132;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 3px;
        }

        .btn-view {
            background: #17a2b8;
            color: white;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📋 Мои задачи</h1>

        <a href="{{ route('tasks.create') }}" class="btn">➕ Создать новую задачу</a>

        @if(session('success'))
            <div class="success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($tasks->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Статус</th>
                        <th>Приоритет</th>
                        <th>Дата выполнения</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                                @if ($task->category)
                                    <span style="color: {{ $task->category->color }}; font-weigt: bold;">
                                        {{ $task->category->name }}
                                    </span>
                                @else
                                    <span style="color: #999;">Без категории</span>
                                @endif
                            </td>
                            <td>
                                <span class="status {{ $task->status }}">
                                    @if($task->status == 'pending') Ожидает
                                    @elseif($task->status == 'in_progress') В работе
                                    @else Завершена
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if ($task->priority == 'high')
                                    <span style="color: #dc3545; font-weight: bold;">Высокий</span>
                                @elseif ($task->priority == 'normal')
                                    <span style="color: #ffc107; font-weight: bold;">Нормальный</span>
                                @else
                                    <span style="color: #28a745; font-weight: bold;">Низкий</span>
                                @endif
                            </td>
                            <td>
                                @if($task->due_date)
                                    {{ $task->due_date->format('d.m.Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('tasks.show', $task) }}" class="btn-small btn-view">Просмотр</a>
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn-small btn-edit">Изменить</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-small btn-delete"
                                            onclick="return confirm('Удалить задачу?')">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; color: #666; padding: 40px;">
                У вас пока нет задач. Создайте первую!
            </p>
        @endif
    </div>
</body>

</html>