<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'transaction_date', 'total_amount'];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
