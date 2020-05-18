<html lang="ru">
<head>
    @include('layouts.header')
</head>
<body>

    @include('layouts.menu')

    @yield('content')

    @yield('admin')

    @include('layouts.footer')
</body>
