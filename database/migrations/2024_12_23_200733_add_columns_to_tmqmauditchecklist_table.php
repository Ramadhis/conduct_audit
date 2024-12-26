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
        Schema::table('tmqmauditchecklist', function (Blueprint $table) {
            $table->string('n_tempat')->nullable()->after('d_entry'); // Kolom 'tempat'
            $table->string('n_link')->nullable()->after('n_tempat');  // Kolom 'link'
            $table->date('d_waktu')->nullable()->after('n_link'); // Kolom 'waktu'
            $table->string('n_approve')->nullable()->after('d_waktu'); // Kolom 'approve'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmqmauditchecklist', function (Blueprint $table) {
            //
        });
    }
};
