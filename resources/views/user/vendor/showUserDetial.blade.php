@extends('user.layouts.user')
@section('title')
    جزیات فروشگاه
@endsection





@section('content')
    <div class="col-12">




        {{ $user->name }}

        <hr>

        @if ($user->boss_id)
            کارمند
        @else
            مدیر
        @endif

        <a href="{{ route('admin.vendors.show', ['vendor' => $user->vendor]) }}">فروشگاه {{ $user->vendor->title }}</a>


        <hr>






        پرداخت های کاربر از طریق درگاه پرداخت


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


        پرداخت های کاربر از طریق کیف پول


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



        پرداخت های شارژ حساب کاربری


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


                                    موجودی کیف پول شما

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">


                                    {{ $user->CREDIT }}


                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
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

                            
                            
                                مجموع پرداخت های شما

                            
                            
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">




                                {{ $UserTotalFinalIncreaseCredit + $UserTotalFinal }}










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


    <div class="col-2">

        
        محصولات بارگذاری شده توسط شما

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
@endsection
