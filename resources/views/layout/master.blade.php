@include('layout.header')
@include('layout.sideMenu')
<div class="main-content-wrap sidenav-open d-flex flex-column">
    <!-- ============ Body content start ============= -->
    <div class="main-content">
        @yield('content')
    </div>
    @include('layout.footer')
</div>
</div>

