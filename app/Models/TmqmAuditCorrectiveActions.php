<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmqmAuditCorrectiveActions extends Model
{
    use HasFactory;

    protected $table = 'tmqmauditcorrectiveactions';

    protected $fillable = [
        'i_id_ncrnnbr',
        'n_action',
        'n_evidence',
        'n_responsible',
        'd_ecd',
    ];

    protected $primaryKey = 'i_id_corrective_nmbrn';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
