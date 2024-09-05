<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'amount',
        'date',
        'description',
        'image',
        'user_id',
        'reference_number', // Add reference_number to fillable array
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

}
