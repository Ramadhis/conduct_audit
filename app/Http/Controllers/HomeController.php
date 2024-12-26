<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PreAuditData;
use \App\Models\tmqmauditchecklist;
use \App\Models\tmqmauditquestion;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $data;

    public function index()
    {
        $preAudits = PreAuditData::all();
        return view('pre_audit_program', compact('preAudits'));
    }

    public function createAuditChecklist($id)
    {
        // Ambil data dari database berdasarkan ID
        $auditPlan = PreAuditData::findOrFail($id); // Pastikan model sesuai dengan tabel audit plan

        // Kirim data ke view
        return view('audit.create', compact('auditPlan'));
    }

    public function createAuditQuestion($id)
    {
        return view('audit.createQuestion');
    }

    public function auditChecklist()
    {
        $auditChecklist = tmqmauditchecklist::all();
        return view('audit_checklist', compact('auditChecklist'));
    }

    public function updateAuditChecklist($id, $id2)
    {
        $decodedId = urldecode($id);
        $decodedId2 = urldecode($id2);

        $auditData = tmqmauditchecklist::where('i_id_audchknbr', $decodedId)->firstOrFail();
        $auditPlan = PreAuditData::where('i_aud_plnnbr', $decodedId2)->firstOrFail();
        $auditQuestion  = tmqmauditquestion::where('i_id_audchknbr', $decodedId)->get();


        return view('audit.update', compact('auditData', 'auditPlan'));
    }

    public function updateAuditQuestion($id, $id2)
    {
        $decodedId = urldecode($id);
        $decodedId2 = urldecode($id2);

        $auditData = tmqmauditchecklist::where('i_id_audchknbr', $decodedId)->firstOrFail();
        $auditPlan = PreAuditData::where('i_aud_plnnbr', $decodedId2)->firstOrFail();
        $auditQuestion  = tmqmauditquestion::where('i_id_audchknbr', $decodedId)->get();


        return view('audit.updateQuestion', compact('auditQuestion'));
    }

    public function updateMeetingAuditChecklist($id, $id2)
    {
        $decodedId = urldecode($id);
        $decodedId2 = urldecode($id2);

        $auditData = tmqmauditchecklist::where('i_id_audchknbr', $decodedId)->firstOrFail();
        $auditPlan = PreAuditData::where('i_aud_plnnbr', $decodedId2)->firstOrFail();

        return view('audit.meeting', compact('auditData', 'auditPlan'));
    }
}
