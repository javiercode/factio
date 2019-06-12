<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' type='image/x-icon' href='{{URL::asset('favicon.ico')}}' />

        <title>@yield('title') | SM</title>

        <!-- Bootstrap -->
        <link href="{{URL::asset('bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{URL::asset('bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{URL::asset('bower_components/gentelella/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- Jquery-ui -->
        <link href="{{URL::asset('bower_components/jquery-ui/themes/base/jquery-ui.min.css')}}" rel="stylesheet">
    {{--<link href="{{URL::asset('bower_components/jquery-ui/style.css')}}" rel="stylesheet">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/assets/css/bootstrap.min.css"/>--}}
        <!-- bootstrap-daterangepicker -->
        <link href="{{URL::asset('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
        {{--<!-- bootstrap-datetimepicker -->--}}
        {{--<link href="{{URL::asset('bower_components/gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">--}}

        <!-- Animate.css -->
        <link href="{{URL::asset('bower_components/gentelella/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

        <!-- PNotify -->
        <link href="{{URL::asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
        <link href="{{URL::asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
        <link href="{{URL::asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">
        <!-- Select 2 -->
        <link href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('bower_components/select2-bootstrap-theme/dist/select2-bootstrap.css')}}" rel="stylesheet">

         <!-- Dtatables -->
        <link href="{{URL::asset('bower_components/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('bower_components/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('bower_components/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('bower_components/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('bower_components/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

        <!-- Inventory -->
        <link href="{{URL::asset('css/main.css')}}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{URL::asset('bower_components/bootstrap-sweetalert/dist/sweetalert.css')}}" rel="stylesheet">
        <!-- Sweeet Alert-->
        <link href="{{URL::asset('bower_components/gentelella/build/css/custom.min.css')}}" rel="stylesheet">
        @yield('css')
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @if (Auth::check())
                    @include('partials.sideMenuStatic')
                    @include('partials.topNavigationStatic')
                    {{--@include('partials.sideMenu')--}}
                    {{--@include('partials.topNavigation')--}}
                @else
                @endif
                {{$content}}
            </div>
        </div>
        @include('partials.footer')


        <!-- jQuery -->
        <script src="{{URL::asset('bower_components/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
        <!-- Bootstrap -->
        <script src="{{URL::asset('bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{URL::asset('bower_components/gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
        <!-- Jquery-ui -->
        <script src="{{URL::asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>--}}
        <!-- datetimepicker -->
        <script src="{{URL::asset('bower_components/gentelella/vendors/moment/min/moment.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        {{--<!-- bootstrap-datetimepicker -->--}}
        {{--<script src="{{URL::asset('bower_components/gentelella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>--}}
        <!-- NProgress -->
        <script src="{{URL::asset('bower_components/gentelella/vendors/nprogress/nprogress.js')}}"></script>
        <!-- PNotify -->
        <script src="{{URL::asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.buttons.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.nonblock.js')}}"></script>
        <!-- Select2 -->
{{--        <script src="{{URL::asset('bower_components/gentelella/vendors/select2/dist/js/select2.full.js')}}"></script>--}}
        <script src="{{URL::asset('bower_components/gentelella/vendors/validator/validator.js')}}"></script>
        <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.js')}}"></script>

        <!-- Datatables -->
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net/js/jquery.dataTables.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/jszip/dist/jszip.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{URL::asset('bower_components/gentelella/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{URL::asset('bower_components/bootstrap-sweetalert/dist/sweetalert.min.js')}}"></script>

        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}
        {{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB496BgOHBb3XeURpxPvhfVGHVFY3iMsTw&callback=initMap"></script>--}}

        <script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
        <script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
        {{--<script src="{{URL::asset('js/app.js')}}"></script>--}}
        @include('lib.appjs')
        {{$javascript}}
        <!-- Custom Theme Scripts -->
        {{--<script src="{{URL::asset('js/custom.js')}}"></script>--}}
        <script src="{{URL::asset('bower_components/gentelella/build/js/custom.js')}}"></script>
</body>
</html>