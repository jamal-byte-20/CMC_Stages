<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Partner Opportunities' }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{ $styles ?? '' }}
</head>
<body class="bg-gray-50 min-h-screen">
    <x-navigation />
    
    <main class="container mx-auto px-4 py-8">
        {{ $slot }}
    </main>
    
    <x-footer />
    
    {{ $scripts ?? '' }}
</body>
</html>