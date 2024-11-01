<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="{{ asset('main/datepicker/datepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('/bootstrap/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ url('/bootstrap/js/bootstrap.min.js') }}"></script>


    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    @yield('style')

    <?php
    
    $vendorsInQueue = App\Models\Vendor::where('user_id', '!=', '11')->where('status', '!=', 'yes')->get();
    
    // dd($vendorsInQueue);
    
    $productsInQueue = App\Models\Product::where('status', '!=', 'yes')->get();
    
    // dd($productsInQueue);
    
    $storiesInQueue = App\Models\story::whereNull('acceptedbyAdmin')->get();
    
    $slidersInQueue = App\Models\Sliders::whereNull('acceptedbyAdmin')->where('paymentStatus', '!=', 'inPaymentQueue')->get();
    
    $brandsInQueue = App\Models\Brand::WhereNotNull('vendor_id')->where('is_active', 0)->get();
    
    $commentInQueue = App\Models\Admin\ProductComments::where('is_active', 0)->get();
    
    $specialVendorsInQueue = App\Models\Admin\SpecialVendors::whereNull('acceptedbyAdmin')->get();
    
    $specialProductInQueue = App\Models\Admin\SpecialProducts::whereNull('acceptedbyAdmin')->get();
    
    $storiesVendorsInQueue = App\Models\story::whereNull('acceptedbyAdmin')->get();
    
    $slidersVendorsInQueue = App\Models\Sliders::whereNull('acceptedbyAdmin')->get();
    
    $notSeenTickets = App\Models\Ticket::where('answered_to', null)->sum('has_New_Ticket_In_This_Thread_from_user');
    
    $settings = App\Models\Admin\Setting::first();
    
    $inQueueArticles = App\Models\UserArticles::inQueueArticles()->get();
    
    ?>


    <link href="sabt2/css/style.css" rel="stylesheet">






</head>

<body id="page-top">
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.sections.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.sections.topbar')



                @include('sweetalert::alert')

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    @if (Session::has('deleted'))
                        <div class="alert alert-danger">
                            {{ Session::get('deleted') }}
                        </div>
                    @endif

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('admin.sections.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('admin.sections.scroll_top')



    <!-- JavaScript-->
    <script src="{{ asset('/js/admin.js') }}"></script>



    @include('sweetalert::alert', ['cdn' => env('SWEET_ALERT_CDN')])


    @yield('script')
    {{-- <script src="{{ url('jquery/jquery.min.js') }}"></script> --}}
    {{-- <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script> --}}


    @yield('script2')
    <script src="sabt2/js/functions.js"></script>

    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({

                ordering: true

            });
        });
    </script>




</body>

</html>
