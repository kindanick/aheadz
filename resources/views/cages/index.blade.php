@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Список клеток</h1>
    @auth
    <a href="{{ route('cages.create') }}" class="btn btn-success">Добавить клетку</a>
    @endauth
</div>

<div class="row">
    @foreach($cages as $cage)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $cage->sign }}</h5>
                <p class="card-text">
                    Вместимость: {{ $cage->capacity }}<br>
                    Свободно мест: {{ $cage->capacity - $cage->animals_count }}
                </p>
                <div class="d-grid gap-2">
                    <a href="{{ route('cages.show', $cage) }}" class="btn btn-primary">Просмотр</a>
                    @auth
                    <div class="btn-group">
                        <a href="{{ route('cages.edit', $cage) }}" class="btn btn-outline-secondary">Изменить</a>
                        <form action="{{ route('cages.destroy', $cage) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" 
                                onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection