@include('include.header')
<div id="page-content">
    @include('include.hamburger')
    <div class="container-fluid">
        <!-- Main Content -->
        <div class="content p-3">
            @yield('content')
        </div>
    </div>
</div>
@include('include.footer')