<?php

namespace App\Services\Udh;

use App\Models\UdhPrice;
use App\Models\UdhTicketSlot;
use App\Services\BaseService;
use App\Traits\DiscountTrait;
use App\Traits\UdhBookingTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UdhAvailabilityService extends BaseService
{
    use UdhBookingTrait;
    public function checkSlotAvailability($arr)
    {
        $group_id = $arr['group_id'];
        // $category_id = $arr['category_id'];
        $slot_id = $arr['slot_id'];
        $date = Carbon::parse($arr['date']);
        $today = Carbon::today();
        $isToday =  $date->isSameDay($today);

        if($today > $date){
            return $this->fail("You can booked for passed date");
        }


        // $hour = $today->hour;
        // Add one to the day to tally with DB id and server day naming
        $day = $date->dayOfWeek+1;



        $ticket_catogories = [];
        $booked_slot = [];
        $available_number=0;




        // $prices = DB::table('udh_prices')->selectRaw(
        //     'udh_prices.day_id,udh_prices.ticket_group_id,udh_prices.ticket_category_id,udh_prices.slot_id,udh_prices.app_price,
        //     udh_prices.web_price,udh_prices.count,
        //     udh_ticket_sessions.id as session_id,udh_ticket_sessions.session_time,udh_ticket_sessions.start_time,udh_ticket_sessions.end_time,udh_ticket_sessions.no_of_person
        //     ')
        // ->join('udh_ticket_slots','udh_prices.slot_id','=','udh_ticket_slots.id')
        // ->join('udh_ticket_sessions','udh_prices.slot_id','=','udh_ticket_sessions.slot_id')
        //     ->where('udh_prices.ticket_group_id', $group_id)
        //     ->where('udh_prices.ticket_category_id', $category_id)
        //     ->where('udh_prices.day_id', $day)
        //     ->where('udh_prices.slot_id', $slot_id)
        // ->get();
        $udh_prices = DB::table('udh_prices')
        ->join('udh_ticket_slots','udh_prices.slot_id','=','udh_ticket_slots.id')
        ->where('udh_prices.day_id', $day)->where('udh_prices.slot_id', $slot_id)->first();




        // $slot = DB::table('slots')->where('id', $slot_id)->first();

        //     ->where('udh_prices.slot_id', $slot_id)

        $category =  DB::table('udh_ticket_categories')->get();

        foreach($category as $cat){
            $ticket_price = DB::table('udh_ticket_prices')->where(['ticket_group_id'=>$group_id,'ticket_category_id'=>$cat->id])->first();

            $a_price=0;
            $w_price =0;
            if($ticket_price->is_fixed_price==1){
                $a_price = $ticket_price->fixed_price;
                $w_price = $ticket_price->fixed_price;
            }else{
                $app_p = 0;
                $web_p = 0;
                $ac = $udh_prices->app_price * $cat->no_of_person;
                $wc = $udh_prices->web_price * $cat->no_of_person;

                $app_p = $this->calculateUDHVIPPrice($ac, $ticket_price->price_percentage);
                $web_p = $this->calculateUDHVIPPrice($wc, $ticket_price->price_percentage);

                // if($cat->is_group==1){
                //     $app_p = $udh_prices->app_price * $cat->no_of_person;
                //     $web_p = $udh_prices->web_price * $cat->no_of_person;


                // }else{
                //     $ac = $udh_prices->app_price * $cat->no_of_person;
                //     $wc = $udh_prices->web_price * $cat->no_of_person;

                //     $app_p = $this->calculateUDHVIPPrice($ac, $ticket_price->price_percentage) ;
                //     $web_p = $this->calculateUDHVIPPrice($wc, $ticket_price->price_percentage);
                // }
                $a_price = $this->calculateDiscountedPrice($app_p, $cat->discount);
                $w_price = $this->calculateDiscountedPrice($web_p, $cat->discount);

            }

             $cat->app_price = $a_price;
            $cat->web_price = $w_price;

            $ticket_catogories[] = $cat;

        }
        // $booked_quantity = $this->countBookedSlots($group_id, $slot_id,  $date);
        // $regular_number = $udh_prices->no_of_ticket - $udh_prices->no_of_vip_ticket - $udh_prices->no_of_eco_ticket;
        // if($group_id ==1){
        //     $available_number = $regular_number - $booked_quantity;
        // }elseif($group_id == 2){
        //     $available_number = $this->getAvailableNumber($slot_id,$group_id,$date);
        // }
        $available_number = $this->getAvailableNumber($slot_id, $group_id, $date);
            $data = ['available_number'=>$available_number,'tickets'=>$ticket_catogories];

    // foreach ($prices as $price) {


    //         $booked_quantity = $this->countBookedSlots($group_id,$category_id, $price->slot_id,$price->session_id,$date);
    //             if($booked_quantity < $price->no_of_person){
    //                 $available = $price->no_of_person - $booked_quantity;
    //                 $price->available = $available;

    //                     $available_slots[] = $price;
    //             }

    //         }

        return $this->success('available tickets', $data);
        // return true;
    }
    public function checkSlotAvailabilityForWeb($arr)
    {
        // $group_id = $arr['group_id'];
        // $category_id = $arr['category_id'];
        $slot_id = $arr['slot_id'];
        $date = Carbon::parse($arr['date']);
        $today = Carbon::today();
        $isToday = $date->isSameDay($today);

        if ($today > $date) {
            return $this->fail("You can booked for passed date");
        }


        // $hour = $today->hour;
        // Add one to the day to tally with DB id and server day naming
        $day = $date->dayOfWeek + 1;




        $booked_slot = [];





        // $prices = DB::table('udh_prices')->selectRaw(
        //     'udh_prices.day_id,udh_prices.ticket_group_id,udh_prices.ticket_category_id,udh_prices.slot_id,udh_prices.app_price,
        //     udh_prices.web_price,udh_prices.count,
        //     udh_ticket_sessions.id as session_id,udh_ticket_sessions.session_time,udh_ticket_sessions.start_time,udh_ticket_sessions.end_time,udh_ticket_sessions.no_of_person
        //     ')
        // ->join('udh_ticket_slots','udh_prices.slot_id','=','udh_ticket_slots.id')
        // ->join('udh_ticket_sessions','udh_prices.slot_id','=','udh_ticket_sessions.slot_id')
        //     ->where('udh_prices.ticket_group_id', $group_id)
        //     ->where('udh_prices.ticket_category_id', $category_id)
        //     ->where('udh_prices.day_id', $day)
        //     ->where('udh_prices.slot_id', $slot_id)
        // ->get();
        $udh_prices = DB::table('udh_prices')
            ->join('udh_ticket_slots', 'udh_prices.slot_id', '=', 'udh_ticket_slots.id')
            ->where('udh_prices.day_id', $day)->where('udh_prices.slot_id', $slot_id)->first();




        // $slot = DB::table('slots')->where('id', $slot_id)->first();

        //     ->where('udh_prices.slot_id', $slot_id)

        $category = DB::table('udh_ticket_categories')->where('is_active', 1)->get();
        $groups = DB::table('udh_ticket_groups')->where('is_active',1)->get();

        $group_ticket_categories =  [];
        foreach ($groups as $group) {
            $group_id = $group->id;
            $ticket_catogories = [];
            $available_number = 0;

            foreach ($category as $cat) {
                // $ticket_price = DB::table('udh_ticket_prices')
                // ->join('udh_ticket_groups','udh_ticket_prices.ticket_group_id','=','udh_ticket_groups.id')

                // ->where(['ticket_category_id' => $cat->id])->first();
                $ticket_price = DB::table('udh_ticket_prices')->where(['ticket_group_id' => $group_id, 'ticket_category_id' => $cat->id])->first();



                $a_price = 0;
                $w_price = 0;
                if ($ticket_price->is_fixed_price == 1) {
                    $a_price = $ticket_price->fixed_price;
                    $w_price = $ticket_price->fixed_price;
                } else {
                    $app_p = 0;
                    $web_p = 0;
                    $ac = $udh_prices->app_price * $cat->no_of_person;
                    $wc = $udh_prices->web_price * $cat->no_of_person;

                    $app_p = $this->calculateUDHVIPPrice($ac, $ticket_price->price_percentage);
                    $web_p = $this->calculateUDHVIPPrice($wc, $ticket_price->price_percentage);

                    // if($cat->is_group==1){
                    //     $app_p = $udh_prices->app_price * $cat->no_of_person;
                    //     $web_p = $udh_prices->web_price * $cat->no_of_person;


                    // }else{
                    //     $ac = $udh_prices->app_price * $cat->no_of_person;
                    //     $wc = $udh_prices->web_price * $cat->no_of_person;

                    //     $app_p = $this->calculateUDHVIPPrice($ac, $ticket_price->price_percentage) ;
                    //     $web_p = $this->calculateUDHVIPPrice($wc, $ticket_price->price_percentage);
                    // }
                    $a_price = $this->calculateDiscountedPrice($app_p, $cat->discount);
                    $w_price = $this->calculateDiscountedPrice($web_p, $cat->discount);

                }

                $cat->app_price = $a_price;
                $cat->web_price = $w_price;

                $ticket_catogories[] = $cat;

            }
            $available_number = $this->getAvailableNumber($slot_id, $group_id, $date);
            $group_ticket_categories[]=['group_id'=>$group_id,'group_name'=>$group->ticket_group_name,'available_number'=>$available_number,

        'tickets'=>$ticket_catogories];

        }



        return $this->success('available tickets', $group_ticket_categories);
        // return true;
    }
}
