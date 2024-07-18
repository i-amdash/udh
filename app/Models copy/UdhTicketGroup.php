<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UdhTicketGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_group_name',
        'image',
        'is_active',
        'slug',
    ];

    public function setTicketGroupNameAttribute($value)
    {
        $this->attributes['ticket_group_name'] = $value;
        $this->attributes['slug'] = Str::slug($value) . time();

    }
}
