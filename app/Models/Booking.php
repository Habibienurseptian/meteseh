<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

     protected $fillable = [
        'booking_code',
        'region',
        'group_name',
        'group_address',
        'leader_name',
        'number_of_pilgrims',
        'arrival_time',
        'status',
        'pickup_status',
        'vehicle_type',      
        'number_of_vehicles',
        'contact_number',    
        'departure_time',
        'maktab_id',
        'notes',
    ];

    protected $dates = [
        'arrival_time',
        'departure_time',
        'created_at',
        'updated_at',
    ];

    public function maktab()
    {
        return $this->belongsTo(Maktab::class);
    }
}