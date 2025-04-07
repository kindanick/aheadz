@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Создание новой клетки</h2>
            <form method="POST" action="{{ route('cages.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="sign" class="form-label">Название клетки</label>
                    <input type="text" class="form-control" id="sign" name="sign" required>
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">Вместимость</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" 
                           min="1" value="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Создать клетку</button>
            </form>
        </div>
    </div>
</div>
@endsection