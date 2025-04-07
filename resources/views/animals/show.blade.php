@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                @if($animal->image)
                <img src="{{ asset($animal->image) }}" class="card-img-top" 
                     alt="{{ $animal->name }}" style="max-height: 400px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $animal->name }}</h2>
                    <p class="card-text">{{ $animal->description }}</p>
                    @auth
                    <div class="btn-group w-100">
                        <a href="{{ route('animals.edit', $animal) }}" 
                           class="btn btn-outline-secondary">Редактировать</a>
                        <form action="{{ route('animals.destroy', $animal) }}" method="POST">
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

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Подробная информация</h4>
                    <dl class="row">
                        <dt class="col-sm-3">Вид:</dt>
                        <dd class="col-sm-9">{{ $animal->species }}</dd>

                        <dt class="col-sm-3">Возраст:</dt>
                        <dd class="col-sm-9">{{ $animal->age }} лет</dd>

                        <dt class="col-sm-3">Клетка:</dt>
                        <dd class="col-sm-9">
                            <a href="{{ route('cages.show', $animal->cage) }}">
                                {{ $animal->cage->sign }}
                            </a>
                        </dd>

                        <dt class="col-sm-3">Дата добавления:</dt>
                        <dd class="col-sm-9">{{ $animal->created_at->format('d.m.Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection