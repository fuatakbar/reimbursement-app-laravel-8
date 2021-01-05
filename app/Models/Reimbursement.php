<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'status', 'filed_date', 'user_id', 'manager_id', 'financial_admin_id', 'total', 'transfer_proof'
    ];

    // relation
    public function employer(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function manager(){
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    public function financialAdmin(){
        return $this->hasOne(User::class, 'id', 'financial_admin_id');
    }

    public function requests(){
        return $this->hasMany(ReimbursementRequest::class, 'reimbursement_id', 'id');
    }
}
