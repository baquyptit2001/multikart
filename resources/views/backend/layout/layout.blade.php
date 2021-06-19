<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/ecommerce/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Jun 2021 13:32:20 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/favicon.png') }}">
    <title>@yield('title')</title>
    <!-- chartist CSS -->
    <link rel="stylesheet" href="{{ asset('backend/node_modules/dropify/dist/css/dropify.min.css')}}">
    <link href="{{ asset('backend/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/pages/ecommerce.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-default fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @yield('content')
        <footer class="footer">
            © 2020 Eliteadmin by themedesigner.in
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
</body>
<script src="{{ asset('backend/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('backend/node_modules/popper/popper.min.js')}}"></script>
<script src="{{ asset('backend/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('backend/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{ asset('backend/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{ asset('backend/dist/js/sidebarmenu.js')}}"></script>
<!--stickey kit -->
<script src="{{ asset('backend/node_modules/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<script src="{{ asset('backend/node_modules/sparkline/jquery.sparkline.min.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('backend/dist/js/custom.min.js')}}"></script>
<script src="{{ asset('backend/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="{{ asset('backend/node_modules/raphael/raphael-min.js')}}"></script>
<script src="{{ asset('backend/node_modules/morrisjs/morris.min.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('backend/dist/js/ecom-dashboard.js')}}"></script>
<!-- Editable -->
<script src="{{ asset('backend/node_modules/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
{{-- <script src="{{ asset('backend/node_modules/datatables/media/js/dataTables.bootstrap.html')}}"></script> --}}
<script src="{{ asset('backend/node_modules/tiny-editable/mindmup-editabletable.js')}}"></script>
<script src="{{ asset('backend/node_modules/tiny-editable/numeric-input-example.js')}}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/9fd97b7f3f.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<script>
    $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
    $('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
    $(document).ready(function() {
        $('#editable-datatable').DataTable();
    });
</script>


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/ecommerce/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Jun 2021 13:33:52 GMT -->
</html>