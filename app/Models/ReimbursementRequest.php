<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementRequest extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'expense_proof', 'description', 'filed_date', 'filed_time', 'reimbursement_id', 'amount_spent'
    ];

    // relation
    public function reimbursement(){
        $this->belongsTo(Reimbursement::class, 'id', 'reimbursement_id');
    }
}
