<div>
    <x-booking-page>
        <x-slot name="slot_head">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Payment <span class="text-blue-600">Summary</span></h1>
        </x-slot>
        <x-slot name="header">
            @includeIf('livewire.features.booking.components.step_progress')
        </x-slot>
        <x-slot name="body">
            <div class="container mx-auto px-4 lg:px-[4rem]">
                @php
                    $selected_group = session()->get('selected_group');
                    $selected_slot = session()->get('selected_slot');
                    $selected_tickets = session()->get('selected_tickets');
                    $grand_total = 0;
                @endphp
                <form wire:submit="submitStep4">
                    <div class="w-full flex flex-col items-between">
                        <p class="pt-8 pb-3 font-bold">Details</p>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <tbody>
                                    <tr
                                        class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 ">
                                            Date
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $date }}
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                    </tr>
                                    <tr
                                        class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 ">
                                            Ticket Type
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $selected_group->ticket_group_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                    </tr>
                                    <tr
                                        class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 ">
                                            Timeslot
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $selected_slot->slot_name }} {{ $selected_slot->slot_time_text }}
                                        </td>
                                        <td class="px-6 py-4">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="pt-8 pb-3 font-bold">Tickets</p>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">
                                            Ticket
                                        </th>
                                        <th scope="col" class="px-6 py-4">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-4">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-4">
                                            Sub Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($selected_tickets as $key=> $ticket)
                                        @php
                                            $sub_total = $ticket['price'] * $ticket['counter'];
                                        @endphp
                                        <tr
                                            class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $ticket['title'] }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $ticket['counter'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                ₦{{ number_format($ticket['price']) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                ₦{{ number_format($this->subTotal($key)) }}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    @if (session()->get('insurance'))
                                        <tr
                                            class="odd:bg-transparent odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Insurance Fee
                                            </th>
                                            <td class="px-6 py-4">
                                            </td>
                                            <td class="px-6 py-4">
                                            </td>
                                            <td class="px-6 py-4">
                                                ₦{{ number_format($this->calculatedInsuranceFee) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        $t = session()->get('insurance');
                                        $total = $t
                                            ? $this->grandTotal + $this->calculatedInsuranceFee
                                            : $this->grandTotal;
                                    @endphp
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
                                            ₦ {{ number_format($total) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex items-center py-4">
                            <input type="checkbox" class="option-input checkbox" wire:model.lazy='agreeToTerms' />
                            <label class="cursor-pointer">
                                &nbsp; Agree to the&nbsp;<span style="color: #0f124a;" id="openModal">terms
                                    and conditions</span>
                            </label>
                        </div>
                        @error('agreeToTerms')
                            <span class="error text-[#ed0707]">{{ $message }}</span>
                        @enderror
                    </div>
                    @includeIf('livewire.features.booking.components.step_button')
                </form>
            </div>

            <div id="myModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded shadow-lg max-w-4xl w-full">
                    <h2 class="text-xl font-bold mb-4">UPSIDE DOWN HOUSE TERMS & CONDITIONS</h2>
                    <div class="px-6 py-4 overflow-y-auto max-h-96 mb-4">

                        <b>GENERAL CONDITIONS</b>

                        <br>• Refund Policy: Regular tickets are non-refundable, regardless of adverse weather
                        conditions,
                        queues, or reasons beyond our control. However, if you have purchased Ticket Insurance, you may
                        request rescheduling.
                        <br>• Admission Time: You are free to arrive at any time during your designated time slot. The
                        last
                        entry to the House is 30 minutes before closing. Opening hours can be found on our website.
                        Missing your scheduled time slot will result in ticket forfeiture unless you have Ticket
                        Insurance.
                        <br>• Prohibited Actions: While in the Venue, visitors are prohibited from:
                        <br>a. Selling goods to third parties.
                        <br>b. Intentionally blocking paths or obstructing the view of rooms.
                        <br>c. Causing disturbances to other visitors, including loud phone calls or other noise
                        disturbances.
                        <br>d. Bringing pets or animals unless explicitly allowed in specific areas.
                        <br>e. Smoking.
                        <br>• Photography and Video: Visitors are encouraged to take pictures and shoot video without
                        additional lighting and tripods. Commercial shoots, press interviews, media shoots, and
                        professional video equipment require advance written approval and supervision from Venue
                        representatives or staff. The Venue reserves the right to take photos and videos for promotional
                        purposes, including potential appearances of visitors.
                        <br>• Supervision of Children: Parents or supervisors of children under the age of 13 must
                        accompany
                        them. Children cannot enter without adult supervision.
                        PRIVACY
                        <br>• Personal Information: Landmark processes your personal information, such as financial data
                        and
                        full name, provided by you for booking and related purposes. We may share your personal
                        information with third-party service providers who assist in operating our service, including
                        payment service providers and web hosting companies.
                        <br>• Data Retention: Landmark will process your information as long as necessary for our
                        processing
                        purpose and legitimate interests. Storage may also be required for technical reasons.
                        <br>• Use of Visual Material: Photos, videos, and film recordings made by visitors may not be
                        used
                        for commercial purposes without written permission from the Venue. Costs may be charged for such
                        use. By visiting the Venue, you agree to the publication and duplication of visual material,
                        even if you are recognizable, for the Venue's commercial and business activities.

                        <br>LIABILITY
                        <br>• Visitor Responsibility: Your presence in the Venue is at your own risk and expense.
                        <br>• Excluded Liability: The Venue is not liable for indirect losses or damage caused by third
                        parties, non-compliance with instructions, or other visitors. The Venue is not liable for
                        situations beyond its control, such as force majeure.
                        <br>• Limitation of Liability: In no event will the Venue's total liability exceed the greater
                        of
                        <br>(a) the Booking Fee or <br>(b) one hundred thousand Naria (N100,000).
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
