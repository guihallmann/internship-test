<?php

namespace App\Http\Controllers;

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
    public function index(Request $request) {
        $user = Auth::user();

        $query = Protocol::with(['person', 'department']) // Eager load the 'department' relationship
            ->when($request->input('search'), function($query, $search) {
                $query->whereHas('person', function($subquery) use ($search) {
                    $subquery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('cpf', 'like', '%' . $search . '%');
                });
            });

        if ($user->role !== 'Ti' && $user->role !== 'Sys') {
            $departmentProtocols = $user->departments->flatMap(function ($department) {
                return $department->protocols->pluck('id');
            });

            if ($departmentProtocols->isNotEmpty()) {
                $query->whereIn('id', $departmentProtocols);
            } else {
                return Inertia::render('Protocol/Index', [
                    'protocols' => [],
                    'filters' => $request->only(["search"])
                ]);
            }
        }

        return Inertia::render('Protocol/Index', [
            'protocols' => $query->get(),
            'filters' => $request->only(["search"])
        ]);
}


    public function store(Request $request) {
        $protocolDataValidation = $request->validate([
            'description' => 'required|string',
            'deadline' => 'required|integer',
            'person_id' => 'required|exists:people,id',
            'department_id' => 'required|exists:departments,id'
        ]);

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

    public function update(Request $request, string $id) {
        $protocolDataValidation = $request->validate([
            'description' => 'required|string',
            'deadline' => 'required|integer',
            'person_id' => 'required|exists:people,id',
            'department_id' => 'required|exists:departments,id'
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
        if(Auth::user()->role === 'Ti' || Auth::user()->role === 'Sys') {
            $departments = Department::orderBy('name', 'ASC')->get();
        } else {
            $user = Auth::user();
            $departments = $user->departments()->orderBy('name', 'ASC')->get(); // Load user's departments and order them by name.
        }
        return Inertia::render('Protocol/Create', ['people' => Person::all(), 'departments' => $departments]);
    }
}
