<div class="fixed bg-[#FEF7F3] bottom-0 left-0 right-0">
    <div class="flex justify-between pt-8 px-5 lg:px-[4rem] pb-10 ">
        @if ($currentStep == 1 || $currentStep == $totalStep )
            <div style="width:100px"></div>
        @endif
        @if ($currentStep > 1  && $currentStep < 5 )
            <button
                class="bg-white hover:bg-[#ff901a] text-[#ff901a] hover:text-white font-semibold py-2 px-6 rounded-full transition duration-300 ease-in-out"
                type="button" wire:click="previousStep">Previous</button>
        @endif
        <button
            class="bg-[#ff901a] hover:bg-[#e07000] text-white font-semibold py-2 px-6 rounded-full transition duration-300 ease-in-out flex items-center"
            type="submit" wire:click="nextStep">{{ $currentStep == 4 ? 'Proceed to Payment' : ($currentStep >= $totalStep ? 'Close' : 'Next') }}</button>
    </div>
</div>
