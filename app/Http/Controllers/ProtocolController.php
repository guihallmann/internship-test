<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Protocol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class ProtocolController extends Controller
{  
    public function index(Request $request) {
    return Inertia::render('Protocol/Index', [
        'protocols' => Protocol::with('person')
            ->when($request->input('search'), function($query, $search) {
                $query->whereHas('person', function($subquery) use ($search) {
                    $subquery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('cpf', 'like', '%' . $search . '%');
                });
            })
            ->get(),
        'filters' => $request->only(["search"])
    ]);
}


    public function store(Request $request) {
        $protocolDataValidation = $request->validate([
            'description' => 'required|string',
            'deadline' => 'required|integer',
            'person_id' => 'required|exists:people,id',
        ]);

        Protocol::create($protocolDataValidation);
    }

    public function show(string $id) {
        try {
            $protocol = Protocol::with('person')->findOrfail($id);
            return Inertia::render('Protocol/Edit', ['protocol' => $protocol, 'people' => Person::all()]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function update(Request $request, string $id) {
        $protocolDataValidation = $request->validate([
            'description' => 'required|string',
            'deadline' => 'required|integer',
            'person_id' => 'required|exists:people,id',
        ]);
        Protocol::where('id', $id)->update($protocolDataValidation);
        return redirect()->intended('/protocol/all');
    }

    public function destroy(string $id) {
        try {
            Protocol::where('id', $id)->delete();
            return redirect()->intended('/protocol/all');
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function createProtocolPage() {
        return Inertia::render('Protocol/Create', ['people' => Person::all()]);
    }
}
