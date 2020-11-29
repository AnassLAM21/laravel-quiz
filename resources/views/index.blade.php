<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="{{ URL::asset('admin/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ URL::asset('admin/dist/css/style.min.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body >
    <div id="app">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" >



        <header-component></header-component>

        <aside-component></aside-component>
        <div class="page-wrapper">
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid"> 

                {{-- <question-component></question-component> --}}
                             

                <quizzes-list-component>  </quizzes-list-component>
                <quiz-component></quiz-component>   
                
                
            </div>

            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>

        </div>
    </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    
    
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    
    <!-- Bootstrap tether Core JavaScript -->    
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}" ></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}" ></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script type="text/javascript" src="{{ URL::asset('admin/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script type="text/javascript" src="{{ URL::asset('admin/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('admin/dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    {{-- <script src="/dist/js/pages/dashboards/dashboard1.js"></script>  --}}
    <!-- Charts js Files -->
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/flot/excanvas.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/flot/jquery.flot.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/flot/jquery.flot.pie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/flot/jquery.flot.time.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/flot/jquery.flot.stack.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/dist/js/pages/chart/chart-page-init.js') }}"></script>


</body>
</html>