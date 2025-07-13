<?php

namespace App\Models;

use App\Enums\Cashflow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'direction',
        'date'
    ];

    protected $casts = [
        'direction' =>  Cashflow::class,
    ];
}
