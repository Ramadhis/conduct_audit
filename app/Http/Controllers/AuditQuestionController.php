<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tmqmauditquestion;
use Illuminate\Support\Facades\DB;

class AuditQuestionController extends Controller
{
    // Fungsi untuk menampilkan halaman edit
    public function edit($id)
    {
        $auditQuestions = tmqmauditquestion::where('i_id_audchknbr', urldecode($id))->get();
        $auditQuestionsTitle = tmqmauditquestion::where('i_id_audchknbr', urldecode($id))->get()->pluck('i_id_audchknbr');

        return view('audit.updateQuestion', compact('auditQuestions', 'auditQuestionsTitle', 'id'));
    }

    // Fungsi untuk mengupdate data
    public function update(Request $request)
    {
        $request->validate([
            'ids.*' => 'required|integer|exists:tmqmauditquestion,i_id_question',
            'reference.*' => 'required|string|max:255',
            'question.*' => 'required|string|max:1000',
            'findings.*' => 'required|string|in:COMPLIANT,OFI,MAJOR NC,MINOR NC',
            'evidence.*' => 'nullable|string|max:1000',
            'note.*' => 'nullable|string|max:1000',
            'attachment.*' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);



        DB::transaction(function () use ($request) {
            foreach ($request->reference as $index => $reference) {
                $id = $request->ids[$index] ?? null; // Ambil ID jika ada, jika tidak null

                // Proses file attachment jika ada
                $attachmentPath = null;
                if ($request->hasFile("attachment.$index")) {
                    $attachmentPath = $request->file("attachment.$index")->store('attachments', 'public');
                }

                if ($id) {
                    // Update jika ID ada
                    $auditQuestion = tmqmauditquestion::findOrFail($id);
                    $auditQuestion->update([
                        'i_id_reff' => $reference,
                        'n_audit_question' => $request->question[$index],
                        'n_audit_findings' => $request->findings[$index],
                        'n_objective_evidence' => $request->evidence[$index] ?? null,
                        'n_note' => $request->note[$index] ?? null,
                        'n_attachment' => $attachmentPath ?? $auditQuestion->n_attachment,
                    ]);
                } else {
                    // Insert jika ID tidak ada
                    tmqmauditquestion::create([
                        'i_id_audchknbr' => $request->audit_checklist_id, // Pastikan ini dikirim dari form
                        'i_id_reff' => $reference,
                        'n_audit_question' => $request->question[$index],
                        'n_audit_findings' => $request->findings[$index],
                        'n_objective_evidence' => $request->evidence[$index] ?? null,
                        'n_note' => $request->note[$index] ?? null,
                        'n_attachment' => $attachmentPath,
                    ]);
                }
            }
        });


        return redirect()->route('audit.checklist.edit', ['id' => urlencode($request->input('audit_checklist_id'))])
            ->with('success', 'Audit questions updated successfully!');
    }
}