<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class ProtocolController extends Controller
{
    public function index() {
         $protocols = Protocol::with('person')->get();
        return Inertia::render('Protocols', ['protocols' => $protocols]);
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
            $protocol = Protocol::findOrfail($id);
            return Inertia::render('EditProtocol', ['protocol' => $protocol]);
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
        return redirect()->intended('/protocols');
    }

    public function destroy(string $id) {
        try {
            Protocol::where('id', $id)->delete();
            return redirect()->intended('/protocols');
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }
}
