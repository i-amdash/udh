<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;


trait UdhBookingTrait{


    public function countBookedSlots ($group_id,$slot_id,$date){
        $booked_quantity = DB::table('udh_booking_items')
    ->join('udh_bookings', 'udh_booking_items.udh_booking_id', '=', 'udh_bookings.id')
    ->where('udh_bookings.group_id', $group_id)
    // ->where('udh_booking_items.ticket_category_id', $category_id)
    ->where('udh_bookings.is_paid', 1)
    ->where('udh_bookings.is_processed', 0)
    ->where('udh_bookings.slot_id', $slot_id)
    ->whereDate('udh_bookings.booking_date', $date)->sum('udh_booking_items.quantity');
        return $booked_quantity;

    }

    public function getAvailableNumber($slot_id,$group_id,$date){
        $available_number=0;
        $udh_prices = DB::table('udh_ticket_slots')->where('id', $slot_id)->first();

        $booked_quantity = $this->countBookedSlots($group_id, $slot_id, $date);


        $regular_number = $udh_prices->no_of_ticket - $udh_prices->no_of_vip_ticket - $udh_prices->no_of_eco_ticket;
        $vip_number =  $udh_prices->no_of_vip_ticket;
        if ($group_id == 1 ) {
            $available_number = $regular_number - $booked_quantity;
        } elseif ($group_id == 2 ) {
            $available_number = $vip_number - $booked_quantity;
        }
        return $available_number;
    }

    public function getbookingItemTotal($items, $type)
    {

        $total = 0;
        $count = 0;
        $people_counter=0;

        foreach ($items as $item) {
            // $multiply = $item['id'] == 'Individual' || 'Activity' ? $item['counter'] : 1;
            // $multiply = $type !=  $item['counter'];
            $price = $item['price'] * $item['counter'];
            $total += $price;
            $count++;
            $people_counter+=($item['no_of_people']*$item['counter']);
        }

        // foreach ($items as $item) {
        //     $multiply = $type != 'Individual' ? 1 : $item['counter'];
        //     $price = $item['price'] * $multiply;
        //     $total += $price;
        //     $count++;
        // }

        return [$total, $count, $people_counter];
    }
    public function calculateDiscountedPrice($amount, $percentage)
    {
        $d = $amount * ($percentage / 100);
        return $amount - $d;
    }
    public function calculateUDHVIPPrice($amount, $percentage)
    {
        $d = $amount * ($percentage / 100);
        return $amount + $d;
    }
}
