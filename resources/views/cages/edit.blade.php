@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Редактирование клетки</h2>
            <form method="POST" action="{{ route('cages.update', $cage) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="sign" class="form-label">Название клетки</label>
                    <input type="text" class="form-control" id="sign" name="sign" 
                           value="{{ old('sign', $cage->sign) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="capacity" class="form-label">Вместимость</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" 
                           min="{{ $cage->animals_count }}" 
                           value="{{ old('capacity', $cage->capacity) }}" required>
                    <small class="form-text text-muted">
                        Минимум: {{ $cage->animals_count }} (текущее количество животных)
                    </small>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{ route('cages.index') }}" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection