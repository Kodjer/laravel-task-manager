<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр задачи</title>
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
            max-width: 600px;
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

        .detail-group {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .detail-group:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #666;
            margin-bottom: 5px;
        }

        .value {
            color: #333;
            font-size: 16px;
        }

        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
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

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Просмотр задачи #{{ $task->id }}</h1>

        <div class="detail-group">
            <div class="label">Название:</div>
            <div class="value">{{ $task->title }}</div>
        </div>
        <div class="detail-group">
            <div class="label">Категория:<div>
                    <div class="value">
                        @if ($task->category)
                            <span style="color: {{ $task->category->color }}; font-weight: bold;">
                                {{ $task->category->name }}
                            </span>
                        @else
                            <span style="color: #999">Без категории</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="detail-group">
            <div class="label">Описание:</div>
            <div class="value">
                @if($task->description)
                    {{ $task->description }}
                @else
                    <em style="color: #999;">Нет описания</em>
                @endif
            </div>
        </div>
        <div class="detail-group">
            <div class="label">Статус:</div>
            <div class="value">
                <span class="status {{ $task->status }}">
                    @if($task->status == 'pending') Ожидает
                    @elseif($task->status == 'in_progress') В работе
                    @else Завершена
                    @endif
                </span>
            </div>
        </div>
        <div class="detail-group">
            <div class="label">Приоритет:</div>
            <div class="value">
                <span class="priority {{ $task->priority }}">
                    @if ($task->priority == 'low') Низкий
                    @elseif ($task->priority == 'normal') Нормальный
                    @else Высокий
                    @endif
                </span>
            </div>
        </div>
        <div class="detail-group">
            <div class="label">Дата выполнения:</div>
            <div class="value">
                @if($task->due_date)
                    {{ $task->due_date->format('d.m.Y') }}
                @else
                    <em style="color: #999;">Не указана</em>
                @endif
            </div>
        </div>

        <div class="detail-group">
            <div class="label">Создана:</div>
            <div class="value">{{ $task->created_at->format('d.m.Y H:i') }}</div>
        </div>

        <div class="detail-group">
            <div class="label">Обновлена:</div>
            <div class="value">{{ $task->updated_at->format('d.m.Y H:i') }}</div>
        </div>

        <div class="buttons">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-edit">Изменить</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete"
                    onclick="return confirm('Удалить задачу?')">Удалить</button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Назад к списку</a>
        </div>
    </div>
</body>

</html>