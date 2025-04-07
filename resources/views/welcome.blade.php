@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2 class="mb-4">Клетки с животными</h2>
        <div class="row">
            @foreach($cages as $cage)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cage->sign }}</h5>
                        <p class="card-text">
                            <span class="badge bg-primary">Животных: {{ $cage->animals_count }}/{{ $cage->capacity }}</span>
                        </p>
                        <a href="{{ route('cages.show', $cage) }}" class="btn btn-outline-primary">
                            Подробнее →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Статистика зоопарка</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Всего животных
                        <span class="badge bg-primary rounded-pill">{{ $totalAnimals }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Всего клеток
                        <span class="badge bg-success rounded-pill">{{ $cages->count() }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection