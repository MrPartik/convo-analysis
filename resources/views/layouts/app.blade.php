<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    @livewireScripts

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @livewire('navigation-dropdown')
    <!--
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    -->
    <main>
        <div class="py-5">
            {{ $slot }}
        </div>
    </main>
</div>
@if(Auth::user()->role === 'user')
    <div id='convo-wrapper' class="w-2/3 max-w-7xl fixed bottom-0 right-0">
        <div class="bg-white overflow-hidden shadow-xl rounded-b-none rounded-lg">
            <div class="h-10 bg-indigo-500 p-2 cursor-pointer" onclick='toggleConvo()'
                 style="box-shadow: 1px 1px 10px black;">
                <span class='font-bold text-white mr-1'>{{ \env('APP_NAME', 'BrixBo') . ' AI' }}</span>
                <!--
                <div class = "float-right" >
                    <svg class = "fill-current text-white" width = "24" height = "24" xmlns = "http://www.w3.org/2000/svg" viewBox = "0 0 24 24" >
                        <path d = "M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d = "M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg >
                </div >
                -->
            </div>
            @livewire('convo')
        </div>
    </div>
    <style>
        .scrollbar-w-2::-webkit-scrollbar {
            width: 0.25rem;
            height: 0.25rem;
        }

        .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity));
        }

        .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
            --bg-opacity: 1;
            background-color: #edf2f7;
            background-color: rgba(237, 242, 247, var(--bg-opacity));
        }

        .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
            border-radius: 0.25rem;
        }
    </style>
    <script>
        function scrollToLatest() {
            var el = document.getElementById('messages')
            el.scrollTop = el.scrollHeight
        }

        scrollToLatest();
        window.livewire.on('scrollToLatest', scrollToLatest);

        function toggleConvo() {
            $('#convo-container').slideToggle();
        }

        @if(request()->is('user') === false)toggleConvo()@endif
    </script>
@endif
@stack('modals')
</body>
</html>
