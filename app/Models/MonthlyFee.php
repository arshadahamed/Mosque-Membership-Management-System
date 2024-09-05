<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyFee extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'amount',
        'paid_date',
        'paid',
        'reference'

    ];

    protected static function booted()
    {
        static::creating(function ($monthlyFee) {
            // Fetch the member associated with this monthly fee
            $member = Member::find($monthlyFee->member_id);

            if ($member) {
                // Deduct the monthly fee amount from the member's account balance
                $member->Account_Balance -= $monthlyFee->amount;
                $member->save();
            }
        });
    }


    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
