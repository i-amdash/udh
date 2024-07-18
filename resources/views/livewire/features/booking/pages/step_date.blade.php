<div>
    <!-- Step 1: Date and Age Picker -->
    <x-booking-page>
        <x-slot name="step_head">
            <h1 class="text-3xl md:text-4xl font-bold">Visit the first upside down house in <span
                    class="text-blue-600">West Africa!</span></h1>
        </x-slot>
        <x-slot name="header">
            @includeIf('livewire.features.booking.components.step_progress')
        </x-slot>
        <x-slot name="body">
            @if ($isLoading)
                loading....
            @else
                <div class="max-w-xl mx-auto rounded-lg py-10 px-5">
                    <form wire:submit.prevent="submitStep1">
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                                Select Date <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" id="date" wire:model.lazy="date"
                                    min="{{ now()->format('Y-m-d') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                            </div>
                            @error('date')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700 mb-1">
                                Time Slot <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="time" wire:model.lazy="slot_id" name="time" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none">
                                    <option value="">Select a time slot</option>
                                    @forelse ($slots as $slot)
                                        <option value="{{ $slot->id }}"> {{ $slot->slot_name }} (
                                            {{ $slot->slot_time_text }} ) </option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            @error('slot_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="ticket" class="block text-sm font-medium text-gray-700 mb-1">
                                Ticket Type <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="ticket" name="ticket" wire:model.lazy="group_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none">
                                    <option value="">Select a ticket type</option>
                                    @forelse ($groups as $group)
                                        <option value="{{ $group->id }}"> {{ $group->ticket_group_name }} </option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            @error('group_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @includeIf('livewire.features.booking.components.step_button')
                    </form>
                </div>

            @endif
        </x-slot>
    </x-booking-page>
</div>
@push('script')
    <script>
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            startDate: new Date(),
            // datesDisabled:["06-11-2023"]
        });
    </script>
@endpush
