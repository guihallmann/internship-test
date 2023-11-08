<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuditController extends Controller
{
    public function index() {
        $audits = Audit::with("user")->get();
        return Inertia::render("Audit/Index", ['audits' => $audits]);
    }

    public function show(string $id) {
        try {
            $audit = Audit::with("user")->findOrfail($id);
            return Inertia::render('Audit/Show', ['audit' => $audit]);
        } catch(ModelNotFoundException $e) {
            // implementar excessões depois
            return;
        }
    }
}
