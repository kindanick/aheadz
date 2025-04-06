@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Редактирование животного</h2>
            <form method="POST" action="{{ route('animals.update', $animal) }}" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Имя животного</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $animal->name) }}" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="species" class="form-label">Вид животного</label>
                        <input type="text" class="form-control" id="species" name="species" 
                               value="{{ old('species', $animal->species) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="age" class="form-label">Возраст</label>
                        <input type="number" class="form-control" id="age" name="age" 
                               value="{{ old('age', $animal->age) }}" min="0" required>
                    </div>

                    <div class="col-md-6">
                        <label for="cage_id" class="form-label">Клетка</label>
                        <select class="form-select" id="cage_id" name="cage_id" required>
                            @foreach($cages as $cage)
                            <option value="{{ $cage->id }}" 
                                {{ $cage->id == old('cage_id', $animal->cage_id) ? 'selected' : '' }}>
                                {{ $cage->name }} ({{ $cage->capacity - $cage->animals_count }} мест)
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="3" required>{{ old('description', $animal->description) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Новая фотография</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>

                    <div class="col-md-6">
                        @if($animal->image)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   id="remove_image" name="remove_image">
                            <label class="form-check-label" for="remove_image">
                                Удалить текущее фото
                            </label>
                        </div>
                        <small class="text-muted">Текущее фото:</small>
                        <img src="{{ asset($animal->image) }}" alt="Current image" 
                             class="img-thumbnail mt-2" style="max-height: 100px;">
                        @endif
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection