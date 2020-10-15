<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Head Begin -->
@include('frontend.partials.head')
<!-- Head End -->
<body>

    <!-- Header Section Begin -->
    @include('frontend.partials.header')
    <!-- Header End -->

    <!-- Section -->
    @yield('content')
    <!-- Section End -->

    <!-- Partner Logo Section Begin -->
    @include('frontend.partials.partner')
    <!-- Partner Logo Section End -->
    
    <!-- Footer Section Begin -->
    @include('frontend.partials.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('frontend.partials.main-js')
    <!-- Js Plugins End -->
</body>

</html>
