<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice Generator</title>
    <meta name="description" content="Generate professional invoices with ease using our user-friendly invoice generator">

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