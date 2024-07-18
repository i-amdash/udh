<div>
    {{-- In work, do what you enjoy. --}}


     <x-booking-page>
         <x-slot name="header">
        {{-- @includeIf('livewire.features.booking.components.step_progress') --}}
     </x-slot>
    <x-slot name="body">
         <h2 style="text-align: center;">Congratulations!</h2>
        <h4> Your Booking has been received successfuly,check your inputed email for details</h4>



        <div class="form-group mt-5">
            <h3>4. Booking Summary</h3>
              {{-- @php
                $selected_group = session()->get('selected_group');
                $selected_slot = session()->get('selected_slot');
                $selected_tickets = session()->get('selected_tickets');
                $grand_total = 0;
                    //   $selected_group = array_values(array_filter($groups,function($item) use ($form){
                    //     return $item->id == $form['group_id'];
                    // }));
                    //   $selected_slot = array_values(array_filter($slots,function($item) use ($form){
                    //     return $item->id == $form['slot_id'];
                    // }));

                @endphp --}}
    {{-- {{ dd($selected_group) }} --}}
            <form wire:submit="submitStep4">
                <div class="table-responsive">
                    <table class="table">
                                     <tbody>
                                        <tr>
                                            <td>Booking Ref</td>
                                            <td><b>{{ $retrieveBookings->booking_ref}}</b></td>
                                        </tr>
                                         <tr>
                                            <td>Slot Type</td>
                                            <td><b>{{ $retrieveBookings->slot->slot_name}}({{ $retrieveBookings->slot->slot_time_text}})</b></td>
                                        </tr> 
                                        <tr>
                                            <td>Grand Total</td>
                                            <td><b>{{ $retrieveBookings->grand_total}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Booking Date</td>
                                            <td><b>{{ $retrieveBookings->booking_date}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Ticket Type</td>
                                            <td><b>{{ $retrieveBookings->group->ticket_group_name}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td><b>{{ $retrieveBookings->payment_method}}</b></td>
                                        </tr>
                                    </tbody> 
                    </table>
                    <table class="table table-striped">
                         <thead>
                            <td>Ticket ID</td>
                            <td>Title</td>
                            <td>Counter</td>
                            <td>Price</td>
                            <td>No of People</td>
                        </thead> 
                        <tbody>
                            @forelse ($bookings_array as $key=> $ticket )
                          
                          <tr>
                          <td>{{$ticket->id}}</td>
                           <td>{{$ticket->title}}</td>
                           <td>{{$ticket->counter}}</td>
                           <td>{{$ticket->price}}</td>
                           <td>{{$ticket->no_of_people}}</td>
                          </tr>
                          

                            @empty

                            @endforelse
                        </tbody>
                        
                    </table>
                </div>

            </form>

            
        <a href="{{ route('home') }}" class="btn btn-primary"> Close </a>

         </div>
    </x-slot>
     </x-booking-page>
</div>
