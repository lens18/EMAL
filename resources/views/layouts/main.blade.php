<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JKR | EMAL</title>

    <link rel="stylesheet" href="">

    <script src=""></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--css js-->
</head>

<!-- Custom fonts for this template-->
<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
  @yield('beforeScript')
<body>


@if (Session::has('success'))
<script>
    Swal.fire(
    'Successful!',
    '{{ Session::get('success')}}',
    'success'
    ).then((result) => {
        console.log(result)
        if (result.isConfirmed) {
            window.location = "/login";
        }
    })
</script>
@elseif (Session::has('error'))
<script>
    Swal.fire(
    'Error!',
    '{{ Session::get('error')}}',
    'error'
    )
</script>
@endif


<!-- Page Wrapper -->
<div id="wrapper">
    @include('layouts.sidebar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            @include('layouts.topbar')
            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white" style="position: absolute;bottom: 0;right: 40%;z-index:-1;">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; RASYID 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->


</body>

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>-->

    <!-- Page level custom scripts
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>-->

   @yield('afterScript')
</html>
