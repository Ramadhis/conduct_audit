<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tmqmauditquestion extends Model
{
    use HasFactory;
    protected $table = 'tmqmauditquestion'; // Nama tabel di database
    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan
    protected $fillable = [
        'i_id_audchknbr',
        'i_id_reff',
        'n_audit_question',
        'n_audit_findings',
        'n_objective_evidence',
        'n_note',
        'n_attachment',
        'i_emp',
        'd_entry'
    ];

    protected $primaryKey = 'i_id_question';
    public $incrementing = true;
    protected $keyType = 'int';
}
