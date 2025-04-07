@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Все животные</h1>
        @auth
        <a href="{{ route('animals.create') }}" class="btn btn-success">
            Добавить животное
        </a>
        @endauth
    </div>

    <div class="row">
        @foreach($animals as $animal)
        <div class="col-md-4 mb-4">
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
                       class="btn btn-primary">Подробнее</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection