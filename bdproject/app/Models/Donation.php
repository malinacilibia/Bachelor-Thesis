<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\DonationController;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'stripe_session_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
