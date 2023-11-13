<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\StoreProtocolRequest;
use App\Http\Requests\UploadAttachmentRequest;
use App\Models\Attachment;
use App\Models\Department;
use App\Models\Person;
use App\Models\Protocol;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
// use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as PDF;




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
        $protocol = Protocol::create($protocolDataValidation);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $this->uploadAttachment($file, $protocol->id);
            }
        }
        return redirect()->intended('/protocol/all');

    }

    public function show(string $id) {
        $protocol = Protocol::with('person', 'department', 'followUp', 'attachments')->findOrfail($id);
        return Inertia::render('Protocol/Show', ['protocol'=> $protocol]);
    }

    public function edit(string $id) {
        if(Auth::user()->role === 'Ti' || Auth::user()->role === 'Sys') {
            $departments = Department::orderBy('name', 'ASC')->get();
        } else {
            $user = Auth::user();
            $departments = $user->departments()->orderBy('name', 'ASC')->get(); // Load user's departments and order them by name.
        }
        try {
            $protocol = Protocol::with('person', 'department', 'attachments')->findOrfail($id);
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

    public function uploadAttachment($file, $protocolId)
    {
        $path = $file->store('attachments');
        Attachment::create([
            'name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'protocol_id' => $protocolId,
        ]);
    }

    public function uploadAttachments(StoreAttachmentRequest $request, $protocolId)
    {
        if ($request->hasFile('files')) {
            $fileCount = count($request->file('files'));
            $protocol = Protocol::findOrFail($protocolId);
            $attachmentsCount = $protocol->attachments->count();
            $remainingAttachments = 5 - $attachmentsCount;
            if ($fileCount <= $remainingAttachments) {
                foreach ($request->file('files') as $file) {
                    $this->uploadAttachment($file, $protocolId);
                }
            } else {
                return back()->withErrors(['files' => 'Você pode anexar mais ' . $remainingAttachments . ' ' . ($remainingAttachments == 1 ? 'arquivo' : 'arquivos')])->onlyInput('files');
            }
        }
    }

    public function downloadAttachment(string $id) {
        $attachment = Attachment::findOrFail($id);
        return Storage::download($attachment->file_path, $attachment->name);
    }

    public function destroyAttachment(string $id) {
        $attachment = Attachment::findOrFail($id);
        Storage::delete($attachment->file_path);
        $attachment->delete();
    }

    public function allProtocols() {
        $user = Auth::user();
        if ($user->role === 'Op') {
            $protocols = Protocol::whereIn('department_id', $user->departments->pluck('id'))->get();
        } else {
            $protocols = Protocol::all();
        }
        return $protocols;
    }

    public function allProtocolsReport() {
        $protocols = $this->allProtocols();
        $pdf = PDF::loadView('protocols', ['protocols' => $protocols]);
        return $pdf->download('Relatorio_Todos_Protocolos.pdf');
    }


    public function protocolReport(string $id) {
        $protocol = Protocol::findOrFail($id);
        $followUps = $protocol->followUp()->get();
        $pdf = Pdf::loadView('protocol', ['protocol' => $protocol, 'followUps' => $followUps]);
        return $pdf->download('Relatorio_Protocolo_'. $id.'.pdf');
    }
}
