<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\tmqmauditchecklist;
use App\Models\tmqmauditquestion;
use App\Models\PreAuditData;


class AuditChecklistController extends Controller
{
    private $i_id_audit_cklsnmbr;

    public function index()
    {
        $auditChecklists = tmqmauditchecklist::all(); // Ambil semua data checklist
        return view('audit_checklist', compact('auditChecklists'));
    }

    public function edit($id)
    {
        $auditData = tmqmauditchecklist::findOrFail(urldecode($id)); // Ambil data berdasarkan ID
        $auditPlan = PreAuditData::where('i_aud_plnnbr', $auditData->i_id_audplnnbr)->firstOrFail(); // Relasi dengan tabel auditPlan
        return view('audit.update', compact('auditData', 'auditPlan'));
    }


    // Store Audit Checklist and Audit Questions
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            if ($this->storeAuditChecklist($request)) {
                $this->storeAuditQuestions($request);
            } else {
                throw new \Exception('Gagal memasukkan data audit checklist.');
            }
        });

        return redirect()->route('index')->with('success', 'Audit checklist and questions saved successfully!');
    }

    // Store Audit Checklist
    private function storeAuditChecklist(Request $request)
    {
        Log::info('Memulai penyimpanan audit checklist', ['request' => $request->all()]);

        $request->validate([
            'audit_plan_no' => 'required|string|max:12',
            'audit_type' => 'required|string|max:40',
            'program_code' => 'required|string|max:12',
            'subject' => 'required|string|max:120',
            'n_aud_plan' => 'required|string|max:120',
            'date_of_audit' => 'required|date',
            'area_manager' => 'required|string|max:12',
            'concurrence' => 'required|string|max:12',
        ]);

        // Generate Audit Checklist Number
        $auditTypeInitials = strtoupper(substr($request->audit_type, 0, 2));
        $programCode = strtoupper($request->program_code);

        $lastAudit = tmqmauditchecklist::where('i_id_audchknbr', 'LIKE', "$auditTypeInitials/$programCode/%")
            ->orderBy('i_id_audchknbr', 'desc')
            ->first();

        $newNumber = $lastAudit ? str_pad(((int)substr($lastAudit->i_id_audchknbr, -3)) + 1, 3, '0', STR_PAD_LEFT) : '001';
        $this->i_id_audit_cklsnmbr = "$auditTypeInitials/$programCode/$newNumber";

        tmqmauditchecklist::create([
            'i_id_audchknbr' => $this->i_id_audit_cklsnmbr,
            'i_id_audplnnbr' => $request->audit_plan_no,
            'n_aud_type' => $request->audit_type,
            'i_id_pgmcode' => $request->program_code,
            'subject' => $request->subject,
            'n_aud_plan' => $request->n_aud_plan,
            'd_actl_audstart' => $request->date_of_audit,
            'i_id_areamgr' => $request->area_manager,
            'i_id_cncrnc' => $request->concurrence
        ]);

        return true;
    }

    // Store Audit Questions
    private function storeAuditQuestions(Request $request)
    {
        $auditDataArray = json_decode($request->input('audit_details'), true);

        foreach ($auditDataArray as $auditData) {
            tmqmauditquestion::create([
                'i_id_audchknbr' => $this->i_id_audit_cklsnmbr,
                'i_id_reff' => $auditData['reference'],
                'n_audit_question' => $auditData['question'],
                'n_audit_findings' => $auditData['findings'],
                'n_objective_evidence' => $auditData['evidence'] ?? null,
                'n_note' => $auditData['note'] ?? null,
                'n_attachment' => $auditData['attachment'] ?? null,
            ]);
        }
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'date_of_audit' => 'required|date',
        ]);

        $audit = tmqmauditchecklist::findOrFail($request->input('audit_checklist_no'));
        $audit->update([
            'd_actl_audstart' => $request->date_of_audit,
        ]);

        // Redirect ke halaman lain sesuai kebutuhan
        return redirect()->route('audit.checklist');
    }
}
