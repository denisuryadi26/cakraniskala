<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{asset('vuexy/assets/')}}" data-template="vertical-menu-template">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="ws_url" content="{{ env('WS_URL') }}">
    <meta name="user_id" content="{{Auth::id() }}">

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('vuexy/assets/img/favicon/favicon.ico')}}" />
    <!-- Title -->
    <title> {{env('APP_NAME') }} @hasSection('title') - @yield('title') @else - @endif </title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <!-- <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/css/rtl/theme-default.css')}}" /> -->
    <link rel="stylesheet" href="{{asset('vuexy/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/flatpickr/flatpickr.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/tagify/tagify.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('vuexy/assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('vuexy/assets/vendor/js/helpers.js')}}">
    </script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('vuexy/assets/js/config.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('tables/css/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('tables/css/datatable/responsive.bootstrap4.min.css')}}">


    <link rel="stylesheet" href="{{asset('lib/charts/css/chart-apex.css')}}">
    <link rel="stylesheet" href="{{asset('lib/charts/css/apexcharts.css')}}">


    <link rel="stylesheet" type="text/css" href="{{asset('lib/bootstrap-fileinput/css/fileinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lib/font-awesome/css/font-awesome.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('lib/select2/css/select2.min.css')}}">

    @yield('stylesheet')

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('admin.templates.sidebar')

            <!-- Layout container -->
            <div class="layout-page">
                @include('admin.templates.header')
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- ========== MAIN CONTENT ========== -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('breadcumbs')

                        <!-- <div class="card"> -->
                        <!-- <h5 class="card-header">Ajax Sourced Server-side</h5> -->

                        @yield('content')
                        <!-- </div> -->
                    </div>
                    @include('admin.templates.footer')


                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- ========== END SECONDARY CONTENTS ========== -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->


    <script src="{{asset('vuexy/assets/vendor/libs/hammer/hammer.js')}}"></script>

    <!-- endbuild -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('vuexy/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/node-waves/node-waves.js')}}"></script>

    <script src="{{asset('vuexy/assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

    <script src="{{asset('vuexy/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('vuexy/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/tagify/tagify.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/swiper/swiper.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
    <script src="{{asset('vuexy/assets/js/extended-ui-sweetalert2.js')}}"></script>
    <!-- Flat Picker -->
    <script src="{{asset('vuexy/assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('vuexy/assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('vuexy/assets/js/main.js')}}"></script>
    <!-- Page JS -->
    <script src="{{asset('vuexy/assets/js/dashboards-analytics.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('vuexy/assets/js/tables-datatables-advanced.js')}}"></script>
    <script src="{{asset('vuexy/assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('vuexy/assets/js/forms-tagify.js')}}"></script>
    <script src="{{asset('vuexy/assets/js/forms-typeahead.js')}}"></script>

    <!-- jquery-validation Js -->

    <script src="{{asset('lib/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('lib/form/form-validation.js')}}"></script>
    <!-- <script src="{{asset('lib/sweetalert2/sweetalert2.js')}}"></script> -->

    <!-- JS Front -->
    <script src="{{asset('tables/js/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('tables/js/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('tables/js/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('tables/js/datatable/responsive.bootstrap4.js')}}"></script>
    <script src="{{asset('js/core.js')}}"></script>

    <script src="{{asset('lib/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('lib/select2/js/form-select2.js')}}"></script>

    <script src="{{asset('lib/bootstrap-fileinput/js/fileinput.js')}}"></script>
    <script src="{{asset('lib/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('lib/fa-theme/theme.js')}}"></script>
    <script src="{{asset('lib/charts/js/chart-apex.js')}}"></script>
    <script src="{{asset('lib/charts/js/apexcharts.js')}}"></script>

    {{--SOCKET JS--}}
    <!-- <script src="{{ asset('lib/socket/vue.js') }}"></script>
    <script src="{{ asset('lib/socket/socket.io.js') }}"></script>
    <script src="{{ asset('lib/socket/moment.min.js') }}"></script>
    <script src="{{ asset('lib/socket/chat.js') }}"></script>
    <script src="{{ asset('lib/socket/notif.js') }}"></script> -->
    {{--SOCKET JS--}}


    @yield('script')
</body>

</html>