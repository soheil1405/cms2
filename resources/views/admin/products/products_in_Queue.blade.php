@extends('admin.layouts.admin')
{{-- <link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet" /> --}}


@section('title')
    index products
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





    function deleteGroup() {
        var ids = [];

        $('input[name="ids[]"]:checked').each(function() {

            ids.push(this.value)
        });


        $('#Pids').val(ids);

        if (window.confirm('ایا از حذف موارد انتخاب شده اطمینان دارید؟')) {
            $('#groupFormDelete').submit();
        }


    }
</script>

@section('content')
    <!-- Content Row -->
    <!-- Button trigger modal-->

    <!-- Modal: modalCart -->

    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--Header-->
                <div id="CanAdd">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">ارسال محصول به قسمت ویژه</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">


                        <form id="AdProductForm" action="{{ route('admin.MakeProductSpecial') }}" method="post">
                            @csrf

                            <input type="hidden" name="product_id" id="product_id">
                            <div class=""> <label for="from">از تاریخ</label>
                                <input class="example1 " />
                                <input type="hidden" name="from" id="fromDate">



                            </div>


                            <div class="">
                                <label>تا تاریخ</label>
                                <input type="hidden" name="to" id="toDate">
                                <input class="example2 " />


                            </div>

                            {{-- <label> تاریخ شروع </label>
                            <div class="input-group">
                                <div class="input-group-prepend order-2">
                                    <span class="input-group-text" id="">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="#from" name="" value="">
                            </div>
                            <label> تاریخ پایان </label>

                            <div class="input-group">
                                <div class="input-group-prepend order-2">
                                    <span class="input-group-text" id="">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                </div>

                                <input type="text" class="form-control" id="#to" name="" value="">
                            </div> --}}

                            {{-- <div class="">


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
    </div>
    <!-- Modal: modalCart -->
    <div class="row">


        @if (Session::has('success'))
            <div class="alert alert-info">


                {{ Session::get('success') }}

            </div>
        @endif

        <div class="col-xl-12 col-md-12 mb-4 bg-white">



            <div class="row justify-content-between">

                @if ($count_of_products_in_Queue > 0)
                    <a href="{{ route('admin.products_in_Queue') }}" class="text-danger">


                        {{ $count_of_products_in_Queue }}

                        محصول

                        در انتظار تایید

                    </a>
                @endif







            </div>

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                بازگشت
            </a>

            <div class="">

                <span class="btn btn-danger"style="float:left;" id="showDeleteFormBt"
                    onclick="$('.ids').css('display' , 'block'); $('#showDeleteFormBt').css('display' , 'none'); $('#groupFormDelete').css('display' , 'block'); ">
                    حذف گروهی </span>


                <form action="{{ route('admin.products.deleteByGroup') }}" style="display: none; float:left;"
                    id="groupFormDelete" method="post">

                    @csrf

                    <input value="حذف" onclick="deleteGroup()" class="btn btn-danger">

                    <input type="hidden" name="pIds" id="Pids">

                    <span class="btn btn-success"style="float:left;"
                        onclick="$('.ids').css('display' , 'none');  $('#showDeleteFormBt').css('display' , 'block'); $('#groupFormDelete').css('display' , 'none');">
                        لغو </span>

                </form>

            </div>

            <div class="table-responsive pb-5">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عملیات</th>
                            <th> نام محصول</th>
                            <th>نام فروشگاه</th>
                            <th>نام برند</th>
                            <th>نام دسته بندی</th>
                            <th>تعداد بازدید</th>
                            <th>تاریخ ثبت</th>
                            <th>آخرین ویرایش</th>
                            <th> عکس</th>
                            <th>گارانتی</th>
                            <th>وضعیت</th>
                            <th>
                                پین
                            </th>
                        </tr>
                    </thead>
                    <tbody>






                        @foreach ($products_in_Queue as $key => $product)
                            <tr>
                                <th>
                                    <input type="checkbox" style="display:none;" name="ids[]" value="{{ $product->id }}"
                                        class="ids">

                                    {{ $product->id }}
                                    {{-- {{ $products->firstItem() + $key }} --}}
                                </th>
                                <th>


                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            عملیات
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-content text-center">



                                                {{-- <a href="{{ route('admin.productEditList', ['id' => $product->id]) }}">
                                                <small class="">لیست تغییرات</small>
    
                                            </a>
                                                            --}}

                                                @if ($product->brand->vendor_id && $product->brand->is_active != 'فعال')
                                                    <!-- Button trigger modal -->
                                                    <button type="button" onclick="newBrandModal({{ $product->brand }})"
                                                        class="border-bottom p-2 w-100 d-block text-success"
                                                        data-toggle="modal" data-target="#newBrandModalModal">

                                                        تایید

                                                    </button>
                                                @else
                                                    <form id="acceptProductRequest" class="m-0"
                                                        action="{{ route('admin.acceptProduct') }}" method="post">
                                                        @csrf
                                                        <button type="submit"
                                                            class="border-bottom p-2 w-100 d-block text-success"
                                                            style="margin: 0 !important;" for="id"> تایید
                                                        </button>
                                                        <input type="hidden" value="{{ $product->id }}" id="acceptVendor"
                                                            name="id">

                                                    </form>
                                                @endif



                                                <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                                    class="border-bottom p-2 w-100 d-block text-black">

                                                    ویرایش
                                                </a>


                                                <a class="border-bottom p-2 w-100 d-block text-black"
                                                    href="{{ route('admin.sendMessage.edit', ['sendMessage' => $product->id]) }}">
                                                    ریپورت </a>


                                                <form class="m-0" action="{{ route('admin.deleteProduct') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name='id' value="{{ $product->id }}">

                                                    <button type="submit" class="  p-2 w-100 d-block text-danger">

                                                        حذف
                                                    </button>
                                                </form>




                                            </div>

                                            {{-- <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                            class=" btn btn-sm btn-outline-primary"> نمایش </a>
                                             --}}



                                        </div>
                                    </div>

                                </th>






                                <th>
                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                        {{ $product->name }}
                                    </a>
                                </th>

                                <th>
                                    <a href="{{ route('vendor.home', ['vendor' => $product->vendor->name]) }}">
                                        {{ $product->vendor->title }}

                                        @if ($product->vendor->status == 'new')
                                            <span class="text-danger">
                                                (فروشگاه جدید)
                                            </span>
                                        @endif

                                    </a>

                                </th>


                                <th>




                                    @if ($product->brand->vendor_id && $product->brand->is_active != 'فعال')
                                        <a class="text-danger"
                                            href="{{ route('admin.brands.show', ['brand' => $product->brand->id]) }}">

                                            (برند چدید)

                                            {{ $product->brand->name }}
                                        </a>
                                    @else
                                        <a href="{{ route('admin.brands.show', ['brand' => $product->brand->id]) }}">
                                            {{ $product->brand->name }}
                                        </a>
                                    @endif
                                </th>
                                <th>

                                    <a
                                        href="{{ route('categories.show', ['category' => $product->category->parent->slug]) }}">
                                        {{ $product->category->name }}

                                    </a>
                                </th>


                                <th>
                                    {{ $product->view_counter }}
                                </th>

                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($product->created_at) }}
                                </th>
                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($product->updated_at) }}
                                </th>



                                <th>


                                    <img style="max-width: 50px;" class="card-img-top"
                                        src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                        alt="{{ $product->name }}">

                                </th>




                                <th>
                                    @if ($product->Warranty != null)
                                        <span class="text-success"> {{ $product->Warranty }} </span>
                                    @else
                                        <span> ندارد </span>
                                    @endif
                                </th>


                                <th>
                                    @if ($product->status == 'edited')
                                        <span class="text-danger">
                                            ویرایش شده</span>
                                    @elseif($product->status == 'new')
                                        <span class="text-danger">
                                            محصول جدید
                                        </span>
                                    @endif




                                </th>


                                <th>

                                </th>


                            </tr>
                        @endforeach






                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection


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


                    $('#fromDate').val(standard);
                }
            });









        });
    </script>
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

{{-- <script src="{{ asset('jquery/jquery.min.js') }}"></script> --}}
{{-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> --}}
{{-- <script src="{{asset(main/datepicker/datepicker.css)}}"></script> --}}





<style>
    table {
        font-size: 13px !important;
    }
</style>
