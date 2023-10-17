<?php

namespace App\Http\Controllers;

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

    public function store(Request $request) {
        $userDataValidation = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email'],
            'cpf' => 'required|cpf',
            'role' => 'required|in:Ti,Sys,Op',
            'password' => 'required|min:6|max:20'
        ]);
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

    public function update(Request $request, string $id) {
        $userDataValidation = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email'],
            'cpf' => 'required|cpf',
            'role' => 'required|in:Ti,Sys,Op',
        ]);
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
}
