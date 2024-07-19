<div>
    <x-booking-page>

        <x-slot name="header">
            @includeIf('livewire.features.booking.components.step_progress')
        </x-slot>
        <x-slot name="body">
            @php
                $selected_group = session()->get('selected_group');
                $selected_slot = session()->get('selected_slot');
                $selected_tickets = session()->get('selected_tickets');
            @endphp
            <div class="container mx-auto px-4 lg:px-[4rem]">
                <div class="flex justify-center pb-6 w-full">
                    <div class="bg-white rounded-lg shadow-md px-8 py-4 h-fit w-full">
                        <div class="flex flex-col gap-4 md:flex-row justify-between">
                            <div>
                                <p class="font-semibold">Date</p>
                                <p>{{ $date }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Time Slot</p>
                                <p>{{ $selected_slot->slot_name }}: {{ $selected_slot->slot_time_text }}</p>
                            </div>
                            <div class="pl-">
                                <p class="font-semibold ">Ticket Type</p>
                                <p>{{ $selected_group->ticket_group_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="w-full py-6">
                        <form wire:submit="submitStep2">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">
                                                Ticket
                                            </th>
                                            <th scope="col" class="px-6 py-4">
                                                Price
                                            </th>
                                            <th scope="col" class="px-6 py-4">
                                                Quantity
                                            </th>
                                            <th scope="col" class="px-6 py-4">
                                                Sub Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list_of_tickets as $key=> $ticket)
                                            <tr
                                                class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $ticket['title'] }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    ₦{{ number_format($ticket['price']) }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <button type="button"
                                                            wire:click="decrement({{ $key }})"
                                                            class="w-6 h-6 bg-gray-200 rounded-full">-</button>
                                                        <div class="mx-2">
                                                            <span>{{ $ticket['counter'] }}</span>
                                                        </div>
                                                        <button type="button" value="+"
                                                            class="w-6 h-6 bg-gray-200 rounded-full"
                                                            data-field="quantity"
                                                            wire:click="increment({{ $key }})">+</button>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    ₦{{ number_format($this->subTotal($key)) }}
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        <tr
                                            class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="flex items-center">
                                                    <label>
                                                        <input type="checkbox" class="mr-2"
                                                            wire:model.live='has_insurance' />
                                                        Add insurance fee
                                                    </label>
                                                    <svg class="w-4 h-4 ml-1 text-gray-500 cursor-pointer"
                                                        id="openModal" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                </div>
                                            </th>
                                            <td class="px-6 py-4">
                                            </td>
                                            <td class="px-6 py-4">
                                            </td>
                                            <td class="px-6 py-4">
                                                ₦ {{ number_format($this->calculatedInsuranceFee) }}
                                            </td>
                                        </tr>
                                        <tr
                                            class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Grand Total
                                            </th>
                                            <td class="px-6 py-4">

                                            </td>
                                            <td class="px-6 py-4">

                                            </td>
                                            <td class="px-6 py-4 font-bold">
                                                ₦ {{ number_format($this->grandTotal) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @includeIf('livewire.features.booking.components.step_button')
                        </form>
                    </div>
                </div>
            </div>
            <div id="myModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded shadow-lg max-w-4xl w-full">
                    <h2 class="text-xl font-bold mb-4">Insurance Fee</h2>
                    <div class="px-6 py-4 overflow-y-auto max-h-96 mb-4">

                        Protect your booking with UDH Insurance Booking Insurance is your safety net, ensuring that you
                        can reschedule your visit in case life throws unexpected twists your way. When you choose a
                        regular ticket without Booking Insurance, keep in mind that rescheduling won't be an option, and
                        you risk forfeiting the booking fee paid on that ticket. Protection Beyond Your Control: Life is
                        full of surprises, and we acknowledge that plans can change for reasons beyond your control.
                        With Booking Insurance, even if you find yourself needing to reschedule due to unforeseen
                        circumstances, you won't lose your initial booking fee. It's our way of providing a safety
                        cushion for the unexpected. Why Opt for Booking Insurance: Opting for Booking Insurance is a
                        small investment that yields significant peace of mind. It allows you the flexibility to adapt
                        your plans without the worry of financial loss, ensuring that your Upside Down House experience
                        remains enjoyable, no matter what life throws your way. How to Secure Your Upside Down
                        Adventure: To benefit from the protection of Booking Insurance, simply select this option when
                        purchasing your ticket. This ensures that you're covered in the event that rescheduling becomes
                        necessary.
                    </div>
                    <button id="closeModal" class="px-4 py-2 bg-[#0f124a] text-white rounded">Close</button>
                </div>
            </div>
            <script>
                // JavaScript to handle modal display
                document.getElementById('openModal').addEventListener('click', function() {
                    document.getElementById('myModal').classList.remove('hidden');
                });

                document.getElementById('closeModal').addEventListener('click', function() {
                    document.getElementById('myModal').classList.add('hidden');
                });

                document.getElementById('myModal').addEventListener('click', function(event) {
                    if (event.target === document.getElementById('myModal')) {
                        document.getElementById('myModal').classList.add('hidden');
                    }
                });
            </script>
        </x-slot>
    </x-booking-page>
</div>
