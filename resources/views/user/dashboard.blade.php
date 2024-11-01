@extends('user.layouts.user')

@section('script')
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Direct", "Referral", "Social"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>

    <style>
        .storyBar::-webkit-scrollbar {
            display: none;
        }

        body {
            zoom: 90%;

        }
    </style>
@endsection

@section('title')
    dashboard
@endsection

@section('content')
    <!-- Page Heading -->


    @unlesshasvendor(Auth::user())
        @include('user.sections.formCreateVendor')
    @endhasvendor



    <!-- Content Row -->
    <div class="row">
        @php
            $user = Auth::user();
        @endphp
        {{-- <div style="display: flex;" class="col-11"> --}}
        {{-- شروع استوری --}}

        {{-- <div style="display: flex; justify-content: start; overflow-x: scroll; width:100%;" class="col-1  storyBar mt-1"> --}}



        <div class="col-12 row" style="overflow-x: scroll;">

            @if (count(Auth::user()->vendor->activeStories) > 0)
                <a href='{{ route('user.dashboard', ['MyStrories' => Auth::user()->vendor->id  , 'urlback'=>url()->full() ])}}'> <img
                        style="border-radius: 50%; width:100px;height:100px; margin:15px; border:4px solid rgb(0, 255, 0);"
                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . Auth::user()->vendor->avatar) }}"
                        class="storycircle"></a>
            @else
                <a href="{{ route('user.upgrade') }}" style="padding: 10px;" class="col-sm-1 story-img-div col-3">


                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor"
                        class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                        <path
                            d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                </a>
            @endif





            @foreach ($followings as $following)
                @if ($following->hasActiveStory($following->vendor2->id) == 1)
                    <a href='{{ route('user.dashboard', ['fId' => $following->vendor2->id , 'urlback'=>url()->full()]) }} '> <img
                            style="border-radius: 50%; width:100px; margin:15px; border:1px solid green;"
                            src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $following->vendor2->avatar) }}"
                            class="storycircle"></a>
                @endif
            @endforeach
        </div>


        {{-- <img src="{{ asset('/main/images/story/3.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img style="border-radius: 50%; width:100px; margin:15px;" src="{{ asset('/main/images/story/2.jpeg') }}"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/3.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/4.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img style="border-radius: 50%; width:100px; margin:15px;" src="{{ asset('/main/images/story/2.jpeg') }}"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/3.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/4.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img style="border-radius: 50%; width:100px; margin:15px;" src="{{ asset('/main/images/story/2.jpeg') }}"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/3.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/4.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/4.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle">
                <img src="{{ asset('/main/images/story/5.jpg') }}" style="border-radius: 50%; width: 100px; margin:15px;"
                    alt="" class="storycircle"> --}}
        {{-- </div> --}}


        {{-- پایان استوری --}}
        {{-- </div> --}}


        {{-- comment by meysam becxause duplicate --}}


        {{-- <div class="d-xs-block d-md-none ">
            @if (\App\Models\Admin\SiteSetting::first()->paymentStatus)
                <div
                    @if (Auth::user()->CREDIT < 10000) class="alert alert-danger "
        
             @else
             class="alert alert-info " @endif>
                
                    موجودی حساب شما : {{ Auth::user()->CREDIT }} تومان

                    <a class="btn btn-success" href="{{ route('user.orders.index') }}"> افزایش حساب +</a>

                </div>
            @endif
        </div> --}}

        {{--          
        <div class="addneww"
            style=" overflow: hidden; text-decoration: none; width: 100%; height: 150px;  text-align: center; color:white; background-color:red; margin:5px 0 ;">
            <a href="{{ route('user.products.create') }}"
                style=" overflow: hidden; text-decoration: none; width: 100%; height: 150px;  text-align: center; color:white; background-color:red; margin:5px 0;"
                class="addnewwq">

          افزودن کالا

            </a>
        </div> --}}
        <!-- Earnings (Monthly) Card Example -->



        <a href="{{ route('user.follow.followings.index') }}" class="col-xl-2 col-md-6 col-4 p-2 ">
            <div class="card border-right-primary shadow h-100 py-2">
                <div class="card-body px-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                دنبال شوندگان


                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ count(Auth::user()->vendor->following) }}


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </a>


        <a href="{{ route('user.follow.followers.index') }}" class="col-xl-2 col-md-6 col-4 p-2 ">
            <div class="card border-right-success shadow h-100 py-2">
                <div class="card-body px-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">

                                دنبال کنندگان </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">

                                {{ count(Auth::user()->vendor->followers) }}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </a>

        <div class="col-xl-2 col-md-6 col-4 p-2">
            <div class="card border-right-danger shadow h-100 py-2">
                <div class="card-body px-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"> تعداد بازدید
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">


                                {{ Auth::user()->vendor->view_count }}


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <a href="{{ route('user.products.index') }}" class="col-xl-2 col-md-6 col-6 p-2 ">
            <div class="card border-right-warning shadow h-100 py-2">
                <div class="card-body px-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning  text-uppercase mb-1"> تعداد کالا های فعال
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                {{ Auth::user()->vendor->product_count }}



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </a>

        <div class="col-xl-2 col-md-6 col-6 p-2">
            <div class="card border-right-secondary shadow h-100 py-2">
                <div class="card-body px-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"> تاریخ آخرین ورود
                            </div>
                            <div class=" h5  my-0 font-weight-bold text-gray-800">

                                <?php
                                
                                $datetime = \Morilog\Jalali\Jalalian::forge(Auth::user()->vendor->last_login);
                                
                                echo $datetime;
                                
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



      
        <hr>


        
        <div class="col-12 rounded" >
            
                    <h3 class="">
                        کالا های پر بازدید شما :
                    </h3>


            <table class="table table-bordered table-striped text-center">

                <thead>
                    <tr>

                        
                        a
                        <th>نام</th>
                        
                       
                        <th>تعداد بازدید</th>
                      
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($most_viewed_products as $key => $product)
                        <tr>
                            <th>
                                @if( checkIfHasActiveSpc($product->id))
                                <img
                                
                                style="width:40px; height:40px;"
                                
                                src="{{ asset('images/pngtree-vip-icon-for-game-golden-crown-with-red-jewel-png-image_3603951.jpg') }}" alt="">
                                @endif

                                @if (checkIfHasActiveStory($product->id))

                                <img
                                
                                style="width:40px; height:40px;"
                                
                                src="{{ asset('images/instagram-stories.jpg') }}" alt="">
                                @endif

                                
                                
                                <a
                                    href="{{ route('products.show', [ 'product' => $product->slug]) }}">
                                    {{ $product->name }}
                                </a>
                            </th>
                     


                            <th>
                                {{ $product->view_counter }}
                            </th>


                      

                            <th>
                                <div class="d-flex" style="justify-content: space-evenly;">


                                    <a href="{{ route('user.products.edit', ['product' => $product->id]) }}"
                                        class="btn btn-sm btn-primary">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </a>
                                    @if ($product->status != 'new')
                                        @if (userDashboard(['usersLaddelP']))
                                            <form action="{{ route('user.products.ladder') }}" method="post">


                                                @csrf
                                                <input type="hidden" name="product" value="{{ $product->id }}">



                                                <button type="submit" name="ladder" class="btn btn-sm btn-danger"
                                                    value="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-ladder" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4.5 1a.5.5 0 0 1 .5.5V2h6v-.5a.5.5 0 0 1 1 0v14a.5.5 0 0 1-1 0V15H5v.5a.5.5 0 0 1-1 0v-14a.5.5 0 0 1 .5-.5zM5 14h6v-2H5v2zm0-3h6V9H5v2zm0-3h6V6H5v2zm0-3h6V3H5v2z" />
                                                    </svg>
                                                </button>

                                            </form>
                                        @endif


                                        @if (userDashboard(['usersSendStory']))
                                            <a href="{{ route('user.story.create', ['productId' => $product->id]) }}"
                                                class="btn btn-sm btn-story" alt='story'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-bullseye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10zm0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                                    <path
                                                        d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                                                    <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                </svg> </a>
                                        @endif

                                        @if (userDashboard(['usersUpgradeProduct']))
                                            <a href="{{ route('user.upgradeproduct.create', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">

                                                <span type="button" class="" style="font-size: 10px;">
                                                    AD
                                                </span>

                                                <span
                                                    style="  background-color: rgb(33, 32, 32); color:#efefef;  position: fixed; top:20%; left:100px; display:none; width:300px;">

                                                    ارسال به صفحه اول(محصولات ویژه) </span>

                                            </a>
                                        @endif
                                    @endif
                                    {{-- <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        عملیات
                                    </button>
                                    <div class="dropdown-menu">

                                        <a href="{{ route('user.products.edit', ['product' => $product->id]) }}"
                                            class="dropdown-item text-right"> ویرایش محصول </a>



                                        <a href="{{ route('user.products.ladder', ['product' => $product->id]) }}"
                                            class="dropdown-item text-right"> نردیان محصول </a>





                                        <a href="{{ route('user.products.images.edit', ['product' => $product->id]) }}"
                                            class="dropdown-item text-right"> ویرایش تصاویر </a>

                                        <a href="{{ route('user.products.category.edit', ['product' => $product->id]) }}"
                                            class="dropdown-item text-right"> ویرایش دسته بندی و ویژگی </a>

                                    </div> --}}
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if (userDashboard())
        <div class="col-12">
         <div class="row mb-4">

             @if (userDashboard(['usersSendSlider']))
                 <div class="col-md-4 col-4 p-1">
                     <a href="{{ route('user.vendorSliedrPage') }}" class="col-xl-3 col-md-6  mb-4">
                         <div class=" border-bottom-warning shadow  py-2">
                             <div class="">
                                 <div class="row no-gutters align-items-center">
                                     <div class="col mr-2">
                                         <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                             ارسال
                                             اسلایدر
                                         </div>
                                         <div class="h6 mb-0 font-weight-bold text-gray-800">
                                             40,000

                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>
                     </a>
                 </div>
             @endif

             @if (userDashboard(['usersLaddelV', 'usersUpgradeVendor']))
                 <div class=" col-md-4 col-4 p-1">
                     <a href="{{ route('user.SpecialVendors.create') }}" class="col-xl-3 col-md-6  mb-4">
                         <div class="card border-bottom-danger shadow  py-2">
                             <div class="card-body">
                                 <div class="row no-gutters align-items-center">
                                     <div class="col mr-2">
                                         <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                             تبلیغ
                                             فروشگاه
                                         </div>
                                         <div class="h6 mb-0 font-weight-bold text-gray-800">
                                             40,000

                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>
                     </a>
                 </div>
             @endif
             @if (userDashboard(['usersUpgradeProduct', 'usersLaddelP', 'usersSendStory']))
                 <div class="col-xs-12 col-md-4 col-4 p-1">
                     <a href="{{ route('user.upgrade') }}" class="col-xl-3 col-md-6  mb-4">
                         <div class="card border-bottom-success shadow  py-2">
                             <div class="">
                                 <div class="row no-gutters align-items-center">
                                     <div class="col mr-2">
                                         <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <span style="font-size: 10px;">
                                              
                                            نردیان
                                             ،استوری،تبلیغ کالا
                                        </span>
                                            </div>
                                         <div class="h6 mb-0 font-weight-bold text-gray-800">
                                             
                                            
                                            40,000

                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>
                     </a>
                 </div>
             @endif
         </div>
        </div>
     @endif

    </div>




    <!-- Content Row -->
    {{-- 
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> لورم ایپسوم </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in text-right"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header"> لورم ایپسوم : </div>
                            <a class="dropdown-item" href="#"> لورم </a>
                            <a class="dropdown-item" href="#"> لورم ایپسوم </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> لورم ایپسوم متن ساختگی </a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> لورم ایپسوم </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in text-right"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header"> لورم ایپسوم : </div>
                            <a class="dropdown-item" href="#"> لورم </a>
                            <a class="dropdown-item" href="#"> لورم ایپسوم </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> لورم ایپسوم متن ساختگی </a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> پروژه ها </h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold"> HTML <span class="float-left">20%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">CSS <span class="float-left">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Bootstrap <span class="float-left">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">PHP <span class="float-left">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Laravel <span class="float-left">تمام!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <!-- Color System -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Success
                            <div class="text-white-50 small">#1cc88a</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Info
                            <div class="text-white-50 small">#36b9cc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Danger
                            <div class="text-white-50 small">#e74a3b</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Light
                            <div class="text-black-50 small">#f8f9fc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            Dark
                            <div class="text-white-50 small">#5a5c69</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">لورم ایپسوم</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-2 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="img/undraw_posting_photo.svg" alt="">
                    </div>
                    <p>
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی </p>

                </div>
            </div>

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> لورم ایپسوم </h6>
                </div>
                <div class="card-body">
                    <p>
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها
                        و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                    </p>
                    <p class="mb-0">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها
                        و متون بلکه روزنامه و مجله در ستون
                    </p>
                </div>
            </div>

        </div>
    </div> --}}


@endsection
