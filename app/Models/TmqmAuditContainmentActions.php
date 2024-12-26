<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmqmAuditContainmentActions extends Model
{
    use HasFactory;

    protected $table = 'tmqmauditcontainmentactions';

    protected $fillable = [
        'i_id_ncrnnbr',
        'n_action',
        'n_evidence',
        'n_responsible',
        'd_ecd',
    ];

    protected $primaryKey = 'i_id_containment_nmbrn';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
