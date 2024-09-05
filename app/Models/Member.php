<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name_of_Family_Head',
        'NIC_Number',
        'Address',
        'Membership_fee',
        'Land_Mobile_Number',
        'WhatsApp_Number',
        'Workplace_Address',
        'Workplace_Mobile_Number',
        'Number_of_Family_Members_Male',
        'Number_of_Family_Members_Female',
        'Is_Low_Income',
        'Account_Balance',
        'Registered_Date',
        'Status'
    ];

    public function families()
    {
        return $this->hasMany(Family::class, 'member_id');
    }



    public function monthlyFees()
    {
        return $this->hasMany(MonthlyFee::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('Status', 'active');
    }



}
