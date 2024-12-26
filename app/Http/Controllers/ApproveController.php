<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tmqmauditchecklist;

class ApproveController extends Controller
{
    public function index()
    {
        $auditChecklists = tmqmauditchecklist::where('n_approve', null) // Gunakan nama kolom yang benar
            ->whereNotNull('n_link')   // Tambahkan kondisi untuk memastikan 'n_link' tidak null
            ->get(); // Mengambil semua data checklist


        return view('audit_data_approve', compact('auditChecklists'));
    }

    public function approve($id)
    {
        $audit = tmqmauditchecklist::where('i_id_audchknbr', urldecode($id))->firstOrFail();
        $audit->update([
            'n_approve' => "approved"
        ]);

        // Redirect ke halaman lain sesuai kebutuhan
        return redirect()->route('audit.checklist.approve');
    }
    public function reject($id)
    {
        $audit = tmqmauditchecklist::where('i_id_audchknbr', urldecode($id))->firstOrFail();
        $audit->update([
            'n_approve' => "rejected"
        ]);

        // Redirect ke halaman lain sesuai kebutuhan
        return redirect()->route('audit.checklist.approve');
    }
}
