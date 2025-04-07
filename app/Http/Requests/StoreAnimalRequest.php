<?php

namespace App\Http\Requests;

use App\Models\Cage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAnimalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'species' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer|min:0',
            'description' => 'sometimes|required|string',
            'cage_id' => [
                'sometimes',
                'required',
                'exists:cages,id',
                function ($attribute, $value, $fail) {
                    $cage = Cage::find($value);
                    $currentAnimal = $this->route('animal');

                    if (!$cage) {
                        $fail('Выбранная клетка не существует');
                        return;
                    }
                    
                    if ($cage->animals()->count() >= $cage->capacity ) {
                        $fail('В выбранной клетке нет свободных мест');
                    }
                }
            ],
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'cage_id.exists' => 'Выбранная клетка не существует',
            'image.max' => 'Размер изображения не должен превышать 2MB',
            'image.image' => 'Файл должен быть изображением'
        ];
    }
}
