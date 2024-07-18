<?php

namespace App\Traits;

use App\Models\BeachItemTag;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;


trait EmailNotificationTrait
{


    public function sendBeachTicketMail($data){

        $detail = $data['booked'];
        $booking_date =   Carbon::parse($detail->booking_date)->format('d-M,Y');

        $table = "<center><table width='100%' cellpadding='0' cellspacing='0'>  <tbody>";
        $table .= " <tr> <td style='padding:10px;border:1px solid black;'>Booking Date</td> <td style='padding:10px;border:1px solid black;'> " .  $booking_date .  "</td> </tr> ";
        $table .= " <tr> <td style='padding:10px;border:1px solid black;'>Booking Ref</td> <td style='padding:10px;border:1px solid black;'> " . $detail->booking_ref .  "</td> </tr> ";
        $table .= " <tr> <td style='padding:10px;border:1px solid black;'>Booking Type</td> <td style='padding:10px;border:1px solid black;'> " . $detail->booking_type .  "</td> </tr> ";
        $table .= " <tr> <td style='padding:10px;border:1px solid black;'>Total Amount</td> <td style='padding:10px;border:1px solid black;'> N" . number_format($detail->grand_total) .  "</td> </tr> ";
        if ($detail->booking_details != NULL) {
            foreach ($detail->booking_details as $t) {
                $table .= " <tr> <td style='padding:10px;border:1px solid black;'>" . $t->title . "</td> <td style='padding:10px;border:1px solid black;'> " . $t->counter .  "</td> </tr> ";
            }
        }
        $table .= "  </tbody>   </table></center>";

        return (new MailMessage)
            ->line('Booking Confirmation')
            ->line(new HtmlString("<br>"))
            ->line("Your payment was successful and has been received by Landmark Leisure Beach. Please see the booking details below. Kindly present your booking ID/Reference upon arrival at the ticket office, An attendant will verify the details and grant you access.")
            ->line(new HtmlString("<br>"))

            // ->line(new HtmlString($img))
            ->line(new HtmlString($table))
            //    ->line(new HtmlString("<br>"))
            //    ->line(new HtmlString($img))

            ->line(new HtmlString("<br>"))

            ->line('Have a great time at Landmark Beach')->from(env('MAIL_USERNAME'))->subject("Beach Ticket Details");
    }
}
