<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function index() {
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
    }

    public function show(string $id) {
        try {
            $person = Person::findOrfail($id);
            return Inertia::render('EditPerson', ['person' => $person]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function update(Request $request, string $id) {
        $person = Person::findOrFail($id);
        $personDataValidation = $request->validate([
            'name' => 'required|string',
            'birthday' => 'required|date',
            'cpf' => 'required|unique:people,cpf,' . $person->id,
            'sex' => 'required|in:Masculino,Feminino,Outro',
            'city' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|string',
            'complement' => 'nullable|string',
        ]);
        Person::where('id', $id)->update($personDataValidation);
        return redirect()->intended('/people');
    }

    public function destroy(string $id) {
        try {
            Person::where('id', $id)->delete();
            return redirect()->intended('/people');
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function getPersonProtocols(string $id) {
        try {
            $personProtocols = Person::with('protocols')->findOrFail($id);
            return Inertia::render('PersonProtocols', ['protocols' => $personProtocols]);
        } catch (ModelNotFoundException $e){
            return;
        }
    }
}