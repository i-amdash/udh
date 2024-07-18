<?php

namespace App\Services\Udh;

use App\Models\UdhBooking;
use App\Models\UdhBookingItem;
use App\Models\User;
use App\Notifications\UdhTicketNotification;
use App\Services\BaseService;
use App\Services\Transaction\TransactionService;
use App\Traits\BeachBookingTraits;
use App\Traits\UdhBookingTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UdhBookingService extends BaseService
{
    use UdhBookingTrait;

    public $transaction ;

    public function __construct(){}

    public function saveBooking($arr)
    {
          $group_id = $arr['group_id'];
        // $category_id = $arr['category_id'];
        $slot_id = $arr['slot_id'];
        $date = Carbon::parse($arr['date']);
        $payment_method = $arr['payment_method'];
        $has_insurance = (int)$arr['has_insurance'];
        $insurance_fee = getAppSetting('udh_insurance_fee');
        $items = $arr['items'];
        $slot_name = $arr['slot_name'];
        // dd($slot_name);


        $sum =0;

        if(empty($items) || !is_array($items)){
            return $this->fail('Number of people cannot be empty');
        }

        $userData = [ 'firstname'=>$arr['firstname'],
            'lastname'=>$arr['lastname'],
            'payment_method'=>'web',
            'phone'=>$arr['phone'],
            'email'=>$arr['email']];
        $user = User::updateOrCreate(['email' => $arr['email']], $userData);
        $user_id = $user->id;

        // $sum = array_sum(array_column($items, 'counter'));

        //sum the number of people and check if it is available for the selected sesion
        // if not return slot nooked

        $available_number = $this->getAvailableNumber($slot_id, $group_id, $date);

        // dd($available_number);


        // $session = DB::table('udh_ticket_sessions')->where('id',$session_id)->first();

        // if($session){
        //     $available = $session->no_of_person - $booked_quantity;

        //     if($sum > $available) {
        //         $msg = "Only ".$available . " slots is open for this session, select another session or reduce your number";
        //         return $this->fail($msg);
        //     }
        $booking_ref =  "UDH-" . generateBookingReferenceCode($user_id);
        $totalItem =  $this->getbookingItemTotal($items,$group_id) ;
        $insurance_fee = getAppSetting("insurance_fee");




        $sum = $totalItem[2];


            if($sum > $available_number) {
                $msg = "Only ". $available_number . " slot is open for this session, select another slot or reduce your number";
                return $this->fail($msg);
            }
        $total_insurance_fee = $insurance_fee * $sum;
        $grand_total = $totalItem[0];
        if($has_insurance==1){
            $grand_total+=$total_insurance_fee;
        }


        try {
            DB::beginTransaction();
            $booked = UdhBooking::create([
                'booking_ref' => $booking_ref,
                'user_id' => $user_id,
                'group_id' => $group_id,
                'slot_id' => $slot_id,
                'booking_date' => $date,
                'grand_total' => $grand_total,
                'item_count' => $totalItem[1],
                'discount' => '',
                'booking_details' => $items,
                'insurance_fee'=> ($has_insurance==1)?  $total_insurance_fee:0,
                'has_insurance'=>$has_insurance,
                'payment_method'=>$payment_method,
                'slot_name'=>$slot_name,

            ]);


            //loop to save to booking item table

            foreach ($items as $item) {
                $n = DB::table('udh_ticket_categories')->where('id',$item['id'])->first();
                $booked_details = UdhBookingItem::create(
                    [
                        'udh_booking_id' => $booked->id,
                        'ticket_category_id' => $item['id'],
                        'ticket_category_name' => $item['title'],
                        'quantity' => ($n->is_group==1)?$n->counter_step:$item['counter'],
                        'price' => $item['price'],
                        'booked_at' => Carbon::now()
                    ]
                );
            }
            DB::commit();
            return $this->success('sucess',$booked);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->fail('error saving boooking','Udh booking',$e);
        }
    }


}
