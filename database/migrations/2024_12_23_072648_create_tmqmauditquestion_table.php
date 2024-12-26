<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tmqmauditquestion', function (Blueprint $table) {
            $table->id('i_id_question'); // Primary Key
            $table->string('i_id_audchknbr', 12); // Foreign Key to Audit Checklist
            $table->string('i_id_reff', 12);
            $table->string('n_audit_question', 300);
            $table->string('n_audit_findings', 300)->nullable();
            $table->string('n_objective_evidence', 300)->nullable();
            $table->string('n_note', 300)->nullable();
            $table->string('n_attachment', 300)->nullable();
            $table->string('i_emp', 12)->nullable(); // ID pegawai
            $table->date('d_entry')->nullable(); // Waktu data dimasukkan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmqmauditquestion');
    }
};
