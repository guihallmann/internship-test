<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;


class DepartmentController extends Controller
{
    public function index(Request $request) {
        return Inertia::render('Department/Index', [
            'departments' => Department::query()
            ->when($request->input('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->get(),
            'filters' => $request->only(["search"])
        ]); 
    }

    public function store(StoreDepartmentRequest $request) {
        $departmentDataValidation = $request->validated();
        Department::create($departmentDataValidation);
    }

    public function show(string $id) {
        try {
            $department = Department::findOrfail($id);
            $departmentUsers = $department->load('users');
            $allUser = User::all();
            return Inertia::render('Department/Show', [

                'departmentUsers' => $departmentUsers, 
                'users' => $allUser
            ]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }
    public function edit(string $id) {
        try {
            $department = Department::findOrfail($id);
            return Inertia::render('Department/Edit', ['department' => $department]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function update(StoreDepartmentRequest $request, string $id) {
        $departmentDataValidation = $request->validated();
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

    public function addUser(Request $request) {
        $user = User::findOrfail($request->user_id);
        $department = Department::findOrfail($request->department_id);
        $department->users()->syncWithoutDetaching($user->id);
    }

    public function removeUser(Request $request) {
        $user = User::findOrfail($request->user_id);
        $department = Department::findOrfail($request->department_id);
        $department->users()->detach($user->id);
    }

    public function createDepartmentPage() {
        return Inertia::render('Department/Create');
    }
}
