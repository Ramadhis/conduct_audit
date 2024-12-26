<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreAuditDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pre_audit_data')->insert([
            [
                'i_aud_plnnbr' => '2024-IA-01',
                'd_aud_year' => '2024',
                'i_aud_rvspgmnbr' => '0.0',
                'i_id_audpgm' => '140',
                'i_emp_auditorlead' => null,
                'n_aud_type' => 'INITIAL AUDIT',
                'n_aud_plan' => 'Internal Quality Audit',
                'n_subject' => 'Subject: Internal Quality Audit',
                'c_aud_org' => 'QA0000',
                'd_aud_start' => '2024-10-04',
                'd_aud_finish' => '2024-10-05',
                'i_id_cncrnc' => 'Bima Anggara',
                'f_aud_submit' => null,
            ],
            [
                'i_aud_plnnbr' => '2024-IA-02',
                'd_aud_year' => '2024',
                'i_aud_rvspgmnbr' => '0.0',
                'i_id_audpgm' => '141',
                'i_emp_auditorlead' => "Emp001",
                'n_aud_type' => 'INITIAL AUDIT',
                'n_aud_plan' => 'Supplier Performance Evaluation',
                'n_subject' => 'Subject: Supplier Performance Evaluation',
                'c_aud_org' => 'QA1001',
                'd_aud_start' => '2024-10-06',
                'd_aud_finish' => '2024-10-07',
                'i_id_cncrnc' => 'Bobi Putra',
                'f_aud_submit' => null,
            ],
            [
                'i_aud_plnnbr' => '2024-IA-03',
                'd_aud_year' => '2024',
                'i_aud_rvspgmnbr' => '0.0',
                'i_id_audpgm' => '142',
                'i_emp_auditorlead' => "Emp002",
                'n_aud_type' => 'INITIAL AUDIT',
                'n_aud_plan' => 'External Supplier Audit',
                'n_subject' => 'Subject: External Supplier Audit',
                'c_aud_org' => 'QA2002',
                'd_aud_start' => '2024-10-08',
                'd_aud_finish' => '2024-10-09',
                'i_id_cncrnc' => 'Ilham Rama',
                'f_aud_submit' => null,
            ],
            [
                'i_aud_plnnbr' => '2024-IA-04',
                'd_aud_year' => '2024',
                'i_aud_rvspgmnbr' => '0.0',
                'i_id_audpgm' => '143',
                'i_emp_auditorlead' => "Emp003",
                'n_aud_type' => 'INITIAL AUDIT',
                'n_aud_plan' => 'Re-Audit for Process Improvement',
                'n_subject' => 'Subject: Re-Audit for Process Improvement',
                'c_aud_org' => 'QA3003',
                'd_aud_start' => '2024-10-10',
                'd_aud_finish' => '2024-10-11',
                'i_id_cncrnc' => 'Arya Halim',
                'f_aud_submit' => null,
            ]
        ]);
    }
}
