@extends('admin.layouts.admin')
<link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet" />

@section('title')
    اسلایدر ها
@endsection



<script>
    // $('#from').MdPersianDateTimePicker({
    //     targetTextSelector: `#from`,
    //     englishNumber: true,
    //     enableTimePicker: true,
    //     textFormat: 'yyyy-MM-dd HH:mm:ss',
    // });


    // $('#to').MdPersianDateTimePicker({
    //     targetTextSelector: `#to`,
    //     englishNumber: true,
    //     enableTimePicker: true,
    //     textFormat: 'yyyy-MM-dd HH:mm:ss',
    // });
</script>

@section('content')
    <!-- Modal: modalCart -->
    <div class="row">

        @if (Session::has('created'))
            <div class="alert alert-success">
                {{ Session::get('created') }}
            </div>
        @endif

        <div class="col-xl-12 col-md-12 mb-4 pb-2 ">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4 ">



                @if ($count_of_slider_in_Queue > 0)
                    <span class="text-danger">


                        {{ $count_of_slider_in_Queue }}

                        اسلایدر

                        در انتظار تایید

                    </span>
                @endif


                <h5 class="font-weight-bold mb-3 mb-md-0 my-1">لیست اسلایدر ها ({{ count($sliders) }})</h5>

                <a href="{{ route('admin.sliderss.create') }}" class="btn btn-info">ایجاد اسلایدر</a>



                <div class="">


                    تعداد کل اسلایدر های نمایش : {{ $HomeSlidersCount }}


                    <a href="{{ route('admin.settindDetail.EditHomeCounts') }}" class="btn btn-info mt-1 mb-1 mr-5">ویرایش تعداد اسلایدر
                        ها</a>


                </div>





                <form class="d-sm-flex">

                    <div class=" ml-3"> <label for="from">از تاریخ</label>
                        <input class="example1 " />
                        <input type="hidden" name="from" id="fromDate">



                    </div>


                    <div class=" ml-3">
                        <label>تا تاریخ</label>
                        <input type="hidden" name="to" id="toDate">
                        <input class="example2 " />


                    </div>

                    <div class="">

                        <label for="">نوع نمایش:</label>
                        <select name="showBy" id=""  style=" margin-left: 30px!important;">

                            <option @if (Request()->has('showBy') && Request('showBy') == 'all') selected @endif value="all">همه اسلایدر ها
                            </option>

                            <option @if (Request()->has('showBy') && Request('showBy') == 'actives') selected @endif value="actives">اسلایدر های فعال
                            </option>

                            <option @if (Request()->has('showBy') && Request('showBy') == 'inQueue') selected @endif value="inQueue">اسلایدر های در صف
                                انتشار</option>

                            <option @if (Request()->has('showBy') && Request('showBy') == 'Ended') selected @endif value="Ended">اسلایدر های پایان
                                یافته</option>
                            <option @if (Request()->has('showBy') && Request('showBy') == 'Repored') selected @endif value="Repored">اسلایدر های رد
                                شده</option>
                        </select>
                    </div>


                    <input type="submit" class="btn btn-info mt-1" value="جستجو">
                    @if (Request()->has('from'))
                        <a href="{{ route('admin.sliderss.index') }}" class="btn btn-danger">حذف فیلتر ها</a>
                    @endif



                </form>


                <form action="" method="get">


                    <input type="hidden" name="excelExport" value="1">
            
                    <input type="submit" value="خروجی اکسل" class="btn btn-success">
            
            
                </form>
            </div>
            <?php $dateNow = Carbon\Carbon::now(); ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">



                    <thead>


                        <tr>



                            <th>نوع اسلایدر</th>
                            <th>ساخته شده توسط</th>
                            <th>
                                عکس اسلایدر
                            </th>
                            <th>تاریخ ثبت </th>
                            <th>تاریخ انتشار</th>
                            <th>تاریخ پایان</th>
                            <th>وضعیت</th>

                            <th>تعداد روز های باقی مانده</th>

                            {{-- <th>تعداد کلیک</th> --}}
                            <th>عملیات</th>
                        </tr>

                    </thead>
                    <tbody>



                        @foreach ($sliders as $vendorSlider)
                            <tr>



                                <th>
                                    @if ($vendorSlider->product_id)
                                        <a
                                            href="{{ route('products.show', ['vendor' => $vendorSlider->vendorName, 'product' => $vendorSlider->product_slug]) }}">


                                            محصول {{ $vendorSlider->product_slug }}

                                        </a>
                                    @elseif($vendorSlider->vendorName)
                                        <a href="{{ route('vendor.home', ['vendor' => $vendorSlider->vendorName]) }}">


                                            فروشگاه {{ $vendorSlider->vendorName }}
                                        </a>
                                    @endif

                                </th>


                                <th>
                                    @if ($vendorSlider->sendBy != 'vendor')
                                        Admin
                                    @else
                                        قروشگاه
                                    @endif
                                </th>


                                <th>
                                    <img src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $vendorSlider->image) }}"
                                        style="width:100px; height:70px;" alt="">
                                </th>

                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($vendorSlider->created_at) }}


                                </th>

                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($vendorSlider->from) }}

                                </th>

                                <th>

                                    {{ \Morilog\Jalali\Jalalian::forge($vendorSlider->to) }}

                                </th>

                                <th>


                                    @if (is_null($vendorSlider->acceptedbyAdmin))
                                        @if ($vendorSlider->paymentStatus == 'inPaymentQueue')
                                            در انتظار پرداخت
                                        @else
                                            پرداخت شده - در انتظار تایید
                                        @endif
                                    @elseif ($vendorSlider->from > $dateNow && $vendorSlider->to > $dateNow)
                                        در صف انتشار
                                    @elseif($vendorSlider->from <= $dateNow && $vendorSlider->to >= $dateNow)
                                     


                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green"
                                            class="bi bi-check2" viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    @elseif($vendorSlider->from < $dateNow && $vendorSlider->to < $dateNow)
                                        پایان یافته در تاریخ {{ $vendorSlider->to }}
                                    @else
                                        اشتباه در درج تاریخ
                                    @endif





                                    @if ($vendorSlider->status == 0)
                                        <span class="text-danger">رد شده /</span>
                                    @endif









                                </th>

                                <th>


                                    @if ($vendorSlider->from <= $dateNow && $dateNow <= $vendorSlider->to)
                                        {{ Carbon\Carbon::now()->diffInDays($vendorSlider->to) }}

                                        روز باقی مانده
                                    @endif
                                </th>

                                <th>
                                    <a class="btn btn-info"
                                        href="{{ route('admin.sliderss.edit', ['id' => $vendorSlider->id]) }}">ویرایش</a>
                                    @if (is_null($vendorSlider->acceptedbyAdmin) || $vendorSlider->status == 0  AND $vendorSlider->payStatus != 'inPaymentQueue' )
                                        <form action="{{ route('admin.sliderss.accept') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $vendorSlider->id }}">
                                            <input type="submit"class="btn btn-success" value="تایید">

                                        </form>
                                    @else
                                        @if ($vendorSlider->sendBy == 'vendor')
                                            <a  href="{{ route('admin.sliderss.report', ['id' => $vendorSlider->id]) }}"
                                                class="btn btn-primary ">ریپورت</a>
                                        @endif
                                    @endif




                                    <form action="{{ route('admin.sliderss.destroy') }}" method="post">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $vendorSlider->id }}">
                                        <input type="submit"class="btn btn-danger" value="حذف">

                                    </form>





                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection


<script>
    function acceptProductRequest() {


        $('#acceptProductRequest').submit();

    }


    function pId(id) {

        console.log(id);

        $('#product_id').val(id);

    }


    function AdProduct() {


        if (('#to') != "null") {
            $('#AdProductForm').submit();
        } else {
            alert('لطفا تاریخ پایان را  وارد کنید');
        }

    }
</script>




<style>
    table {
        font-size: 13px !important;
    }
</style>

@section('script2')
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('main/datepicker/persiandate.js') }}"></script>
    <script src="{{ asset('main/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".example1").pDatepicker({
                autoClose: true,
                onSelect: function(unix) {
                    // console.log('datepicker select : ' + unix);
                    var day = new persianDate(unix).toDate();
                    // console.log('day :' + day);



                    var standard = new Date(day).toISOString();


                    $('#fromDate').val(standard);


                }
            });

            $(".example2").pDatepicker({
                autoClose: true,
                onSelect: function(unix) {
                    // console.log('datepicker select : ' + unix);
                    var day = new persianDate(unix).toDate();
                    // console.log('day :' + day);
                    var standard = new Date(day).toISOString();


                    $('#toDate').val(standard);
                }
            });



        });
    </script>
@endsection
