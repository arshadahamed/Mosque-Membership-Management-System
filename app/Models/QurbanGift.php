<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QurbanGift extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'received',
        'gift_date',
        'quantity',
        'qurban_year',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
