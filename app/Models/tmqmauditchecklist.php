<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tmqmauditchecklist extends Model
{
    use HasFactory;

    protected $table = 'tmqmauditchecklist'; // Nama tabel di database
    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan

    protected $fillable = [
        'i_id_audchknbr',
        'i_id_audplnnbr',
        'subject',
        'i_id_pgmcode',
        'n_aud_plan',
        'd_actl_audstart',
        'i_id_areamgr',
        'i_id_cncrnc',
        'i_emp',
        'd_entry',
        'n_tempat',
        'n_link',
        'd_waktu',
        'n_approve'
    ];

    protected $primaryKey = 'i_id_audchknbr';
    public $incrementing = false;
    protected $keyType = 'string';
}
