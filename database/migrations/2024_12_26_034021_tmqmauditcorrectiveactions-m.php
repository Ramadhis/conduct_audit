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
        Schema::create('tmqmauditcorrectiveactions', function (Blueprint $table) {
            $table->id('i_id_corrective_nmbrn'); // Primary Key
            $table->unsignedBigInteger('i_id_ncrnnbr'); // Foreign Key to Non-Conformity Reports
            $table->string('n_action', 40)->nullable();
            $table->string('n_evidence', 40)->nullable();
            $table->string('n_responsible', 40)->nullable();
            $table->date('d_ecd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmqmauditcorrectiveactions');
    }
};
