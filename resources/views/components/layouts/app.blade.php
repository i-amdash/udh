<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" crossorigin src="{{ asset('assets/js/theme-3a535b87.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/theme-e2a9673d.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Landmark Upsidedown House</title>
    {{-- {!! seo() !!} --}}

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&amp;family=Roboto:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

    <!-- Vendor CSS (Bootstrap & Icon Font) -->

    <!-- Plugins CSS (All Plugins Files) -->

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <!-- Style CSS -->


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/landmark.css') }}" />
</head>

<body class="font-karla text-body text-tiny">
    <div class="overflow-hidden">
        @includeIf('includes.header')
        <div class="fixed inset-0 z-50 hidden bg-black opacity-50 offcanvas-overlay"></div>
        @includeIf('includes.mobile_nav')


        {{ $slot }}



        @includeIf('includes.footer')

    </div>
    {{-- @livewireScripts --}}

    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


    {{-- <script src="./node_modules/preline/dist/preline.js"></script> --}}

    {{-- <script src="{{ asset('assets/js/vendor/modernizr-3.11.7.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script> --}}
    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugins/jquery.ajaxchimp.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/parallax.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugins/jquery.nice-select.min.js') }}"></script> --}}

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Activation JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash />
    <x-livewire-alert::scripts />



</body>

</html>
