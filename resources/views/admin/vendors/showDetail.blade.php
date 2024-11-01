@extends('admin.layouts.admin')

@section('title')
    جزیات فروشگاه
@endsection



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


@section('content')

    <h3>
        <img style="border-radius: 50%; width:50px; margin:15px; border:1px solid green;"
            src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $vendor->avatar) }}" class="storycircle">



        {{ $vendor->title }}




        (
        مدیر فروشگاه



        <a href="{{ route('admin.showUserDetail', ['id' => $vendor->user->id]) }}">
            {{ $vendor->user->name }}
        </a>)


    </h3>



    <div class="col-12">
        <form action="" method="get">
            <input type="submit" value="خروجی اکسل" name="ExcelExport" class="btn btn-success">
        </form>

        <hr>

        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    دنبال شوندگان


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ count($vendor->following) }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">

                                    دنبال کنندگان </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ count($vendor->followers) }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> تعداد بازدید کل
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ $vendor->view_count }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Pending Requests Card Example -->
            <a href="" {{-- href="{{ route('user.products.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1"> تعداد کازبران
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    {{ count($vendor->user->AllEmployers) }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1"> تاریخ آخرین ورود
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?php
                                    
                                    $datetime = \Morilog\Jalali\Jalalian::forge($vendor->last_login);
                                    
                                    echo $datetime;
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1">

                                    امتیاز فروشگاه </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    5 / {{ $vendor->rate_Ave }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    تعداد اسلایدر ها


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ count($vendor->mySliders) }}
                                    {{-- {!! myActiveSliders($vendor->id) !!} --}}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">

                                    تعداد استوری های فعال </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ count($vendor->activeStories) }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    تعداد
                                    محصولات ویژه
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ count($vendor->SpeciallProducts) }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Pending Requests Card Example -->
            <a href="" {{-- href="{{ route('user.products.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                    تعداد
                                    فروشگاه ویژه
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    {{ count($vendor->SpecialVendors) }}



                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1"> تعداد کالا های فعال
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    {{ count($vendor->products) }}



                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <a href="" {{-- href="{{ route('user.products.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1">


                                    تعداد مقالات باگذاری شده

                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    {{ count($vendor->articles) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>




















































        پرداخت های "کاربران" از طریق درگاه پرداخت


        <div class="col-12 d-flex " style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6  ">
                <div class="card border-right-primary shadow h-100 py-2 bg-info">
                    <div class="card-body ">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 ">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    مبلغ کل پرداخت شده

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $EmployeetotalFinalPays }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های امروز


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $EmployeelastDayOrdersFinalPays }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های این هفته


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $EmployeelastWeekOrdersFinalPays }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">


                                    پرداخت های این ماه

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $EmployeelastMonthOrdersFinalPays }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>


        </div>


        پرداخت های "کاربران" از طریق کیف پول


        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    مبلغ کل پرداخت شده

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">



                                    {{ $EmployeetotalFinalPaysParFromCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های امروز


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $EmployeelastDayOrdersFinalPaysParFromCredit }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های این هفته


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $EmployeelastWeekOrdersFinalPaysParFromCredit }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">


                                    پرداخت های این ماه

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $EmployeelastMonthOrdersFinalPaysParFromCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>



















































































































        </div>



        پرداخت های "کاربران" برای شارژ حساب کاربری


        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2 bg-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    مبلغ کل پرداخت شده

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ $EmployeetotalFinalIncreaseCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های امروز


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $EmployeelastDayOrdersFinalIncreaseCredit }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های این هفته


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $EmployeelastWeekOrdersFinalIncreaseCredit }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">


                                    پرداخت های این ماه

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $EmployeelastMonthOrdersFinalIncreaseCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>






        </div>




        پرداخت های "مدیر فروشگاه" از طریق درگاه پرداخت


        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    مبلغ کل پرداخت شده

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ $UserTotalFinal }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های امروز


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $UserLastDayOrdersFinal }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های این هفته


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $UserLastWeekOrdersFinal }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">


                                    پرداخت های این ماه

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $UserLastMonthOrdersFinal }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <!-- Earnings (Monthly) Card Example -->































        </div>


        پرداخت های "مدیر فروشگاه" از طریق کیف پول


        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    مبلغ کل پرداخت شده

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ $UserTotalFinalPayFromCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های امروز


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $UserLastDayOrdersFinalPayFromCredit }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های این هفته


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $UserLastWeekOrdersFinalPayFromCredit }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">


                                    پرداخت های این ماه

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $UserLastMonthOrdersFinalPayFromCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>



        پرداخت های "مدیر فروشگاه" برای شارژ حساب کاربری


        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">


                                    مبلغ کل پرداخت شده

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ $UserTotalFinalIncreaseCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های امروز


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $UserLastDayOrdersFinalIncreaseCredit }}

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a {{-- href="{{ route('user.follow.followings.index') }}" --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">



                                    پرداخت های این هفته


                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $UserLastWeekOrdersFinalIncreaseCredit }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Earnings (Monthly) Card Example -->
            <a {{-- href="{{ route('user.follow.followers.index') }}"  --}} class="col-xl-2 col-md-6 ">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">


                                    پرداخت های این ماه

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">

                                    {{ $UserLastMonthOrdersFinalIncreaseCredit }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>




        </div>

        وضعیت کیف پول

        <div class="col-12 d-flex" style="justify-content: center; padding:10px 0;">



            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6">
                <div class="card border-right-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">


                                    موجودی کیف پول کاربران

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ $usersCreditCount }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success  text-uppercase mb-1">

                                    موجودی کیف پول مدیر فروشگاه </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">




                                    {{ $vendor->user->CREDIT }}










                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="col-xl-6 col-md-6">
                <div class="card border-right-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success  text-uppercase mb-1">

                                    مجموع
                                    درامد این فروشگاه برای شما</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">




                                    {{ $UserTotalFinalIncreaseCredit + $UserTotalFinal + $EmployeetotalFinalIncreaseCredit + $EmployeetotalFinalPays }}










                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    <hr>
    <div class="row">
        <div class="col-4">

            <div class="col-12">

                <h5 class="card-title">آدرس :</h5>
                <p class="card-text">
                    {{ $vendor->address }}
                </p>
                <h5 class="card-title">توضیحات :</h5>
                <p class="card-text">
                    {{ $vendor->description }}
                </p>
                <h5 class="card-title">آدرس وبسایت :</h5>
                <div class="text-start">
                    <a href="https://www.{{ $vendor->site_url }}" role="button" target="_blank"
                        class="card-link btn btn-outline-primary">
                        {{ $vendor->site_url }}
                    </a>
                </div>

                <h5 class="card-title">شماره تلفن :</h5>
                <p class="card-text text-start">
                    {{ $vendor->phone_number }}
                </p>
                <h5 class="card-title">محصولات این فروشگاه :</h5>
                <div class="text-start">
                    <a href="{{ route('vendor.products.list', ['vendor' => $vendor->name]) }}" role="button"
                        class="card-link btn btn-outline-primary">
                        نمایش محصولات فروشگاه
                    </a>
                </div>


                @if ($vendor->socialMedias)
                    <h5 class="card-title"> شبکه های اجتماعی : </h5>


                    @if ($vendor->socialMedias->email != null)
                        <span>




                            {{ $vendor->socialMedias->email }}


                            <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-envelope-open-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.941.435a2 2 0 0 0-1.882 0l-6 3.2A2 2 0 0 0 0 5.4v.314l6.709 3.932L8 8.928l1.291.718L16 5.714V5.4a2 2 0 0 0-1.059-1.765l-6-3.2ZM16 6.873l-5.693 3.337L16 13.372v-6.5Zm-.059 7.611L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516ZM0 13.373l5.693-3.163L0 6.873v6.5Z" />
                                </svg></small>

                        </span>
                    @endif
                    @if ($vendor->socialMedias->aparat != null)
                        <a target="_blank" href="{{ $vendor->socialMedias->aparat }}" role="button"
                            class="card-link btn btn-outline-primary">
                            aparat
                        </a>
                    @endif
                    @if ($vendor->socialMedias->webdite != null)
                        <span>




                            website :
                            {{ $vendor->socialMedias->website }}



                        </span>
                    @endif


                    @if ($vendor->socialMedias->whatsapp != null)
                        <a target="_blank" href="{{ $vendor->socialMedias->whatsapp }}" role="button"
                            class="card-link btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg> </a>
                    @endif


                    @if ($vendor->socialMedias->telegram != null)
                        <a target="_blank" href="{{ $vendor->socialMedias->telegram }}" role="button"
                            class="card-link btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-telegram" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                            </svg> </a>
                    @endif

                    @if ($vendor->socialMedias->instagram != null)
                        <a target="_blank" href="{{ $vendor->socialMedias->instagram }}" role="button"
                            class="card-link btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-instagram" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                            </svg> </a>
                    @endif
                @endif
            </div>




        </div>



        <div class="col-2">

            کاربران فروشگاه

            @foreach ($vendor->user->AllEmployers as $item)
                <hr>

                <a href="{{ route('admin.showUserDetail', ['id' => $item->id]) }}"
                    @if ($item->status == '0') class="text-danger" @endif href="">
                    {{ $item->name }} - 0{{ $item->mobile }}
                </a>
            @endforeach

        </div>

        <div class="col-2">

            آخرین محصولات فروشگاه

            @foreach ($products as $product)
                <hr>
                @if ($product->acceptedbyAdmin != null && $product->status == 1 && $product->type == 'main')
                    <a href="">


                        {{ $product->name }}
                    </a>
                @else
                    <a href="" class="text-danger">

                        {{ $product->name }}
                    </a>
                @endif
            @endforeach

        </div>

    </div>
    <hr>


    <canvas id="myChart" style="max-width:100%;"></canvas>


    <hr>
    <canvas id="myChart2" style="max-width:100%;"></canvas>

    <hr>






    <script>
        var xValues = ["استوری ها",
            "اسلایدر ها",
            "نردبان فروشگاه",
            "نردبان محصول",
            "ارسال فروشگاه به صفحه اول",
            "ارسال محصول به صفحه اول"
        ];


        var yValues = [{{ $storiesSumAmount }},
            {{ $slidersSumAmount }},
            {{ $ladderVpaySumAmount }},
            {{ $ladderPpaySumAmount }},
            {{ $specialVendorSumAmount }},
            {{ $specialProductSumAmount }}
        ];




        var barColors = ["red", "green", "blue", "orange", "brown", "yellow"];



        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "مبلغ کل پرداخت ها" + {{ $finalSum }}
                }
            }
        });




        var xValues = ["استوری ها",
            "اسلایدر ها",
            "نردبان فروشگاه",
            "نردبان محصول",
            "ارسال فروشگاه به صفحه اول",
            "ارسال محصول به صفحه اول"
        ];



        var yValues = [{{ count($stories) }},
            {{ count($sliders) }},
            {{ count($ladderVPay) }},
            {{ count($ladderPpay) }},
            {{ count($specialVendor) }}, {{ count($specialProduct) }}
        ];





        var barColors = ["red", "green", "blue", "orange", "brown", "yellow"];

        new Chart("myChart2", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "تعداد کل فعالیت های انجام شده : " +
                        {{ count($stories) + count($sliders) + count($ladderVPay) + count($ladderPpay) + count($specialVendor) + count($specialProduct) }}
                },

                interaction: {
                    mode: 'index',
                    axis: 'y'
                },


            }

        });
    </script>
@endsection
