@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Добавление нового животного</h2>
            <form method="POST" action="{{ route('animals.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Имя животного</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="species" class="form-label">Вид животного</label>
                        <input type="text" class="form-control" id="species" name="species" required>
                    </div>

                    <div class="col-md-6">
                        <label for="age" class="form-label">Возраст</label>
                        <input type="number" class="form-control" id="age" name="age" min="0" required>
                    </div>

                    <div class="col-md-6">
                        <label for="cage_id" class="form-label">Клетка</label>
                        <select class="form-select" id="cage_id" name="cage_id" required>
                            @foreach($cages as $cage)
                            <option value="{{ $cage->id }}" 
                                {{ $cage->id == request('cage_id') ? 'selected' : '' }}>
                                {{ $cage->sign }} ({{ $cage->capacity - $cage->animals_count }} мест)
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="3" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Фотография животного</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">Добавить животное</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection