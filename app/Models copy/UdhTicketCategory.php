<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UdhTicketCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'image',
        'counter_step',
        'show_counter',
        'is_fixed_price',
        'price',
        'is_active',
        'slug',
    ];

    public function setCategoryNameAttribute($value)
    {
        $this->attributes['category_name'] = $value;
        $this->attributes['slug'] = Str::slug($value) . time();
    }

    public function prices(){
        return $this->hasMany(UdhPrice::class,'category_id');
    }
}
