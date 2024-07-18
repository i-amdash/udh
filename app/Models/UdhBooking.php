<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UdhBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_ref',
        'user_id',
        'group_id',
        'slot_id',
        'grand_total',
        'item_count',
        'booking_date',
        'discount_amount',
        'is_discounted',
        'has_furniture',
        'is_paid',
        'payment_ref',
        'payment_method',
        'assigned_at',
        'is_processed',
        'booking_details',
        'is_resheduled',
        'has_insurance',
        'insurance_fee',
        'resheduled_on',
        'processed_by',
        'previous_booking_date',
        'resheduled_by',
        'discount',
    ];

    public function setBookingDetailsAttribute($v)
    {
        $this->attributes['booking_details'] = json_encode($v);
    }
    public function getBookingDetailsAttribute()
    {
        return json_decode($this->attributes['booking_details']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function group()
    {
        return $this->belongsTo(UdhTicketGroup::class, 'group_id');
    }
    public function slot()
    {
        return $this->belongsTo(UdhTicketSlot::class, 'slot_id');
    }
    public function udhBookingItems()
    {
        return $this->hasMany(UdhBookingItem::class, 'udh_booking_id');
    }
}
