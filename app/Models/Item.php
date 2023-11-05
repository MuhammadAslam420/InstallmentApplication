<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table="items";

    public function stock_details()
    {
        return $this->hasMany(StockDetail::class,'batch_no');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
