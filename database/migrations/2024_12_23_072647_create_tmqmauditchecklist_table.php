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
        Schema::create('tmqmauditchecklist', function (Blueprint $table) {
            $table->string('i_id_audchknbr', 12)->primary(); // Primary Key
            $table->string('i_id_audplnnbr', 12);
            $table->string('subject', 40)->nullable();
            $table->string('i_id_pgmcode', 12)->nullable();
            $table->string('n_aud_plan', 120)->nullable();
            $table->date('d_actl_audstart')->nullable();
            $table->string('i_id_areamgr', 12)->nullable();
            $table->string('i_id_cncrnc', 12)->nullable();
            $table->string('i_emp', 12)->nullable(); // ID pegawai
            $table->date('d_entry')->nullable(); // Waktu data dimasukkan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmqmauditchecklist');
    }
};
