<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Landmark Upsidedown House</title>

    <!-- Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" crossorigin src="{{ asset('assets/js/theme-3a535b87.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/theme-e2a9673d.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    @livewireStyles
</head>

<body class="antialiased dark:bg-black dark:text-white/50">
    @include('includes.header')
    <!-- Hero Section Start -->
    @include('includes.page-sections.hero')
    <!-- brand slider ends -->
    @include('includes.page-sections.about')
    <!-- Discover experience 2 ends -->
    @include('includes.page-sections.story')
    <!-- <Our Hero Today start  -->
    @include('includes.page-sections.hotm')
    <!-- <our Hero today ends -->
    <!-- Gallery Start -->
    @include('includes.page-sections.gallery')
    <!-- Gallery end -->
    <!-- Start Faq -->
    @include('includes.page-sections.faq')
    <!-- End faq -->
    <!-- Contact_us start -->
    @include('includes.page-sections.contact')
    <!-- Contact_us end -->
    <!-- footer begins here -->
    @include('includes.footer')
    <!-- footer ends here -->
    @include('includes.components.theme-change')
    @livewireScripts
</body>

</html>
