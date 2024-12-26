<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmqmAuditNonconformityReports extends Model
{
    use HasFactory;

    protected $table = 'tmqmauditnonconformityreports';

    protected $fillable = [
        'i_id_ncrnnbr',
        'i_id_audchknbr',
        'n_quality_element',
        'n_classification',
        'n_key_requirement',
        'n_reference',
        'n_responsible_mngr',
        'n_objective_evidence',
        'n_attachment',
        'n_root_cause',
        'n_impact',
        'n_details',
        'i_emp',
        'd_entry',
    ];

    protected $primaryKey = 'i_id_ncrnnbr';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
