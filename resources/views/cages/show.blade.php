@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $cage->name }}</h1>
        @auth
        <a href="{{ route('animals.create', ['cage_id' => $cage->id]) }}" 
           class="btn btn-success">Добавить животное</a>
        @endauth
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Информация о клетке</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Вместимость: {{ $cage->capacity }}
                        </li>
                        <li class="list-group-item">
                            Свободно мест: {{ $cage->capacity - $cage->animals->count() }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h3 class="mb-3">Обитатели клетки</h3>
            @if($cage->animals->isEmpty())
            <div class="alert alert-info">В клетке пока нет животных</div>
            @else
            <div class="row">
                @foreach($cage->animals as $animal)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        @if($animal->image)
                        <img src="{{ asset($animal->image) }}" class="card-img-top" 
                             alt="{{ $animal->name }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $animal->name }}</h5>
                            <p class="card-text">
                                Вид: {{ $animal->species }}<br>
                                Возраст: {{ $animal->age }} лет
                            </p>
                            <a href="{{ route('animals.show', $animal) }}" 
                               class="btn btn-outline-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection