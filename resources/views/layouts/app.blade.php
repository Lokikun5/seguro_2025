<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('meta.default.title'))</title>
    <meta name="description" content="@yield('description', config('meta.default.description'))">
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')"/>
    @else
        <link rel="canonical" href="{{ Request::url() }}"/>
    @endif
    @hasSection('noindex')
        <meta name="robots" content="@yield('noindex')"/>
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/images/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/images/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og:title', config('meta.default.title'))">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:description" content="@yield('og:description', config('meta.default.description'))">
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:image" content="@yield('og:image', asset('images/logo/seguro-logo2-min.webp'))">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter:title', config('meta.default.title'))">
    <meta name="twitter:description" content="@yield('twitter:description', config('meta.default.description'))">
    <meta name="twitter:image" content="@yield('twitter:image', asset('images/logo/seguro-logo2-min.webp'))">

    @vite(['resources/sass/app.scss'])
</head>
<body>

    {{-- Header global --}}
    @include('layouts.header')

    {{-- Contenu des pages --}}
    @yield('content')

    {{-- Footer global --}}
    @include('layouts.footer')

    @vite(['resources/js/app.js'])

</body>
</html>
