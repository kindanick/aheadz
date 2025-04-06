<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $animals = Animal::with('cage')->paginate(12);
        return view('animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $cages = Cage::withCount('animals')->get();
        return view('animals.create', compact('cages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request): RedirectResponse
    {
        $cage = Cage::findOrFail($request->cage_id);
        
        if ($cage->animals()->count() >= $cage->capacity) {
            return back()->withErrors('В клетке нет свободных мест');
        }

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/animals');
            $data['image'] = Storage::url($path);
        }

        Animal::create($data);
        return redirect()->route('cages.index')->with('success', 'Животное добавлено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal): View
    {
        return view('animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal): View
    {
        $cages = Cage::all();
        return view('animals.edit', compact('animal', 'cages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal): RedirectResponse
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            if ($animal->image) {
                Storage::delete(str_replace('storage/', 'public/', $animal->image));
            }
            
            $path = $request->file('image')->store('public/animals');
            $data['image'] = Storage::url($path);
        }

        $animal->update($data);
        return redirect()->route('animals.show', $animal)->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal): RedirectResponse
    {
        if ($animal->image) {
            Storage::delete(str_replace('storage/', 'public/', $animal->image));
        }
        
        $animal->delete();
        return redirect()->route('cages.index')->with('success', 'Животное удалено');
    }
}
