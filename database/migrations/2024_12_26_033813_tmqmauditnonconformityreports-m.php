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
        Schema::create('tmqmauditnonconformityreports', function (Blueprint $table) {
            $table->id('i_id_ncrnnbr'); // Primary Key
            $table->string('i_id_audchknbr', 12); // Foreign Key to Audit Checklist
            $table->string('n_quality_element', 12)->nullable();
            $table->string('n_classification', 12)->nullable();
            $table->string('n_key_requirement', 24)->nullable();
            $table->string('n_reference', 300)->nullable();
            $table->string('n_responsible_mngr', 120)->nullable();
            $table->string('n_objective_evidence', 120)->nullable();
            $table->string('n_attachment', 24)->nullable();
            $table->string('n_root_cause', 120)->nullable();
            $table->string('n_impact', 120)->nullable();
            $table->string('n_details', 300)->nullable(); // Keterangan rinci
            $table->string('i_emp', 12)->nullable(); // ID pegawai
            $table->date('d_entry')->nullable(); // Waktu data dimasukkan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmqmauditnonconformityreports');
    }
};
