<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.layouts.shared.meta')
    @include('front.layouts.shared.styles')
    @include('front.layouts.shared.scripts')
</head>

<body>
    <main style="padding: 2rem">
        @yield('main-content')
    </main>
</body>
</html>
