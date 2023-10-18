<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;


class DepartmentController extends Controller
{
    public function index() {
        return Inertia::render('Department/Index', ['departments' => Department::all()]);
    }

    public function store(Request $request) {
        $departmentDataValidation = $request->validate([
            'name' => 'required|string'
        ]);
        Department::create($departmentDataValidation);
    }

    public function show(string $id) {
        try {
            $department = Department::findOrfail($id);
            return Inertia::render('Department/Edit', ['department' => $department]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function update(Request $request, string $id) {
        $departmentDataValidation = $request->validate([
            'name' => 'string|required'
        ]);
        Department::where('id', $id)->update($departmentDataValidation);
        return redirect()->intended('/department/all');
    }

    public function destroy(string $id) {
        try {
            Department::where('id', $id)->delete();
            return redirect()->intended('/department/all');
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function createDepartmentPage() {
        return Inertia::render('Department/Create');
    }
}
