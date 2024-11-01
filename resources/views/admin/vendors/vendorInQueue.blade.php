@extends('admin.layouts.admin')

<style>
    .dropbtn {
        background: #d00c0c;
        color: white;
        padding: 15px 20px;
        font-size: 14px;
        font-weight: 400;
        border: none;
        cursor: pointer;
    }

    .dropbtn:after {
        content: "v";
        /* padding-left: 10px; */
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        z-index: 10000;
        background: #f9f9f9;
        min-width: 160px;
        margin-top: -50px;
        margin-left: 70px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 6px 10px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background: #f1f1f1;
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background: #c0392b;
    }



    .table::-webkit-scrollbar {
        display: none;
    }
</style>
@section('title')
    index vendors
@endsection


@section('content')
    <!-- Modal: modalCart -->
    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--Header-->
                <div id="CanAdd">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">ارسال فروشگاه به قسمت ویژه</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">


                        <form id="AdVendorForm" action="{{ route('admin.MakeVendorSpecial') }}" method="post">
                            @csrf

                            <input type="hidden" name="vendor_id" id="vendor_id">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class=""> <label for="from">از تاریخ</label>
                                <input class="example1 " />
                                <input type="hidden" name="from" id="fromDate">



                            </div>


                            <div class="">
                                <label>تا تاریخ</label>
                                <input type="hidden" name="to" id="to">
                                <input class="example2 " />


                            </div>


                        </form>

                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">لغو</button>
                        <button onclick="AdVendor()" class="btn btn-success">تایید</button>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Modal: modalCart -->


    @if (Session::has('spcAdd'))
        <div class="alert alert-success">
            {{ Session::get('spcAdd') }}
        </div>
    @endif


    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                @if (count($vendorsInQueue) > 0)
                    <a href="{{ route('admin.vendorsInQueue') }}" class="text-danger">{{ count($vendorsInQueue) }} فروشگاه
                        در انتظار تایید می باشد </a>
                @endif








                <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">
                    بازگشت
                </a>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="alert-text">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-info">
                    <a class=" btn btn-danger close" data-dismiss="alert">×</a>
                    {!! Session::get('success') !!}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif


            <div class="table-responsive" style="min-height: 50vh;">

                <table class="table table-bordered  text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عملیات</th>
                            <th>نام فروشگاه </th>
                            {{-- <th> مدیر فروشگاه </th> --}}
                            <th>شماره موبایل</th>
                            {{-- <th>دسته فعالیت </th> --}}
                            <th> تعداد کالا </th>
                            <th> تعداد استوری ها </th>
                            <th> تعداد اسلایدرها </th>
                            <th> تعداد محصولات ویژه </th>
                            <th> تعداد فروشگاه های ویژه </th>
                            <th> تعداد نردبان فروشگاه </th>
                            <th> تعداد نردبان محصولات </th>

                            <th>تاریخ ثبت </th>
                            <th> آخرین ورود </th>
                            <th> دفعات ورود </th>
                            <th> تعداد نظرات </th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($vendorsInQueue as $key => $vendor)
                            <?php $products_count = count($vendor->products);
    
    
                        if (!is_null($vendor->user)  && $vendor->user->id != "11" && $vendor->user->id != "12") {
    
    
                        ?>



                            <tr>

                                <th>
                                    {{ $vendor->id }} *
                                </th>
                                <th class="row" style="">


                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            عملیات
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-content text-center">

                                                <form class="dropdown-item border-bottom p-2 d-block w-100 m-0"
                                                    action="{{ route('admin.loginAsVendor') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="vId" value="{{ $vendor->id }}">
                                                    <input type="submit" value="ورود" class="btn btn-success m-auto">

                                                </form>

                                                <a class="dropdown-item border-bottom p-2 d-block w-100"
                                                href="{{ route('admin.vendors.edit', ['vendor' => $vendor->id]) }}">
                                                ویرایش
                                            </a>

                                               



                                                <a class="dropdown-item border-bottom p-2 d-block w-100" href="#"
                                                    onclick="vId({{ $vendor->id }})" data-toggle="modal"
                                                    data-target="#modalCart">
                                                    تبلیغ </a>

                                                <a href="p-0 m-0">

                                                    <form action="{{ route('admin.ladderVendor') }}" method="post"
                                                        class="m-0 p-0">


                                                        @csrf
                                                        <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

                                                        <input class="border-bottom p-2 d-block w-100" type="submit"
                                                            value="نردبان">

                                                    </form>
                                                </a>
                                                <a class="dropdown-item border-bottom p-2 d-block w-100"
                                                    href="{{ route('admin.sendMessage.edit', ['sendMessage' => $vendor->id, 'vendor' => $vendor->id]) }}">
                                                    ریپورت</a>
                                                <a class="dropdown-item  p-2 d-block w-100 text-danger"
                                                    href="{{ route('admin.deleteVendor', ['vendor' => $vendor->id]) }}">
                                                    حذف
                                                </a>


                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <a href="{{ route('vendor.home', ['vendor' => $vendor->name]) }}">

                                        {{ $vendor->title }}

                                    </a>
                                </th>
                                <th>
                                    0{{ $vendor->user->mobile }}
                                </th>







                                <th>
                                    {{ $products_count }}
                                </th>

                                <th>
                                    {{ $vendor->story_count }}
                                </th>
                                <th>
                                    {{ $vendor->slider_count }}
                                </th>
                                <th>
                                    {{ $vendor->spcV_count }}
                                </th>
                                <th>
                                    {{ $vendor->spcP_count }}
                                </th>
                                <th>
                                    {{ $vendor->ladderV_count }}
                                </th>

                                <th>
                                    {{ $vendor->ladderP_count }}
                                </th>
                                <th>

                                    {{ \Morilog\Jalali\Jalalian::forge($vendor->created_at) }}
                                </th>
                                <th>




                                    {{ \Morilog\Jalali\Jalalian::forge($vendor->last_login) ? \Morilog\Jalali\Jalalian::forge($vendor->last_login) : 'null' }}
                                </th>
                                <th>

                                    {{ $vendor->login_count }}

                                </th>

                                <th>

                                    {{ count($vendor->getCommentCounts) }}

                                </th>
                                <th>

                                    @if ($vendor->status == 'edited')
                                        <span class="text-danger">ویرایش شده</span>
                                    @elseif($vendor->status == 'reported')
                                        <span class="text-danger">ریپورت شده </span>
                                    @elseif($vendor->status == 'new')
                                        <span class="text-danger">فروشگاه جدید</span>
                                    @endif

                                </th>
                                <th>

                                </th>



                            </tr>


                            <?php } ?>
                        @endforeach


                    </tbody>
                </table>

            </div>

        </div>

        <div class="d-flex justify-content-center mt-5">
            {{-- {{ $vendors->render() }} --}}
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


                    console.log(standard);
                    $('#to').val(standard);
                }
            });









        });
    </script>
@endsection


<script>
    function acceptVendorReuest() {


        $('#acceptVendorRequest').submit();

    }



    function vId(id) {

        console.log(id);

        $('#vendor_id').val(id);

    }


    function AdVendor() {


        if (('#to') != "null") {
            $('#AdVendorForm').submit();
        } else {
            alert('لطفا تاریخ پایان را  وارد کنید');
        }

    }
</script>

<style>
    table {
        font-size: 13px;
    }
</style>
