<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function creditAndLtvs()
    {
        return $this->hasMany(CreditAndLtv::class);
    }

    public function ficoAdjustments()
    {
        return $this->hasMany(FicoAdjustment::class);
    }

    public function loanAmountAdjustments()
    {
        return $this->hasMany(LoanAmountAdjustment::class);
    }
}
