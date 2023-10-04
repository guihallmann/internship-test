<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function index() {
        $all = Person::all()->map(fn($person) => ['name' => $person->name, 'id'=> $person->id]);
        return Inertia::render('Home', ['people' => $all]);
    }

    public function store(Request $request) {
        $personDataValidation = $request->validate([
            'name' => 'required|string',
            'birthday' => 'required|date',
            'cpf' => 'required|string|unique:people,cpf',
            'sex' => 'required|in:Masculino,Feminino,Outro',
            'city' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|string',
            'complement' => 'nullable|string',
        ]);

        $person = Person::create($personDataValidation);

        return response()->json(['message' => 'Person created successfully', 'data' => $person], 201);
    }
}
