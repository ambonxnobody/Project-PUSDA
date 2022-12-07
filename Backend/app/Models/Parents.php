<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table = 'parents';
    protected $fillable = [
        'auhtor',
        'certificate_number',
        'certificate_date',
        'item_name',
        'address',
        'large',
        'asset_value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'auhtor', 'id');
    }
    public function anak()
    {
        return $this->belongsTo(Childer::class, 'id','parent_id');
    }

    public function childers ()
    {
        return $this->hasMany(Childer::class, 'id','parent_id');
    }



    }
