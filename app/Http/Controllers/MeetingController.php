<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tmqmauditchecklist;
use App\Models\PreAuditData;

class MeetingController extends Controller
{
    public function edit($id)
    {
        $auditData = tmqmauditchecklist::where('i_id_audchknbr', urldecode($id))->firstOrFail();
        $auditPlan = PreAuditData::where('i_aud_plnnbr', $auditData->i_id_audplnnbr)->firstOrFail();
        return view('audit.meeting', compact('auditData', 'auditPlan'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'tempat' => 'required|string',
            'link_m' => 'required',
            'date' => 'required|date',
            'hour-minute' => 'required',
        ]);

        $audit = tmqmauditchecklist::findOrFail($request->input('audit_check_no'));
        $audit->update([
            'n_tempat' => $validated['tempat'],
            'n_link' => $validated['link_m'],
            'd_waktu' => $validated['date'] . ' ' . $validated['hour-minute'],
        ]);

        return redirect()->route('audit.checklist.edit', ['id' => $request->input('audit_check_no')]);
    }
}
