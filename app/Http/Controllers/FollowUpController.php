<?php

namespace App\Http\Controllers;

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
            $followUps = FollowUp::with('protocol')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $followUps = FollowUp::with('protocol')
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


    public function store(Request $request) {
        $followUpDataValidation = $request->validate([
            'observation' => 'required|string',
            'protocol_id' => 'required|exists:protocols,id',
        ]);

        $userId = auth()->user()->id;

        FollowUp::create([
            'observation' => $followUpDataValidation['observation'],
            'protocol_id' => $followUpDataValidation['protocol_id'],
            'user_id' => $userId,
        ]);
    }

    public function update(Request $request, $id) {
        $followUp = FollowUp::findOrFail($id);
        $validatedData = $request->validate([
            'observation' => 'required|string',
        ]);
        $followUp->update([
            'observation' => $validatedData['observation'],
        ]);

        return redirect()->intended('/follow-up/all');
    }

    public function destroy($id)
    {
        $followUp = FollowUp::findOrFail($id);
        $followUp->delete();
    }
}
