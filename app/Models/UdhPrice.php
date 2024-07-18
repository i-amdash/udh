<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UdhPrice extends Model
{
    use HasFactory;


    // Define the fillable fields
    protected $fillable = [
        'day_id',
        'ticket_group_id',
        'ticket_category_id',
        'ticket_sub_category_id',
        'slot_id',
        'app_price',
        'web_price',
        'count',
    ];

    // Define the relationships
    public function day()
    {
        return $this->belongsTo(UdhDay::class, 'day_id');
    }

    // public function ticketGroup()
    // {
    //     return $this->belongsTo(UdhTicketGroup::class, 'ticket_group_id');
    // }

    // public function ticketCategory()
    // {
    //     return $this->belongsTo(UdhTicketCategory::class, 'ticket_category_id');
    // }



    public function slot()
    {
        return $this->belongsTo(UdhTicketSlot::class, 'slot_id')->withDefault();
    }
}
