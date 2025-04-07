<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCageRequest;
use App\Http\Requests\UpdateCageRequest;
use App\Models\Cage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cages = Cage::withCount('animals')->get();
        return view('cages.index', compact('cages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['created_by'] = Auth::user()['id'];

        Cage::create($data);
        
        return redirect()->route('cages.index')->with('success', 'Клетка создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cage $cage): View
    {
        $cage->load('animals');
        return view('cages.show', compact('cage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cage $cage): View
    {
        return view('cages.edit', compact('cage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCageRequest $request, Cage $cage): RedirectResponse
    {
        $updatedCage = $request->validated();
        $cage->update($updatedCage);
        return redirect()->route('cages.index')->with('success', 'Клетка обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cage $cage): RedirectResponse
    {
        if ($cage->animals()->exists()) {
            return back()->withErrors('Нельзя удалить клетку с животными');
        }
        
        $cage->delete();
        return redirect()->route('cages.index')->with('success', 'Клетка удалена');
    }
}
