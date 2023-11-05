<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table="packages";
    public function user()
    {
        return $this->hasOne(User::class,'package_id');
    }


}
