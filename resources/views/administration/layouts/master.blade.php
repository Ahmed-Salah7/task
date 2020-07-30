<!DOCTYPE html>
<html>
@include('administration.partial.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('administration.partial.navbar')

@include('administration.partial.side_menu')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('administration.partial.footer')

</div>
<!-- ./wrapper -->
@include('administration.partial.scripts')
</body>
</html>
