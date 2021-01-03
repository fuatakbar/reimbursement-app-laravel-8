<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>

    @include('includes.style')

    {{-- custom style --}}
    @stack('prepend-style')
    <link rel="stylesheet" href="{{url('styles/css/main.min.css')}}">
    @stack('addon-style')
</head>
<body>
    <header>
        {{-- navbar --}}
        @include('includes.navbar')
        {{-- end navbar --}}
    </header>
    
    <main>
        {{-- content area --}}
        @yield('content')
    </main>

    {{-- notification modal --}}
    @include('includes.notification-modal')

    <footer>
        @include('includes.footer')
    </footer>
    
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>
</html>