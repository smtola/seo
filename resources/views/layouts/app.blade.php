<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- SEO Meta Tags --}}
    {!! SEOTools::generate() !!}

    {{-- Other head contents --}}
    @yield('head')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>