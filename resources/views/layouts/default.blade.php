<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.includes.head')
    @stack('css')
</head>

<body>
    @include('layouts.includes.header')

    @yield('content')
    
    @include('layouts.includes.footer')
    @include('layouts.includes.js')
    @stack('js')
</body>

</html>