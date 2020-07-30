<!DOCTYPE html>
<html>
@include('user.partial.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('user.partial.navbar')

@include('user.partial.side_menu')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('user.partial.footer')

</div>
<!-- ./wrapper -->
@include('user.partial.scripts')
</body>
</html>
