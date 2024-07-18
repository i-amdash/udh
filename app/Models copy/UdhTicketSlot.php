<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UdhTicketSlot extends Model
{
    use HasFactory;


    protected $fillable = [
        'slot_name',
        'slot_interval',
        'slot_duration',
        'slot_time_text',
        'slot_start_time',
        'slot_end_time',
        'no_of_session',
        'session_duration',
        'session_interval',
        'no_of_ticket',
        'no_of_vip_ticket',
        'no_of_eco_ticket',
        'no_of_ticket_per_session',
        'is_active',
        'slug',
    ];

    public function setSlotNameAttribute($value)
    {
        $this->attributes['slot_name'] = $value;
        $this->attributes['slug'] = Str::slug($value) . '_' . time();
    }

    // public function sessions(){
    //     return $this->hasMany(UdhTicketSession::class,'slot_id');
    // }
    public function prices(){
        return $this->hasMany(UdhPrice::class,'slot_id');
    }
}
