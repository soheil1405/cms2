@extends('user.layouts.user')

@section('title')
    تبلیغات
@endsection

<style>
    .blur {
        background-color: rgb(0 0 0 / 80%);
        border-radius: 5px;
        text-align: center;
        -webkit-backdrop-filter: blur(7px);
        backdrop-filter: blur(7px);
        width: 80%;
        height: 70%;
        right: 13%;
        position: fixed;
        justify-content: center;
        color: #ffffff;
        displayrgb(7, 0, 0)x;
        flex-direction: column;
        z-index: 1000;
        top: 10%;
        border-radius: 25px;

    }

    @media only screen and (max-width:576px) {
        .blur {
            height: 85%;
            width: 85%;
            right: 7%;

            top: 1%;
            padding: 25px !important;
            z-index: 99999999999999999999;
        }
    }




    li {
        list-style-type: none;
    }

    .desc {

        list-style-type: none;
    }

    .twice_ul {
        /* padding: 30px; */
    }

    .desc {
        width: 100%;
        text-align: right;
    }

    .blur btn {
        width: 50px;
    }

    .btn-story {
        background-color: #ffffff !important;
        color: blue !important;
        border: 1px solid blue !important;
    }
</style>


{{-- @if (!session()->get('seen')) --}}
<div id="blur" class="blur">


    <ul class="p-md-5 P-0">

        <li class="twice_ul h5 pb-2" style="border-bottom: 1px solid #fff;">شما در این صفحه میتوانید محصولات خود را
            <strong>استوری </strong> , <strong>نردبان </strong> و
            همچنین
            <strong>تبلیغ</strong> کنید
        </li>



        <li class="desc my-1 my-md-3">

            <a href="" class="btn btn-sm btn-story" alt='story'>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-bullseye" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10zm0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                    <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                </svg> </a>

            <span> استوری : </span>
            <label class="d-block mr-5 pt-2">
                محصول شما استوری خواهد شد و این استوری به مدت24 ساعت در صفحه اول سایت برای همگان و در پنل کاربری
                برای
                فالور های شما قابل مشاهده خواهد بود
            </label>
        </li>



        <li class="desc mb-2">




            <button class="btn btn-sm btn-danger" value="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-ladder" viewBox="0 0 16 16">
                    <path
                        d="M4.5 1a.5.5 0 0 1 .5.5V2h6v-.5a.5.5 0 0 1 1 0v14a.5.5 0 0 1-1 0V15H5v.5a.5.5 0 0 1-1 0v-14a.5.5 0 0 1 .5-.5zM5 14h6v-2H5v2zm0-3h6V9H5v2zm0-3h6V6H5v2zm0-3h6V3H5v2z" />
                </svg>
            </button>





            <span>نردبان :</span>

            <label class="d-block mr-5 pt-2">
                محصول/فروشگاه شما با نردبان شدن به صدر لیست محصولات/فروشگاه ها انتقال داده می شود
            </label>
        </li>



        <li class="desc mb-2">



            <button type="button" class="btn btn-primary" style="font-size: 10px;"> Ad </button>

            <span>تبلیغات :</span>

            <span class="d-block mr-5 pt-2">
                محصول/فروشگاه شما به صفحه اول در جایگاه محصولات/فروشگاه های ویژه انتقال داده میشوند
            </span>
        </li>

        <div class="mx-5 my-md-5 ">
            <span onclick=" $('#blur').css('display' , 'none');   " style="cursor: pointer; border:1px solid gray; "
                class="btn-block btn mx-auto btn-story">متوجه
                شدم</span>
        </div>
    </ul>




</div>
{{-- @endif --}}




