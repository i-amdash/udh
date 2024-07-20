<div>
    <!-- Step 1: Date and Age Picker -->
    <x-booking-page>

        <x-slot name="header">

        </x-slot>
        <x-slot name="body">
            @if ($isLoading)
                loading....
            @else
                <div class=" px-4 py-4 md:px-[8rem] md:py-[3rem]">
                @php
                    $selected_group = session()->get('selected_group');
                    $selected_slot = session()->get('selected_slot');
                    $selected_tickets = session()->get('selected_tickets');
                    $grand_total = 0;
                @endphp
                    <form action="">
                        <h1 class="font-[400] font-sans text-black text-3xl md:text-5xl py-8">
                            Payment Successful! 🎉
                        </h1>
                            <div class="md:w-2/3 py-8">
                                <p class="font-[400] text-lg font-sans text-black"> <span class="font-[600]">Thanks for
                                        booking with the Upside
                                        down
                                        house!
                                    </span> Your order summary and voucher will be sent to jod***********@yourmail.com
                                </p>
                            </div>
                            <div class="ticket max-w-full flex flex-col lg:flex-row justify-between">
                                    <div>
                                        <h2 class="text-2xl font-bold text-center text-white mb-4">🎉 Upsidedown House 🎉</h2>
                                        <div class="py-2 hidden md:grid md:grid-cols-3 md:gap-x-12 gap-2 ">
                                            <p class="text-lg text-black">Date</p>
                                            <p class="text-lg text-black">Ticket type</p>
                                            <p class="text-lg text-black">Booking Ref</p>
                                            <p class="text-white font-semibold text-lg">{{ $date }}</p>
                                            <p class="text-white font-semibold text-lg">{{ $selected_group->ticket_group_name }}</p>
                                            <p class="text-white font-semibold text-lg">UDH-EE319SSY3</p>
                                            <p class="text-lg text-black">Time slot</p>
                                            <p class="text-lg text-black">Amount</p>
                                            <p class="text-lg text-black">Discount</p>
                                            <div class="flex flex-col">
                                            <p class="text-white font-semibold text-lg">{{ $selected_slot->slot_name }}</p>    
                                            <p class="text-lg text-black">{{ $selected_slot->slot_time_text }}</p>
                                            </div>
                                            <p class="text-white font-semibold text-lg">₦ {{ number_format(10000) }}</p>
                                            <p class="text-white font-semibold text-lg">-</p>

                                        </div>
                                        <div class="py-2 grid md:hidden grid-cols-2 gap-2 mb-4">
                                            <p class="text-lg text-black">Date</p>
                                            <p class="text-lg text-black">Ticket type</p>
                                            <p class="text-white font-semibold text-lg mb-4">{{ $date }}</p>
                                            <p class="text-white font-semibold text-lg mb-4">{{ $selected_group->ticket_group_name }}</p>
                                            <p class="text-lg text-black">Booking Ref</p>
                                            <p class="text-lg text-black">Time slot</p>
                                            <p class="text-white font-semibold text-lg mb-4">UDH-EE319SSY3</p>
                                            <div class="flex flex-col mb-4 ">
                                            <p class="text-white font-semibold text-lg">{{ $selected_slot->slot_name }}</p>    
                                            <p class="text-lg">{{ $selected_slot->slot_time_text }}</p>
                                            </div>
                                            <p class="text-lg text-black">Amount</p>
                                            <p class="text-lg text-black">Discount</p>
                                            <p class="text-white font-semibold text-lg">₦ {{ number_format(10000) }}</p>
                                            <p class="text-white font-semibold text-lg">-</p>

                                        </div>
                                    </div>
                                    <div class="border-dashed border-white lg:border-l border-t lg:border-t-transparent lg:pr-4 flex flex-col-reverse justify-center items-between lg:flex-row ">
                                        <div class="flex flex-col justify-between pt-8 lg:pt-0 lg:pl-24 lg:pr-12 py-4">
                                            <h2 class=" text-lg text-white font-semibold pb-4 md:pb-0">This ticket covers: </h2>
                                            <div class="grid grid-cols-2 gap-x-12 pb-4 lg:pb-0">
                                                <p class="text-lg text-white font-semibold">Adult </p>
                                                <p class="text-lg text-white font-semibold">x 1 </p>
                                                <p class="text-lg text-white font-semibold">Children </p>
                                                <p class="text-lg text-white font-semibold">x 1 </p>
                                                <p class="text-lg text-white font-semibold">Toddler</p>
                                                <p class="text-lg text-white font-semibold">x 1 </p>
                                                
                                            </div>
                                            <button type="button" class="text-primary hover:text-white bg-white hover:bg-primary/20 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Share Ticket </button>
                                        </div>
                                        <div class="pt-12 lg:pt-0 rounded-lg">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example" alt="QR Code" class="rounded-lg mx-auto">
                                        </div>
                                    </div>
                        </div>
                        @includeIf('livewire.features.booking.components.step_button')
                    </form>
                </div>
            @endif
        </x-slot>
    </x-booking-page>
</div>
