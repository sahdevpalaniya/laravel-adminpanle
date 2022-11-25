<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/favicon.jpg') }}">
    <!-- Sweetalert -->
    <link href="{{ url('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('assets/vendor/toastr/css/toastr.min.css') }}">
    <!-- Datatable -->
    <link href="{{ url('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    @section('style')
    @show
</head>
@include('admin.layouts.header')
@include('admin.layouts.sidebar')

<body>
    <div class="content-body">
        <div class="container-fluid">
            @include('admin.layouts.breadcrumb')
            @yield('content')
        @show
        @section('modals')
        @show
        @include('admin.layouts.footer')
    </div>
</div>
</body>
@section('scripts')
<!-- Required vendors -->
<script src="{{ url('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ url('assets/js/quixnav-init.js') }}"></script>
<script src="{{ url('assets/js/custom.min.js') }}"></script>
{{-- DataTables Link --}}
<script src="{{ url('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/js/plugins-init/datatables.init.js') }}"></script>
<!-- Comman Js File -->
<script src="{{ url('assets\js\common.js') }}"></script>
{{-- Sweet Alert --}}
<script src="{{ url('assets\js\sweetalert.js') }}"></script>
<!-- Toastr -->
<script src="{{ url('assets/vendor/toastr/js/toastr.min.js') }}"></script>
<script src="{{ url('assets/js/plugins-init/toastr-init.js') }}"></script>


@if (Session::has('alert-message'))
    <script>
        toastr.success("{{ Session::get('alert-message') }}","Success");
    </script>
@endif
@show
</body>

</html>
