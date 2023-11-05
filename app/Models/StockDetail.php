<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    use HasFactory;
    protected $table="stock_details";

    public function item()
    {
        return $this->hasOne(Item::class,'batch_no');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function buyer()
    {
        return $this->belongsTo(User::class,'assign_id');
    }
}
