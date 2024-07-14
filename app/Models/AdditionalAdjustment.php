<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalAdjustment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }
}
