<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pre_audit_data', function (Blueprint $table) {
            $table->id();
            $table->string('i_aud_plnnbr');
            $table->string('d_aud_year');
            $table->string('i_aud_rvspgmnbr');
            $table->string('i_id_audpgm');
            $table->string('i_emp_auditorlead')->nullable();
            $table->string('n_aud_type');
            $table->string('n_aud_plan');
            $table->string('n_subject');
            $table->string('c_aud_org');
            $table->date('d_aud_start');
            $table->date('d_aud_finish');
            $table->string('i_id_cncrnc');
            $table->boolean('f_aud_submit')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_audit_data');
    }
};
