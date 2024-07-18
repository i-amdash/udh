<div class="fixed shadow-2xl shadow-black bottom-0 left-0 right-0">
    <div class="flex justify-between pt-8 px-5 lg:px-[4rem] pb-10 ">
        @if ($currentStep == 1)
            <div style="width:100px"></div>
        @endif
        @if ($currentStep > 1)
            <button
                class="bg-white hover:bg-[#252D60] text-[#252D60] hover:text-white font-semibold py-2 px-6 rounded-full transition duration-300 ease-in-out"
                type="button" wire:click="previousStep">Previous</button>
        @endif
        <button
            class="bg-[#252D60] hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full transition duration-300 ease-in-out flex items-center"
            type="submit" wire:click="nextStep">{{ $currentStep >= $totalStep ? 'Proceed to Payment' : 'Next' }}</button>
    </div>
</div>