@section('content')
    @php

        session()->put('seen', true);

    @endphp

    <!-- Content Row -->
    <div class="container-fluid">
        <div class="row">




            @if (Session::has('storyStore'))
                <div class="alert alert-success">
                    {{ Session::get('storyStore') }}
                </div>
            @endif

            @if (Session::has('tekrari'))
                <div class="alert alert-success">
                    {{ Session::get('tekrari') }}
                </div>
            @endif




            







            <div class="col-xl-12 col-md-12 bg-white pb-2 pt-1">
             
                <h5 class="font-weight-bold  ">لیست محصولات({{ $products->total() }})</h5>



                {{-- @if (userDashboard(['usersSendSlider']))
                    <a href="{{ route('user.mysliders') }}" class="btn btn-outline-danger mt-1">اسلایدر های من</a>
                @endif --}}

                @if (userDashboard(['usersSendStory']))
                    <a href="{{ route('user.story.index') }}" class="btn btn-outline-success mt-1">استوری های من</a>
                @endif

                <a href="{{ route('user.upgradeproduct.index') }}" class="btn btn-outline-info mt-1">محصول های من </a>

            </div>


            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="table-responsive">
                <table 
                    class="table align-middle table-bordered table-striped font-table-size table-hover  text-center">

                    <thead>
                        <tr class="align-middle">
                            <th class="align-middle">#</th>
                            <th class="align-middle">نام</th>
                            <th class="align-middle">برند</th>
                            <th class="align-middle">دسته بندی</th>
                            <th class="align-middle">تصویر</th>
                            <th class="align-middle">بازدید</th>
                            <th class="align-middle">دیدگاه</th>

                            <th>تاریخ ثبت </th>
                            <th>وضعیت</th>

                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($products as $key => $product)
                            <tr class="align-middle">
                                <th class="align-middle">
                                    {{ $products->firstItem() + $key }}
                                </th>
                                <th class="align-middle">
                                    <a
                                        href="{{ route('products.show', [ 'product' => $product->slug]) }}">
                                        {{ $product->name }}
                                    </a>
                                </th>
                                <th class="align-middle">
                                    <a href="">
                                        {{ $product->brand->name }}
                                    </a>
                                </th>
                                <th class="align-middle">
                                    {{ $product->category->name }}
                                </th>

                                <th class="align-middle">
                                    <img src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                        style="width:40px; height:40px; object-fit: cover;" alt="">
                                </th>

                                <th class="align-middle">
                                    {{ $product->view_counter }}
                                </th>


                                <th class="align-middle">
                                    {{ count($product->commentCounts) }}
                                </th>



                                <th class="align-middle">

                                    <?php
                                    
                                    $datetime = \Morilog\Jalali\Jalalian::forge($product->created_at);
                                    
                                    $date = substr($datetime, 0, 10);
                                    
                                    echo $date;
                                    
                                    ?>

                                </th>


                                <th class="align-middle">
                                    @if ($product->status == 'yes')
                                        <span class="text-success' ">

                                            منتشر شده
                                        </span>
                                    @else
                                        <span class="text-warning ">

                                            در صف انتشار

                                        </span>
                                    @endif

                                </th>

                                <th class="align-middle">
                                    @if ($product->status == 'yes')
                                        <div class="d-flex" style="justify-content: space-evenly;">


                                            @if (userDashboard(['usersLaddelP']))
                                                <form action="{{ route('user.products.ladder') }}" method="post">


                                                    @csrf
                                                    <input type="hidden" name="product" value="{{ $product->id }}">



                                                    <button onmouseover="$(this).next().css('display' , 'block')"
                                                        onmouseout="$(this).next().css('display' , 'none')" type="submit"
                                                        name="ladder" class="btn btn-sm btn-danger" value="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-ladder"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M4.5 1a.5.5 0 0 1 .5.5V2h6v-.5a.5.5 0 0 1 1 0v14a.5.5 0 0 1-1 0V15H5v.5a.5.5 0 0 1-1 0v-14a.5.5 0 0 1 .5-.5zM5 14h6v-2H5v2zm0-3h6V9H5v2zm0-3h6V6H5v2zm0-3h6V3H5v2z" />
                                                        </svg>
                                                    </button>

                                                    <span
                                                        style="  background-color: rgb(33, 32, 32); color:#efefef;  position: fixed; top:20%; left:100px; display:none; width:300px;">
                                                        نردبان </span>

                                                </form>
                                            @endif

                                            @if (userDashboard(['usersSendStory']))
                                                <div class="">


                                                    <a href="{{ route('user.story.create', ['productId' => $product->id]) }}"
                                                        onmouseover="$(this).next().css('display' , 'block')"
                                                        onmouseout="$(this).next().css('display' , 'none')" href=""
                                                        class="btn btn-sm btn-story" alt='story'>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-bullseye"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10zm0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                                            <path
                                                                d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                                                            <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                        </svg> </a>


                                                    <span
                                                        style="  background-color: rgb(33, 32, 32); color:#efefef;  position: fixed; top:20%; left:100px; display:none; width:300px;">
                                                        استوری </span>

                                                </div>
                                            @endif

                                            @if (userDashboard(['usersUpgradeProduct']))
                                                <a href="{{ route('user.upgradeproduct.create', ['id' => $product->id]) }}"
                                                    class="">


                                                    <button onmouseover="$(this).next().css('display' , 'block')"
                                                        onmouseout="$(this).next().css('display' , 'none')"
                                                        onclick="$('.Slider').css('display' , 'block')   ; $('#p_id').val({{ $product->id }});          "
                                                        type="button" class="btn btn-sm btn-primary"
                                                        style="font-size: 10px;">
                                                        AD
                                                    </button>


                                                    <span
                                                        style="  background-color: rgb(33, 32, 32); color:#efefef;  position: fixed; top:20%; left:100px; display:none; width:300px;">

                                                        ارسال به صفحه اول(محصولات ویژه) </span>

                                                </a>
                                            @endif


                                        </div>
                                    @endif
                                </th>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $products->render() }}
            </div>
        </div>
    </div>
@endsection




<script>
    function Ajaxcheck() {



        var selelced = $('#position_number').val();


        formData = {

            position_number: selelced

        };


        $.ajax({

            type: "POST",
            url: "/AjaxcheckSlider",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                $('#SuccessSlider').css('display', 'block');

                $('#dangerSlider').css('display', 'none');
            },
            error: function(data) {


                $('#dangerSlider').css('display', 'block');





                $('#SuccessSlider').css('display', 'none');
            }

        });



    }
</script>
