<div class="container mx-auto px-4 py-8">
    @if ($currentStep == 1)
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold">Visit the first upside down house in <span
                    class="text-primary">West
                    Africa!</span></h1>
        </div>
    @elseif ($currentStep == 2)
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Choose Your <span class="text-primary">Ticket!</span>
            </h1>
        </div>
    @elseif ($currentStep == 3)
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Enter Your Personal <span
                    class="text-primary">information!</span></h1>
        </div>
    @else
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-1">Payment <span class="text-primary">Summary</span></h1>
        </div>
    @endif
    <div class="hidden md:flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
        <div
            class="@if ($currentStep == 1) flex-1 bg-primary p-4 rounded-lg flex-grow
         @elseif($currentStep > 1) flex-1 bg-[#e07000] p-4 rounded-lg transform rotate-180 @endif">
            <span
                class="@if ($currentStep == 1) font-semibold text-white
             @elseif($currentStep > 1) text-white font-semibold transform -rotate-180 @endif">
                1. Booking Date
            </span>
        </div>
        <div
            class="@if ($currentStep == 2) bg-primary p-4 rounded-lg flex-grow
         @elseif($currentStep > 2) flex-1 bg-[#e07000] p-4 rounded-lg transform rotate-180 @else bg-[#FEF7F3] p-4 rounded-lg flex-grow transform rotate-180 @endif">
            <span
                class="@if ($currentStep == 2) font-semibold text-white
             @elseif($currentStep > 2) text-white font-semibold transform -rotate-180 @else font-semibold transform -rotate-180 @endif">2.
                Tickets</span>
        </div>
        <div
            class="@if ($currentStep == 3) bg-primary p-4 rounded-lg flex-grow text-white
         @elseif($currentStep > 3) flex-1 bg-[#e07000] p-4 rounded-lg transform rotate-180 @else bg-[#FEF7F3] p-4 rounded-lg flex-grow transform rotate-180 @endif">
            <span
                class="@if ($currentStep == 3) font-semibold
             @elseif($currentStep > 3) text-white font-semibold transform -rotate-180 @else font-semibold transform -rotate-180 @endif">3.
                Personal Details</span>
        </div>
        <div
            class="@if ($currentStep == 4) bg-primary p-4 rounded-lg flex-grow text-white
         @elseif($currentStep > 4) flex-1 bg-[#e07000] p-4 rounded-lg transform rotate-180 @else bg-[#FEF7F3] p-4 rounded-lg flex-grow transform rotate-180 @endif"">
            <span
                class="@if ($currentStep == 4) font-semibold
             @elseif($currentStep > 4) text-white font-semibold transform -rotate-180 @else font-semibold transform -rotate-180 @endif">4.
                Make Payment</span>
        </div>

    </div>



    

<ol class="flex md:hidden items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
@if ($currentStep > 1)  <li class="flex md:w-full items-center text-primary dark:text-primary sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            Date <span class="hidden sm:inline-flex sm:ms-2">Info</span>
        </span>
    </li>
    @else
    <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <span class="me-2">1</span>
            Date <span class="hidden sm:inline-flex sm:ms-2">Info</span>
        </span>
    </li>
    @endif
    @if($currentStep <= 2)
    <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <span class="me-2">2</span>
            Ticket <span class="hidden sm:inline-flex sm:ms-2">Info</span>
        </span>
    </li>
    @else
    <li class="flex md:w-full items-center text-primary dark:text-primary sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            Ticket <span class="hidden sm:inline-flex sm:ms-2">Info</span>
        </span>
    </li>
    @endif
    @if ($currentStep <= 3)
    <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <span class="me-2">3</span>
            Personal <span class="hidden sm:inline-flex sm:ms-2">Info</span>
        </span>
    </li>
    @else
    <li class="flex md:w-full items-center text-primary dark:text-primary sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            Personal <span class="hidden sm:inline-flex sm:ms-2">Info</span>
        </span>
    </li>
    @endif
    <li class="flex items-center">
        <span class="me-2">4</span>
        Summary
    </li>
</ol>



</div>