<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowUpRequest;
use App\Models\Department;
use App\Models\FollowUp;
use App\Models\Person;
use App\Models\Protocol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class FollowUpController extends Controller
{  
    public function index() {
        $user = Auth::user();

        if ($user->role === 'Ti' || $user->role === 'Sys') {
            $followUps = FollowUp::with('protocol','user')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $followUps = FollowUp::with('protocol','user')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return Inertia::render('FollowUp/Index', ['followUps' => $followUps]);
    }

    public function show(string $id) {
        try {
            $followUp = FollowUp::findOrfail($id);
            return Inertia::render('FollowUp/Edit', ['followUp' => $followUp]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }


    public function store(StoreFollowUpRequest $request) {
        $followUpDataValidation = $request->validated();

        $userId = auth()->user()->id;
        $followUpDataValidation['user_id'] = $userId;

        FollowUp::create($followUpDataValidation);
    }

    public function update(StoreFollowUpRequest $request, $id) {
        $followUp = FollowUp::findOrFail($id);
        $validatedData = $request->validated();
        $followUp->update($validatedData);

        return redirect()->intended('/follow-up/all');
    }

    public function destroy($id)
    {
        FollowUp::findOrFail($id)->delete();   
    }
}
