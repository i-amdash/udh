<div>

    <x-booking-page>
        <x-slot name="step_head">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Enter Your Personal <span
                        class="text-blue-600">information!</span></h1>
        </x-slot>
        <x-slot name="header">
            @includeIf('livewire.features.booking.components.step_progress')
        </x-slot>
        <x-slot name="body">
            <div class="py-8 flex flex-row justify-center mx-auto ml-16 mr-16">
                <form wire:submit="submitStep3" class="w-full md:w-1/2 mx-auto flex flex-col justify-center items-center">
                    <div class="w-full md:w-1/2 mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">First name <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model.lazy="firstname"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                        @error('firstname')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="w-full md:w-1/2 mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Last name <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model.lazy="lastname"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                        @error('lastname')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="w-full md:w-1/2 mb-4">
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model.lazy="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="w-full md:w-1/2">
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
