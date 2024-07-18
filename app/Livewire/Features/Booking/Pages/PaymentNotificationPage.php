<?php

namespace App\Livewire\Features\Booking\Pages;

use App\Models\UdhBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PaymentNotificationPage extends Component

{
    public $ref;
    public $bookingData;
    public function mount(string $ref)
    {
        $this->ref = $ref;
    }
    public function render()
    {
        Session::flush();
        $retrieveBookings = $this->retrieveBooking();
        $bookings = $retrieveBookings->booking_details;
        $bookings_array = $bookings;

        return view('livewire.features.booking.pages.payment-notification-page', compact('retrieveBookings', 'bookings', 'bookings_array'));
    }

    public function retrieveBooking()
    {
            $booking = UdhBooking
             ::with(['slot','group'])->where ('booking_ref', $this->ref)->first();
            return $booking;
    }

}
