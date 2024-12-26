<?php

namespace App\Http\Controllers;

use App\Models\tmqmauditchecklist;
use App\Models\PreAuditData;
use App\Models\TmqmAuditNonconformityReports;
use App\Models\TmqmAuditContainmentActions;
use App\Models\TmqmAuditCorrectiveActions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NcrController extends Controller
{
    private $i_id_ncrnnbr;

    public function index()
    {
        $auditChecklists = tmqmauditchecklist::where('n_approve', "approved")
            ->whereNotNull('n_link')
            ->get();
        return view('audit_data_ncr', compact('auditChecklists'));
    }

    public function create($id)
    {
        $auditData = tmqmauditchecklist::findOrFail(urldecode($id));
        $auditPlan = PreAuditData::where('i_aud_plnnbr', $auditData->i_id_audplnnbr)->firstOrFail();
        return view('audit.ncreport', compact('auditData', 'auditPlan'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $this->storeNoncoformityReport($request);
            $this->storeContainmentAction($request);
            $this->storeCorrectiveAction($request);
        });

        return redirect()->route('audit.checklist.ncr')->with('success', 'Non-Conformity Report successfully saved!');
    }

    public function storeNoncoformityReport(Request $request)
    {
        $lastRecord = TmqmAuditNonconformityReports::orderBy('i_id_ncrnnbr', 'desc')->first();
        $lastNumber = $lastRecord ? intval($lastRecord->i_id_ncrnnbr) : 0;

        $this->i_id_ncrnnbr = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        TmqmAuditNonconformityReports::create([
            'i_id_ncrnnbr' => $this->i_id_ncrnnbr,
            'i_id_audchknbr' => $request->input('audit_checklist_id'),
            'n_quality_element' => $request->input('quality_element'),
            'n_classification' => $request->input('classification'),
            'n_key_requirement' => $request->input('key_requirement'),
            'n_reference' => $request->input('reference'),
            'n_responsible_mngr' => $request->input('responsible_manager'),
            'n_objective_evidence' => $request->input('objective_evidence'),
            'n_attachment' => $request->file('attachment')
                ? $request->file('attachment')->store('attachments', 'public')
                : null,
            'n_root_cause' => $request->input('root_cause'),
            'n_impact' => $request->input('impact'),
            'n_details' => $request->input('verification_notes'),
        ]);
    }

    private function storeContainmentAction(Request $request)
    {
        $containmentActions = $request->input('containment_action', []);
        $containmentEvidences = $request->file('containment_evidence', []);
        $containmentResponsibles = $request->input('containment_responsible', []);
        $containmentECDs = $request->input('containment_ecd', []);

        foreach ($containmentActions as $key => $action) {
            TmqmAuditContainmentActions::create([
                'i_id_ncrnnbr' => $this->i_id_ncrnnbr,
                'n_action' => $action,
                'n_evidence' => isset($containmentEvidences[$key])
                    ? $containmentEvidences[$key]->store('containment_evidence', 'public')
                    : null,
                'n_responsible' => $containmentResponsibles[$key],
                'd_ecd' => $containmentECDs[$key],
            ]);
        }
    }

    private function storeCorrectiveAction(Request $request)
    {
        $correctiveActions = $request->input('corrective_action', []);
        $correctiveEvidences = $request->file('corrective_evidence', []);
        $correctiveResponsibles = $request->input('corrective_responsible', []);
        $correctiveECDs = $request->input('corrective_ecd', []);

        foreach ($correctiveActions as $key => $action) {
            TmqmAuditCorrectiveActions::create([
                'i_id_ncrnnbr' => $this->i_id_ncrnnbr,
                'n_action' => $action,
                'n_evidence' => isset($correctiveEvidences[$key])
                    ? $correctiveEvidences[$key]->store('corrective_evidence', 'public')
                    : null,
                'n_responsible' => $correctiveResponsibles[$key],
                'd_ecd' => $correctiveECDs[$key],
            ]);
        }
    }
}
