<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UdhBookingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'udh_booking_id',
        'ticket_category_id',
        'ticket_category_name',
        'quantity',
        'price',
        'booked_at',
        'end_at',
        'assigned_by',
    ];

    public function booking(){
        return $this->belongsTo(UdhBooking::class,'udh_booking_id');
    }

   

    public function ticketCategory()
    {
        return $this->belongsTo(UdhTicketCategory::class, 'ticket_category_id');
    }




    // public function slot_session()
    // {
    //     return $this->belongsTo(UdhTicketSession::class, 'session_id');
    // }
}
