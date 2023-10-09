<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function index() {
        // $all = Person::all()->map(fn($person) => ['name' => $person->name, 'id'=> $person->id]);
        $all = Person::all();
        return Inertia::render('People', ['people' => $all]);
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

        Person::create($personDataValidation);

        return redirect()->intended('/');
    }

    public function show(string $id) {
        $person = Person::findOrfail($id);
        return Inertia::render('EditPerson'. ['person' => $person]);
    }
}
