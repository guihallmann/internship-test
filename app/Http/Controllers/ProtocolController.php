<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProtocolRequest;
use App\Models\Department;
use App\Models\Person;
use App\Models\Protocol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class ProtocolController extends Controller
{  
    public function index() {
        $user = Auth::user();
        if ($user->role === 'Op') {
            $protocols = Protocol::whereIn('department_id', $user->departments->pluck('id'))
                ->with('person', 'department', 'followUp')
                ->get();
        } else {
            $protocols = Protocol::with('person', 'department', 'followUp')->get();
        }
        
        return Inertia::render('Protocol/Index', ['protocols' => $protocols]);
    }
    public function store(StoreProtocolRequest $request) {
        $protocolDataValidation = $request->validated();
        Protocol::create($protocolDataValidation);
    }

    public function show(string $id) {
        if(Auth::user()->role === 'Ti' || Auth::user()->role === 'Sys') {
            $departments = Department::orderBy('name', 'ASC')->get();
        } else {
            $user = Auth::user();
            $departments = $user->departments()->orderBy('name', 'ASC')->get(); // Load user's departments and order them by name.
        }
        try {
            $protocol = Protocol::with('person', 'department')->findOrfail($id);
            return Inertia::render('Protocol/Edit', ['protocol' => $protocol, 'people' => Person::all(), 'departments' => $departments]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function update(StoreProtocolRequest $request, string $id) {
        $protocolDataValidation = $request->validated();
        Protocol::findOrFail($id)->update($protocolDataValidation);
        return redirect()->intended('/protocol/all');
    }

    public function destroy(string $id) {
        try {
            Protocol::findOrFail($id)->delete();
            return redirect()->intended('/protocol/all');
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function createProtocolPage() {
        if(Auth::user()->role === 'Ti' || Auth::user()->role === 'Sys') {
            $departments = Department::orderBy('name', 'ASC')->get();
        } else {
            $user = Auth::user();
            $departments = $user->departments()->orderBy('name', 'ASC')->get(); // Load user's departments and order them by name.
        }
        return Inertia::render('Protocol/Create', ['people' => Person::all(), 'departments' => $departments]);
    }
}
