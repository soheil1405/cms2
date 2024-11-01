@extends('user.layouts.user')

@section('title')
    index products
@endsection

<style>
    .blur {
        background-color: rgba(0, 0, 0, 0.9);
        border-radius: 5px;
        font-family: sans-serif;
        text-align: center;
        -webkit-backdrop-filter: blur(25px);
        backdrop-filter: blur(25px);
        width: 80%;
        height: 80%;
        right: 13%;
        position: fixed;

        justify-content: center;
        color: #ffff;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        top: 10%;

    }


    .blur ul li span {
        color: red;
    }

    li {
        list-style-type: none;
    }

    .desc {
        padding: 30px;
        list-style-type: none;
    }

    .twice_ul {
        padding: 30px;
    }

    .desc {
        width: 100%;
        text-align: right;
    }

    .blur btn {
        width: 50px;
    }


    .Slider {}
</style>



@section('content')




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">


                    <form action="{{ route('user.payAfterSend') }}" id="form" method="post">

                        @csrf

                        <input type="hidden" name="linkBack" value="{{ Route::current()->getName() }}">
                        <input type="hidden" name="type" value="story">

                        <input type="hidden" name="typeId" id="typeee">
                        انتخاب شیوه پرداخت
                        :
                        <br>
                        <label for="0">پرداخت از کیف پول</label>
                        <input type="radio" checked name="payType" value="0" id="0">

                        <br>
                        <label for="1">پرداخت از طریق درگاه پرداخت</label>
                        <input type="radio" name="payType" value="1" id="1">

                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" onclick="$('#form').submit();" class="btn btn-primary">پرداخت</button>
                </div>
            </div>
        </div>
    </div>








    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row">


            @if (Session::has('sliderCreated'))
                <div class="alert alert-success">
                    {{ Session::get('sliderCreated') }}
                </div>
            @endif


            @if (Session::has('spcAdd'))
                <div class="alert alert-success">
                    {{ Session::get('spcAdd') }}
                </div>
            @endif



            <div class="col-xl-12 col-md-12 mb-4 pb-2 bg-white  store-history">
                <div class="d-xs-block d-md-none">

                    @if (Auth::user()->vendor->status == 'yes')
                        <div class="alert alert-success ">
                            فروشگاه شما فعال می باشد.
                        </div>
                    @else
                        @if (!is_null(Auth::user()->vendor->EditReportText))
                            {{ Auth::user()->vendor->EditReportText }}
                        @else
                            <div class="alert alert-warning your-store-dashbord">
                                فروشگاه شما در صف تایید کارشناسان می باشد
                            </div>
                        @endif
                    @endif

                    
                </div>
                <div class="d-xs-block d-md-none ">
                    @if (\App\Models\Admin\SiteSetting::first()->paymentStatus)
                        <div
                            @if (Auth::user()->CREDIT < 10000) class="alert alert-danger "
    
                  @else
                    class="alert alert-info " @endif>
                            {{-- @dd(Auth::user()->CREDIT); --}}
                            موجودی حساب شما : {{ Auth::user()->CREDIT }} تومان

                            <a class="btn btn-success" href="{{ route('user.orders.index') }}"> افزایش حساب +</a>

                        </div>
                    @endif
                </div>


                <h5 class="font-weight-bold mt-1 mb-3 ">تاریخچه تبلیغ فروشگاه ({{ count($specialVendors) }})</h5>



                <form action="{{ route('user.ladderVendor') }}" method="post">


                    @csrf
                    <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
                    <button name="ladder" class="btn d-inline-block btn-sm btn-danger" value="">
                        نردبان فروشگاه
                    </button>
                </form>





                <a href="{{ route('user.SpecialVendors.create') }}" class="btn btn-outline-success d-inline-block mt-2"
                    style="height:40px;">ارسال
                    فروشگاه به صفحه اول</a>


                <a href="{{ route('user.upgrade') }}" class="btn btn-outline-secondary d-inline-block mt-2"
                    style="height:40px;">بازگشت</a>




            </div>
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="table-responsive">

                <?php $dateNow = Carbon\Carbon::now(); ?>




                @if ($specialVendors)
                    <table class="table table-bordered table-striped text-center">



                        <thead>


                            <tr>

                                <th>تاریخ ثبت </th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>تعداد روز های باقی مانده</th>
                                <th>وضعیت</th>
                                {{-- <th>عملیات</th> --}}
                            </tr>

                        </thead>
                        <tbody>



                            @foreach ($specialVendors as $specialVendor)
                                <tr>



                                    <th>
                                        {{ \Morilog\Jalali\Jalalian::forge($specialVendor->created_at) }}


                                    </th>

                                    <th>
                                        {{ \Morilog\Jalali\Jalalian::forge($specialVendor->fromDate) }}

                                    </th>

                                    <th>

                                        {{ \Morilog\Jalali\Jalalian::forge($specialVendor->toDate) }}

                                    </th>

                                    @php
                                        
                                        $now = Carbon\Carbon::now();
                                    @endphp



                                    <th>
                                        @if ($specialVendor->fromDate <= $now && $now <= $specialVendor->toDate)
                                            {{ Carbon\Carbon::now()->diffInDays($specialVendor->toDate) }}

                                            روز باقی مانده
                                        @endif
                                    </th>


                                    <th>
                                        @if ($specialVendor->paymentStatus == 'inPaymentQueue')


                                        
                                        
                                            <span class="text-danger">پرداخت ناموفق</span>


                                        @elseif ($specialVendor->fromDate > $now && $specialVendor->toDate > $now)

                                                در صف انتشار
                                        @elseif($specialVendor->fromDate <= $now && $now <= $specialVendor->toDate)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                fill="green" class="bi bi-check2" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                            </svg>
                                        @elseif($specialVendor->fromDate < $now && $specialVendor->toDate < $now)
                                            پایان یافته در تاریخ {{ $specialVendor->to }}
                                        @else
                                            اشتباه در درج تاریخ
                                        @endif
                                    </th>


                                    {{-- <th>
                                       
                                       
                                        <form action="{{route('user.deleteSlider')}}"  method="post">
                                            
                                            @csrf
                                            
                                            <input type="hidden" name="id" value="{{$vendorSlider->id}}">
                                            <input type="submit" class="btn btn-danger" value="حذف">
                                            
                                        </form>
                                       
                                       
                                        <a href="{{ route('user.vendorSliedrEditPage' , ['id'=>$vendorSlider->id]) }}" class="btn btn-info">ویرایش</a>
                                    </th> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    شما اسلایدری برای فروشگاه خود ثبت نکرده اید
                @endif





            </div>

            <div class="d-flex justify-content-center mt-5">
                {{-- {{ $products->render() }} --}}
            </div>

        </div>
    </div>
@endsection
