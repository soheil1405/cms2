@extends('admin.layouts.admin')
<link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet" />

@section('title')
    Special products
@endsection

@section('content')
    <!-- Content Row -->
    <!-- Button trigger modal-->

    <!-- Modal: modalCart -->
    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header"> ویرایش محصول ویژه </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">


                    <form id="AdProductForm" action="{{ route('admin.EditProductSpecial') }}" method="post">
                        @csrf

                        <input type="hidden" name="product_id" id="product_id">
                        <div class=" d-xs-block"> <label for="from">از تاریخ</label>
                            <input type="date" id="from" name="from" class="range-from-example">
                        </div>


                        <div class="d-xs-block">
                            <label for="to">تا تاریخ</label>
                            <input type="date" id="to" name="to" class="range-to-example" required>

                        </div>


                        {{-- 
                        <div class="">


                            <div class=""> <label for="">شماره جایگاه</label>
                                <small>(عدد مورد نظر باید بین 1 تا 12 باشد)</small>
                            </div>
                            <input type="number" min="1" max="12" name="position">
                        </div> --}}


                    </form>

                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">لغو</button>
                    <button onclick="AdProduct()" class="btn btn-success">تایید</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal: modalCart -->
    <div class="row">

        <h5 class="font-weight-bold mb-3 mb-md-0">لیست فروشگاه های ویژه </h5>


        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">





                <div class="mb-2 d-block d-sm-inline-block">


                    تعداد کل فروشگاه های ویژه قابل نمایش : {{ $SpecialVCount }}


                    <a href="{{ route('admin.settindDetail.EditHomeCounts') }}" class="btn btn-info">
                        ویرایش تعداد</a>

                </div>



                <form class="d-sm-flex">

                    <div class="text-box-history"> <label for="from">از تاریخ</label>
                        <input class="example1 " />
                        <input type="hidden" name="from" id="fromDate">



                    </div>


                    <div class="">
                        <label>تا تاریخ</label>
                        <input type="hidden" name="to" id="toDate">
                        <input class="example2 " />


                    </div>

                    <div class="">

                        <label for="">نوع نمایش:</label>
                        <select name="showBy" id="" style=" width: 190px!important;  margin-left: 27px!important;">

                            <option @if (Request()->has('showBy') && Request('showBy') == 'all') selected @endif value="all">همه فروشگاه های ویژه
                            </option>

                            <option @if (Request()->has('showBy') && Request('showBy') == 'actives') selected @endif value="actives">فروشگاه های ویژه فعال
                            </option>

                            <option @if (Request()->has('showBy') && Request('showBy') == 'inQueue') selected @endif value="inQueue">فروشگاه های ویژه در صف
                                انتشار</option>

                            <option @if (Request()->has('showBy') && Request('showBy') == 'Ended') selected @endif value="Ended">فروشگاه های ویژه پایان
                                یافته</option>
                        </select>
                    </div>


                    <input type="submit" class="btn btn-info" value="جستجو">
                    @if (Request()->has('from'))
                        <a href="{{ route('admin.AllSpecialVendors') }}" class="btn btn-danger">حذف فیلتر ها</a>
                    @endif

                    <input type="submit" name="excelExport" value="دانلود excel" class="btn btn-success">



                </form>


            </div>

            @if (Session::has('deleted'))
                <div class="alert alert-danger">
                    {{ Session::get('deleted') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>

                            <th> نام فروشگاه</th>
                            <th>تاریخ شروع</th>
                            <th>آخرین پایان</th>
                            <th>تعداد روز های باقی مانده</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($speciallVendors as $key => $item)
                            <tr>



                                <th>
                                    <a href="{{ route('vendor.home', ['vendor' => $item->vendor->name]) }}">
                                        {{ $item->vendor->name }}
                                    </a>
                                </th>


                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($item->fromDate) }}
                                
                                    {{-- <label for="from">از تاریخ</label>
                                    <input type="date" id="from" name="from" class="range-to-example" required>
                                

                                 <input class="example1 " />
                                 <input type="hidden" name="from" id="fromDate">
      --}}
                                </th>
                                <th>

                                    
                                    {{ \Morilog\Jalali\Jalalian::forge($item->toDate) }}

                                    
                                    <span class="btn btn-primary"  onclick="$('.allItemsTo').css('display' , 'none');  $('.itemTo_{{$item->id}}').css('display' , 'block');    $('.editBt').css('display' , 'none');  $('.editItem_{{$item->id}}').css('display' , 'block');   "   > تغییر تاریخ </span>

                                    
                                    <form action="{{route('admin.EditSpecialVendor')}}" method="post" >
                                        @csrf
                                         <input type="hidden" name='id' value="{{$item->id}}">

                                        <input    type="hidden" name="to"   class="toDateEdit"   id="to">
                                        <input style="display: none;"   class="example3  allItemsTo   itemTo_{{$item->id}} " />
            
                                        <button type="submit" style="display: none;" class=" btn  btn-info editBt editItem_{{$item->id}}  ">
                                            ویرایش
                                        </button>
                                    </form>
                                </th>
                                @php
                                    
                                    $now = Carbon\Carbon::now();
                                @endphp



                                <th>
                                    @if ($item->fromDate <= $now && $now <= $item->toDate)
                                        {{ Carbon\Carbon::now()->diffInDays($item->toDate) }}

                                        روز باقی مانده
                                    @endif
                                </th>


                                <th>



                                    @if ($item->fromDate > $now && $item->toDate > $now)
                                        در صف انتشار
                                    @elseif($item->fromDate <= $now && $now <= $item->toDate)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green"
                                            class="bi bi-check2" viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    @elseif($item->fromDate < $now && $item->toDate < $now)
                                        پایان یافته در تاریخ {{ $item->to }}
                                    @else
                                        اشتباه در درج تاریخ
                                    @endif
                                </th>

                                <th>
                                    <div style="display: flex;" class="">

                                        <form action="{{ route('admin.deleteFromSpecialVendors') }}" method="post">
                                            @csrf
                                            <input type="hidden" name='id' value="{{ $item->id }}">

                                            <button type="submit" class=" btn  btn-danger mr-2">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </th>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{-- {{ $speciallProducts->render() }} --}}
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




            $(".example3").pDatepicker({
                autoClose: true,
                onSelect: function(unix) {
                    // console.log('datepicker select : ' + unix);
                    var day = new persianDate(unix).toDate();
                    // console.log('day :' + day);
                    var standard = new Date(day).toISOString();


                    $('.toDateEdit').val(standard);
                }
            });








        });
    </script>
@endsection
