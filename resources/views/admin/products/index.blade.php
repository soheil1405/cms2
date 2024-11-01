@extends('admin.layouts.admin')

{{--
<link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet" /> --}}


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



    function newBrandModal(brand) {


        $('#NewBname').text(brand.name);

        $('#hiddBName').val(brand.id);




    }



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

        @foreach ($errors->all() as $item)
                <div class="alert alert-danger">
                    {{ $item }}
                </div>
            @endforeach

            

        @if (Session::has('success'))
            <div class="alert alert-info">


                {{ Session::get('success') }}

            </div>
        @endif

        @if (Session::has('fail'))
            <div class="alert alert-danger">


                {{ Session::get('fail') }}

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


                <h5 class="font-weight-bold mb-3 mt-1">لیست محصولات  ({{ count($products) }})</h5>




                <form action="" method="get">

                    <input type="hidden" name="excelExport" value="1">

                    <input type="submit" value="خروجی اکسل" class="btn btn-success">


                </form>
            </div>

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
            <form action="" method="get" id="orderByForm">
                مرتب سازی بر اساس
                @if (request()->has('OrderBy'))
                    {{ request('OrderBy') }}
                @endif
                <select name="OrderBy" onchange="$('#orderByForm').submit();" id="">
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'status') @checked(true) @endif value="status">تایید نشده
                        ها</option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'name') @checked(true) @endif value="name">نام مجصولات
                    </option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'view_counter') @checked(true) @endif value="view_counter">تعداد
                        بازدید</option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'created_at') @checked(true) @endif value="created_at">تاریخ
                        ایحاد </option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'updated_at') @checked(true) @endif value="updated_at"> تاریخ
                        ویرایش </option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'rate_Ave') @checked(true) @endif value="rate_Ave">امتیاز
                        محصول </option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'pin_number') @checked(true) @endif value="pin_number">
                        مجصولات پین شده </option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'product_price asc') @checked(true) @endif
                        value="product_price asc"> ارزان ترین ها </option>
                    <option @if (request()->has('OrderBy') && request('OrderBy') == 'product_price desc') @checked(true) @endif
                        value="product_price desc"> گران ترین ها </option>


                </select>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="newBrandModalModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">

                            کاربر برای ایجاد این محصول برند جدیدی تحت عنوان


                            <span id="NewBname"></span>

                            اضافه کرده است و شما باید ابتدا ان برند را تایید کنید

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <a id="newBLink" class="text-danger" href="{{ route('admin.brands.index') }}"> مشاهده برند
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="table-responsive" style="overflow-y: hidden;
            ">
                <table id="example" class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th></th>
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
                            <th>قیمت</th>
                            <th>وضعیت</th>
                            <th>
                                پین
                            </th>
                        </tr>
                    </thead>
                    <tbody>




                        @foreach ($products as $key => $product)
                            <tr>

                                <th>
                                    <input type="checkbox" style="display:none;" name="ids[]"
                                        value="{{ $product->id }}" class="ids">

                                    {{ $product->id }}

                                </th>

                                <th>


                                    @if ($product->status != 'edited' && $product->status != 'new' && $product->status != 'reported'&& $product->status != 'reported-edited')
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                عملیات
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <div class="dropdown-content text-center">

                                                    <a class="border-bottom p-2 text-black d-block"
                                                        href="{{ route('admin.sendMessage.edit', ['sendMessage' => $product->id]) }}">
                                                        ریپورت</a>

                                                    <button class="border-bottom p-2 text-black" type="button"
                                                        onclick="pId({{ $product->id }})" data-toggle="modal"
                                                        data-target="#modalCart"> تبلیغ 
                                                    </button>
                                                    <a class="border-bottom p-2 text-black d-block"
                                                        href="{{ route('admin.stories.create') }}" alt='story'>

                                                        استوری
                                                    </a>

                                                    <form action="{{ route('admin.products.ladder') }}" class="m-0"
                                                        method="post">


                                                        @csrf
                                                        <input type="hidden" name="product"
                                                            value="{{ $product->id }}">



                                                        <button type="submit"
                                                            class="border-bottom p-2 w-100 text-black d-block text-center"
                                                            name="ladder" value="">

                                                            نردبان
                                                        </button>

                                                    </form>


                                                    <a class="border-bottom p-2 text-black d-block"
                                                        href="{{ route('admin.products.edit', ['product' => $product->id]) }}">

                                                        ویرایش
                                                    </a>



                                                    <form action="{{ route('admin.deleteProduct') }}" class="m-0"
                                                        method="post" id="deleteForm_{{ $product->id }}">
                                                        @csrf
                                                        <input type="hidden" name='id'
                                                            value="{{ $product->id }}">

                                                        <span onclick="deleteProduct({{ $product->id }})"
                                                            class=" p-2  d-block text-danger border-bottom ">

                                                            حذف
                                                        </span>
                                                    </form>

                                                    <a class=" p-2  d-block"
                                                        href="{{ route('admin.products.show', ['product' => $product->id]) }}">
                                                        نمایش </a>



                                                </div>
                                            </div>
                                        </div>
                                    @else
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


                                                        @if (is_null($product->brand))
                                                            @dd($product)
                                                        @endif
                                                    @if ($product->brand->vendor_id && $product->brand->is_active != 'فعال')
                                                        <!-- Button trigger modal -->
                                                        <button type="button"
                                                            onclick="newBrandModal({{ $product->brand }})"
                                                            class="border-bottom text-success p-2 d-block w-100 "
                                                            data-toggle="modal" data-target="#newBrandModalModal">

                                                            تایید محصول

                                                        </button>
                                                    @else
                                                        <form id="acceptProductRequest" class="m-0"
                                                            action="{{ route('admin.acceptProduct') }}" method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="border-bottom p-2 text-success d-block w-100"
                                                                style="margin: 0 !important;" for="id"> تایید
                                                            </button>
                                                            <input type="hidden" value="{{ $product->id }}"
                                                                id="acceptVendor" name="id">

                                                        </form>
                                                    @endif



                                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                                        class="border-bottom p-2 d-block w-100 text-black m-0">

                                                        ویرایش
                                                    </a>

                                                    @if ($product->status != "reported")
                                                        
                                                    <a class="border-bottom p-2 d-block w-100 text-black"
                                                    href="{{ route('admin.sendMessage.edit', ['sendMessage' => $product->id]) }}">
                                                    ریپورت </a>
                                                    
                                                    @endif


                                                    <form action="{{ route('admin.deleteProduct') }}" method="post"
                                                        class="m-0" id="deleteForm_{{ $product->id }}">
                                                        @csrf
                                                        <input type="hidden" name='id'
                                                            value="{{ $product->id }}">

                                                        <span onclick="deleteProduct({{ $product->id }})"
                                                            class=" text-danger p-2 d-block w-100 ">

                                                            حذف
                                                        </span>
                                                    </form>



                                                </div>

                                                {{-- <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                        class=" btn btn-sm btn-outline-primary"> نمایش </a>
                                         --}}



                                            </div>
                                        </div>
                                    @endif

                                </th>




                                <th>
                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                        {{ $product->name }}
                                    </a>
                                </th>

                                <th>
                                    <a href="{{ route('vendor.home', ['vendor' => $product->vendor->name]) }}">
                                        {{ $product->vendor->title }}
                                    </a>
                                </th>


                                <th>
                                    <a href="{{ route('admin.brands.show', ['brand' => $product->brand->id]) }}" <span
                                        class="{{ $product->brand->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">

                                        {{ $product->brand->name }}

                                        </span>
                                    </a>

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
                                    @if ($product->product_price)
                                        {{ $product->product_price }}
                                    @else
                                        -
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
                                    @elseif($product->status == 'reported')
                                        <span class="text-danger">
                                            ریپورت شده
                                        </span>
                                    @elseif($product->status == 'reported-edited')
                                        <span class="text-danger">
                                            ریپورت شده -در انتظار تایید تغییرات جدید
                                        
                                        </span>
                                    @else           
                                    <span class="text-success">
                                        تایید شده   
                                    </span>
                                    @endif


                                </th>


                                <th>


                                    <form action="{{ route('admin.pin') }}" method="post">

                                        @csrf
                                        <div class="d-flex">


                                            <input type="hidden" name="type" value="product">
                                            <input type="hidden" name="id" value="{{ $product->id }}">

                                            <input type="number" name="pin_number" id="" style="width: 32px;"
                                                value="{{ $product->pin_number }}">
                                            <input type="submit" class="btn btn-secondary" style="width: 32px;"
                                                value="پین">
                                        </div>

                                    </form>

                                </th>





                            </tr>
                        @endforeach





                        {{--  @foreach ($reported as $key => $product)
                            <tr>


                                <th>

                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            عملیات
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-content">
                                                <a
                                                    href="{{ route('admin.sendMessage.edit', ['sendMessage' => $product->id]) }}">
                                                    ریپورت</a>

                                                <button type="button" onclick="pId({{ $product->id }})"
                                                    data-toggle="modal" data-target="#modalCart"> ارسال به صفحه اول
                                                </button>
                                                <a href="{{ route('admin.stories.create') }}" alt='story'>

                                                    استوری
                                                </a>

                                                <form action="{{ route('admin.products.ladder') }}" method="post">


                                                    @csrf
                                                    <input type="hidden" name="product" value="{{ $product->id }}">



                                                    <button type="submit" name="ladder" value="">

                                                        نردبان
                                                    </button>

                                                </form>


                                                <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">

                                                    ویرایش
                                                </a>



                                                <form action="{{ route('admin.deleteProduct') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name='id' value="{{ $product->id }}">

                                                    <button type="submit" class=" p-1 btn btn-sm ">

                                                        حذف
                                                    </button>
                                                </form>

                                                <a href="{{ route('admin.products.show', ['product' => $product->id]) }}">
                                                    نمایش </a>



                                            </div>
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
                                        {{ $product->vendor->name }}
                                    </a>
                                </th>


                                <th>
                                    <a href="{{ route('admin.brands.show', ['brand' => $product->brand->id]) }}">
                                        {{ $product->brand->name }}
                                    </a>
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
                                    @if ($product->status == 'reported')
                                        <span class="text-danger">
                                            ریپورت شده
                                        </span>
                                    @endif
                                </th>





                            </tr>
                        @endforeach  --}}



                    </tbody>
                </table>
            </div>

            {{--  <div class="d-flex justify-content-center mt-5">
            {{ $products->render() }}
        </div>  --}}
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


                    $('#toDate').val(standard);
                }
            });









        });




        function deleteProduct(id) {
            if (window.confirm('آیا از حذف محصول اطمینان دارید؟')) {
                $("#deleteForm_" + id).submit();
            }
        }
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
