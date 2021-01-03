<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    // relation
    public function user(){
        return $this->belongsTo(User::class, 'division', 'id');
    }
}
