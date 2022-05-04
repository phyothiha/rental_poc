<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="font-sans antialiased h-full">
        <div id="app" class="h-full">
            <div class="min-h-full">
                <dashboard-navigation-bar></dashboard-navigation-bar>

                <dashboard-header heading="Dashboard"></dashboard-header>

                <main>
                    <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
