<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>

<body class="min-h-screen flex flex-col">

    <a href="#main-content"
       class="sr-only focus:not-sr-only">
        Skip to content
    </a>

    <main id="main-content" class="flex-1">
        @inertia
    </main>

</body>
</html>