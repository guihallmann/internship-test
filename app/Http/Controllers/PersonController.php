<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Person;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function index(Request $request) {
        return Inertia::render('Person/Index', [
            'people' => Person::query()
            ->when($request->input('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%")->orWhere('cpf', 'like', "%{$search}%");
            })->get(),
            'filters' => $request->only(["search"])
        ]); 
    }


    public function store(StorePersonRequest $request) {
        $personDataValidation = $request->validated();
        Person::create($personDataValidation);
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
        Person::where('id', $id)->update($personDataValidation);
        return redirect()->intended('/person/all');
    }

    public function destroy(string $id) {
        try {
            Person::where('id', $id)->delete();
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