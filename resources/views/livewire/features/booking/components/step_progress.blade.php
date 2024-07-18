<div class="container mx-auto px-4 py-8">
    @if ($currentStep == 1)
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold">Visit the first upside down house in <span
                    class="text-blue-600">West
                    Africa!</span></h1>
        </div>
    @elseif ($currentStep == 2)
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Choose Your <span class="text-blue-600">Ticket!</span>
            </h1>
        </div>
    @elseif ($currentStep == 3)
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Enter Your Personal <span
                    class="text-blue-600">information!</span></h1>
        </div>
    @else
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Payment <span class="text-blue-600">Summary</span></h1>
        </div>
    @endif
    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
        <div
            class="@if ($currentStep == 1) flex-1 bg-yellow-400 p-4 rounded-lg flex-grow
         @elseif($currentStep > 1) flex-1 bg-indigo-900 p-4 rounded-lg transform rotate-180 @endif">
            <span
                class="@if ($currentStep == 1) font-semibold
             @elseif($currentStep > 1) text-white font-semibold transform -rotate-180 @endif">
                1. Booking Date
            </span>
        </div>
        <div
            class="@if ($currentStep == 2) bg-yellow-400 p-4 rounded-lg flex-grow
         @elseif($currentStep > 2) flex-1 bg-indigo-900 p-4 rounded-lg transform rotate-180 @else bg-yellow-100 p-4 rounded-lg flex-grow transform rotate-180 @endif">
            <span
                class="@if ($currentStep == 2) font-semibold
             @elseif($currentStep > 2) text-white font-semibold transform -rotate-180 @else font-semibold transform -rotate-180 @endif">2.
                Tickets</span>
        </div>
        <div
            class="@if ($currentStep == 3) bg-yellow-400 p-4 rounded-lg flex-grow
         @elseif($currentStep > 3) flex-1 bg-indigo-900 p-4 rounded-lg transform rotate-180 @else bg-yellow-100 p-4 rounded-lg flex-grow transform rotate-180 @endif">
            <span
                class="@if ($currentStep == 3) font-semibold
             @elseif($currentStep > 3) text-white font-semibold transform -rotate-180 @else font-semibold transform -rotate-180 @endif">3.
                Personal Details</span>
        </div>
        <div
            class="@if ($currentStep == 4) bg-yellow-400 p-4 rounded-lg flex-grow
         @elseif($currentStep > 4) flex-1 bg-indigo-900 p-4 rounded-lg transform rotate-180 @else bg-yellow-100 p-4 rounded-lg flex-grow transform rotate-180 @endif"">
            <span
                class="@if ($currentStep == 4) font-semibold
             @elseif($currentStep > 4) text-white font-semibold transform -rotate-180 @else font-semibold transform -rotate-180 @endif">4.
                Make Payment</span>
        </div>

    </div>
</div>



<!-- Form Steps / Progress Bar -->
{{-- <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
         <!-- Step 1 -->
         <li class=" @if ($currentStep == 1) form-stepper-active @elseif($currentStep > 1) form-stepper-completed @else form-stepper-unfinished @endif text-center form-stepper-list"
             step="1">
             <a class="mx-2">
                 <span class="form-stepper-circle">
                     <span>1</span>
                 </span>
                 <div class="label">Options</div>
             </a>
         </li>
         <!-- Step 2 -->
         <li class="@if ($currentStep == 2) form-stepper-active @elseif($currentStep > 2) form-stepper-completed @else form-stepper-unfinished @endif text-center form-stepper-list"
             step="2">
             <a class="mx-2">
                 <span class="form-stepper-circle text-muted">
                     <span>2</span>
                 </span>
                 <div class="label text-muted">Tickets</div>
             </a>
         </li>
         <!-- Step 3 -->
         <li class="@if ($currentStep == 3) form-stepper-active @elseif($currentStep > 3) form-stepper-completed @else form-stepper-unfinished @endif text-center form-stepper-list"
             step="3">
             <a class="mx-2">
                 <span class="form-stepper-circle text-muted">
                     <span>3</span>
                 </span>
                 <div class="label text-muted">Personal Details</div>
             </a>
         </li>
         <li class="@if ($currentStep == 4) form-stepper-active @elseif($currentStep > 4) form-stepper-completed @else form-stepper-unfinished @endif text-center form-stepper-list"
             step="4">
             <a class="mx-2">
                 <span class="form-stepper-circle text-muted">
                     <span>4</span>
                 </span>
                 <div class="label text-muted">Summary</div>
             </a>
         </li>
     </ul> --}}
