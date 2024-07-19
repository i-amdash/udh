<div>
    <!-- Step 1: Date and Age Picker -->
    <x-booking-page>

        <x-slot name="header">

        </x-slot>
        <x-slot name="body">
            @if ($isLoading)
                loading....
            @else
                <div class="px-[8rem] py-[3rem]">
                    <h1 class="font-[400] font-sans text-black text-[48px] py-8">
                        Payment Successful! 🎉
                    </h1>
                    <div class="w-2/3 py-8">
                        <p class="font-[400] text-[19px] font-sans text-black"> <span class="font-[600]">Thanks for
                                booking with the Upside
                                down
                                house!
                            </span> Your order summary and voucher will be sent to jod***********@yourmail.com
                        </p>
                    </div>
                    <div class="w-full flex flex-col">
                        <div class="w-12 h-12 absolute right-[36rem] rounded-full top-[27rem] z-2 bg-white"></div>
                        <div class="w-full bg-black rounded-2xl h-[360px]">
                            <div class="p-8">
                                <div class="flex flex-row w-[512px] justify-between">
                                    <h1 class="text-white font-sans font-[600] text-[23px]">UDH Ticket</h1>
                                    <div
                                        class="bg-[#FFF4CC] flex flex-row justify-center items-center w-[90px] h-[33px] rounded-full">
                                        <div class="flex flex-row justify-center items-center">
                                            <div class="h-[8px] rounded-full w-[8px] bg-[#554200]" />
                                            <p>Individual</p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="w-12 h-12 absolute right-[36rem] rounded-full top-[50rem] z-2 bg-white"></div>
                    </div>
                </div>
            @endif
        </x-slot>
    </x-booking-page>
</div>
