@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mt-5">
            <h1 class="display-1 text-danger">404</h1>
            <p class="lead">Запрошенная страница не найдена</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                Вернуться на главную
            </a>
        </div>
    </div>
</div>
@endsection