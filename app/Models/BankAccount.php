<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number', 'bank_code', 'user_id'
    ];

    // relation
    public function employer(){
        return $this->belongsTo(User::class, 'bank_account', 'id');
    }
}
