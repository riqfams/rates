<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicoAdjustment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }
}