<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table="transactions";

    public function user()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function buyer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function stock_detail()
    {

    }
}
