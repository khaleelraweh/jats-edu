<?php $rtl = config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl' ? '-rtl' : ''; ?>

{{-- if there is no cookie yet then make it dark else check the cookie value --}}
<?php $dark = Cookie::get('theme') !== null ? (Cookie::get('theme') == 'dark' ? '-dark' : '') : '-dark'; ?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir=<?php echo $rtl ? 'rtl' : ''; ?>>


{{-- {{ dd(Cookie::get('theme')) }} --}}

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="معهد خطوة شباب للتدريب واللغات" />
    <meta name="robots" content="all,follow">
    <meta name="author" content="معهد خطوة شباب للتدريب واللغات" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title> Dashboard | {{ config('app.name', 'معهد خطوة شباب للتدريب واللغات') }} - Admin & Dashboard Template </title>

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    {{-- summernote for description field  --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/summernote/summernote-bs4.min.css') }}">

    {{-- pickadate calling css --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.date.css') }}">

    {{-- Select2 labs  --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">


    {{-- Responsive fileInput --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css') }}">

    <!-- Plugins css -->
    {{-- <link href="{{ asset('backend/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css"> --}}

    {{-- start new  --}}
    <!-- DataTables -->
    <link
        href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css') }}" />
    <link
        href="{{ asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
                                                                                                                                                                                                                                                                        type="text/css') }}" />
    <link
        href="{{ asset('backend/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet"
                                                                                                                                                                                                                                                                        type="text/css') }}" />

    <!-- Responsive datatable examples -->
    <link
        href="{{ asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
                                                                                                                                                                                                                                                                        type="text/css') }}" />

    {{-- end  new  --}}

    <!-- Bootstrap Css -->
    <link href="<?php echo asset('backend/css/bootstrap' . $dark . $rtl . '.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css">



    <!-- Icons Css -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="<?php echo asset('backend/css/app' . $dark . $rtl . '.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css">


    <!-- Fontawesome icon -->
    <link href="{{ asset('backend/vendor/fontawesome/fontawesome.css') }}" rel="stylesheet" />

    <!-- fontawesome icon  picker  -->
    <link href="{{ asset('backend/vendor/fontawesomepicker/css/fontawesome-iconpicker.css') }}" rel="stylesheet">


    {{-- my custom css --}}
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/css/custom' . $rtl . '.css') }}">

    @livewireStyles

    @yield('style')


</head>

<body data-topbar="dark">

    {{-- <body data-topbar="{{ $theme == 'dark' ? 'dark' : 'light' }}"> --}}

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div id="app">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- start  page-topbar -->
            @include('partial.backend.topbar')
            <!-- end  page-topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('partial.backend.vertical-menu')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">

                    <div class="container-fluid">
                        @include('partial.backend.flash')
                        @yield('content')
                    </div>

                </div>
                <!-- End Page-content -->
                @include('partial.backend.footer')

            </div>
            <!-- end main content-->


        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        @include('partial.backend.rightbar')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

    </div>



    @livewireScripts
    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    {{-- <script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
    <!-- jquery.vectormap map -->
    <script src="{{ asset('backend/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('backend/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>
    <!-- Responsive fileInput js start -->
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fa5/theme.min.js') }}"></script>
    <!-- Datatable init js -->
    {{-- <script src="{{ asset('backend/js/pages/dashboard.init.js') }}"></script> --}}


    <!-- Plugin js for Tinymce -->
    <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}"></script>
    <!-- End plugin js for Tinymce -->

    <script>
        var tinymceLanguage = '{{ app()->getLocale() }}'; // Get the current locale from Laravel config
        var flatPickrLanguage = '{{ app()->getLocale() }}';
    </script>

    <!-- Custom js for the Tinymce -->
    <script src="{{ asset('backend/js/tinymce.js') }}"></script>
    <!-- End custom js for Tinymce -->

    <!--tinymce js for editor -->


    {{-- summernote for description note field --}}
    <script src="{{ asset('backend/vendor/summernote/summernote-bs4.min.js') }}"></script>
    {{-- pickadate calling js --}}
    <script src="{{ asset('backend/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.date.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.time.js') }}"></script>
    {{-- Call select2 plugin --}}
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    {{-- Calling fontawesome icon picker   --}}
    <script src="{{ asset('backend/vendor/fontawesomepicker/js/fontawesome-iconpicker.js') }}"></script>

    <!--tinymce js for editor -->
    <script src="{{ asset('backend/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/js/pages/form-editor.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>


    <script src="{{ asset('backend/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('backend/js/pages/datatables.init.js') }}"></script>


    <!-- App js -->
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        $(function() {
            $('.icon-picker').iconpicker();
        });
    </script>



    @yield('script')


</body>

</html>
