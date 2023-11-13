<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Person;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function index() {
        return Inertia::render('Person/Index', [
            'people' => Person::all(),
        ]); 
    }


    public function store(StorePersonRequest $request) {
        $personDataValidation = $request->validated();
        $personDataValidation['cpf'] = str_replace(['.', '-'], '', $personDataValidation['cpf']);
        Person::create($personDataValidation);
        return redirect()->intended('/person/all');
    }

    public function show(string $id) {
        try {
            $person = Person::findOrfail($id);
            return Inertia::render('Person/Edit', ['person' => $person]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function update(StorePersonRequest $request, string $id) {
        $personDataValidation = $request->validated();
        $personDataValidation['cpf'] = str_replace(['.', '-'], '', $personDataValidation['cpf']);
        Person::findOrFail($id)->update($personDataValidation);
        return redirect()->intended('/person/all');
    }

    public function destroy(string $id) {
        try {
            Person::findOrFail($id)->delete();
            return redirect()->intended('/person/all');
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function createPersonPage() {
        return Inertia::render('Person/Create');
    }

    // public function getPersonProtocols(string $id) {
    //     try {
    //         $personProtocols = Person::with('protocols')->findOrFail($id);
    //         return Inertia::render('PersonProtocols', ['protocols' => $personProtocols]);
    //     } catch (ModelNotFoundException $e){
    //         return;
    //     }
    // }
}