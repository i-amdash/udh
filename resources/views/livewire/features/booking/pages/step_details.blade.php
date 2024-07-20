<div>

    <x-booking-page>
        
        <x-slot name="header">
            @includeIf('livewire.features.booking.components.step_progress')
        </x-slot>
        <x-slot name="body">
            <div class="max-w-xl mx-auto rounded-lg py-10 px-5">
                <form wire:submit="submitStep3" class="">
                    <div class="relative mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">First name <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model.lazy="firstname"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                        @error('firstname')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="relative mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Last name <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model.lazy="lastname"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                        @error('lastname')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="relative mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model.lazy="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="relative">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Phone <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model.lazy="phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>

                    @includeIf('livewire.features.booking.components.step_button')
                </form>
            </div>
        </x-slot>
    </x-booking-page>

</div>
