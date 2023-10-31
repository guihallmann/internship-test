<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request) {
        return Inertia::render('User/Index', [
            'users' => User::query()
            ->when($request->input('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%")->orWhere('cpf', 'like', "%{$search}%");
            })->get(),
            'filters' => $request->only(["search"]),
        ]); 
    }

    public function store(StoreUserRequest $request) {
        $userDataValidation = $request->validated();
        $userDataValidation['cpf'] = str_replace(['.', '-'], '', $userDataValidation['cpf']);
        User::create($userDataValidation);
    }

    public function show(string $id) {
        try {
            $user = User::findOrfail($id);
            return Inertia::render('User/Edit', ['user' => $user]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function update(EditUserRequest $request, string $id) {
        $userDataValidation = $request->validated();
        $userDataValidation['cpf'] = str_replace(['.', '-'], '', $userDataValidation['cpf']);
        User::where('id', $id)->update($userDataValidation);
        return redirect()->intended('/user/all');
    }

    public function destroy(string $id) {
        try {
            User::where('id', $id)->delete();
            return redirect()->intended('/user/all');
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }

    public function createUserPage() {
        return Inertia::render('User/Create');
    }
}
