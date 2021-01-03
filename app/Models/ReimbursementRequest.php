<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_proof', 'description', 'filed_date', 'filed_time', 'reimbursement_id'
    ];

    // relation
    public function reimbursement(){
        $this->belongsTo(Reimbursement::class, 'id', 'reimbursement_id');
    }
}
