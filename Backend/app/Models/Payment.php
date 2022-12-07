<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'childrens_id',
        'year',
        'proof_of_payment',
        'payment_amount',
    ];

    public function childer()
    {
        return $this->belongsTo(Childer::class, 'childrens_id', 'id');
    }

}
