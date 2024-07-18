<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UdhTicketSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_id',
        'session_name',
        'session_time',
        'session_minutes',
        'start_time',
        'end_time',
        'no_of_person',
    ];

    public function ticketSlot()
    {
        return $this->belongsTo(UdhTicketSlot::class, 'slot_id');
    }

}
