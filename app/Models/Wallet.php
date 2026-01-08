<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','agreement_id','masked','balance'
    ];

    protected $casts = [
        'agreement_id' => 'encrypted'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
