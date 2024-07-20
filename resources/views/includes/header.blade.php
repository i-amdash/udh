<header id="navbar"
    class="sticky inset-x-0 top-0 z-60 transition-all duration-500 flex items-center [&.nav-sticky]:bg-white/90 [&.nav-sticky]:backdrop-blur-3xl [&.nav-sticky]:shadow-md dark:[&.nav-sticky]:bg-default-50/80">
    <div class="w-full px-4 font-sans">
        <div class="flex items-center justify-between flex-wrap lg:flex-nowrap gap-16">
            <div class="w-full lg:w-auto flex items-center justify-between">
                <!-- Navbar Brand Logo -->
                <a href="/">
                    <img src="{{ asset('assets/UDH Logo.png') }}" alt="logo" class="h-[6rem] w-[12rem] object-contain">
                    <!-- <img src="assets/logo-light-82928a21.png" alt="logo" class="h-10 hidden dark:flex"> -->
                </a>

                <!-- Mobile Menu Toggle Button -->
                <button class="hs-collapse-toggle lg:hidden inline-block" id="hs-unstyled-collapse"
                    data-hs-collapse="#mobileMenu" data-hs-type="collapse">
                    <i data-lucide="menu" class="w-7 h-7 text-default-600 hover:text-default-900"></i>
                </button>
            </div>

            <div id="mobileMenu"
                class="hs-collapse transition-all duration-300 lg:basis-auto basis-full grow hidden lg:flex items-center justify-center mx-auto mt-2 lg:mt-0 overflow-hidden">
                <!-- Nevigation Menu -->
                <ul class="menu flex lg:items-center justify-center flex-col lg:flex-row gap-y-2">
                    <li
                        class="menu-item text-default-800 lg:mx-2 transition-all duration-500 hover:text-primary [&.active]:text-primary">
                        <a class="inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 rounded-full capitalize"
                            href="/">Home </a>
                    </li>
                    <li
                        class="menu-item text-default-800 lg:mx-2 transition-all duration-500 hover:text-primary [&.active]:text-primary">
                        <a class="inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 rounded-full capitalize"
                            href="/about">About Us </a>
                    </li>
                    <li
                        class="menu-item text-default-800 lg:mx-2 transition-all duration-500 hover:text-primary [&.active]:text-primary">
                        <a class="inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 rounded-full capitalize"
                            href="/gallery">Gallery </a>
                    </li>
                    <li
                        class="menu-item text-default-800 lg:mx-2 transition-all duration-500 hover:text-primary [&.active]:text-primary">
                        <a class="inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 rounded-full capitalize"
                            href="/merchandise">Merchandise</a>
                    </li>
                    <li
                        class="menu-item text-default-800 lg:mx-2 transition-all duration-500 hover:text-primary [&.active]:text-primary">
                        <a class="inline-flex items-center text-sm lg:text-base font-medium py-0.5 px-2 rounded-full capitalize"
                            href="/offerings">Other Offerings</a>
                    </li>
                </ul>
            </div>

            <div class="ms-auto shrink hidden lg:inline-flex gap-2">
                <a href="/booking"
                    class="py-1.5 px-6 inline-flex items-center gap-2 rounded-full text-base text-white bg-[#FF901A] hover:bg-(#F58634) transition-all duration-500">
                    <!-- <i data-lucide="download-cloud" class="h-4 w-4 fill-white/40"></i> -->
                    <span
                        class="hidden sm:block hover:duration-500 hover:transform hover:rotate-180 ease-in-out">Ticket</span>
                </a>
            </div>
        </div>
    </div>
</header>
