<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendingTransaction extends Model
{
   use SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'cart',
        'total_amount',
    ];

    protected $casts = [
        'cart' => 'array', // auto-decode JSON
    ];
}
