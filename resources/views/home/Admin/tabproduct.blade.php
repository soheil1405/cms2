    {{-- شروع تب محصولات --}}

    <style>
        @media only screen and (max-width: 767px) {

            .card {
                /* width: 50% !important; */

                height: 250px;
            }

            .productImgDiv {
                height: 170px;
            }

            .productImg {
                width: 100%;
                height: 150px;
                object-fit: center !important;
            }

            .product_name {
                padding: 5px;
                /* font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important; */
                   
                font-size: 12px !important;
            }

            .normalFont {
                padding: 0px !important;
                margin: 0px !important;
            }



        }

    </style>

    <?php $setting = App\Models\Admin\SiteSetting::first(); ?>

    <?php $setting2 = App\Models\Admin\Setting::first(); ?>




    <div class="container">
        <h2 style="font-family:'dastnevis'!important;">محصولات</h2>
        
    </div>

    <form method="POST" id="HomeEditProductStatus" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}">

        @csrf

        <div class="">

            <label class="switch">

                <input type="hidden" name="prd" value="1">

                <input name="HomePrd" type="checkbox" id="produtController" style="display: none;"
                    onchange="$('#HomeEditProductStatus').submit();" @if ($setting->products) checked @endif>
                <span class="round"></span>
            </label>

        </div>

    </form>

    {{-- <div id="exTab2"
        class="container
            @if (!$setting->products) notttt @endif


            
            
            ">
        <ul style="overflow-wrap: hidden;  margin-right: 25px; padding: 0px;top: 20px;"
            class="nav nav-tabs products col-lg-8 ">



            <li class="tabli  active  activeTabb1 " style="border: 1px solid #9e9a9a ;">
                <a href="#1" style="color: black"
                    onclick="
                                $('.activeTabb2').removeClass('activeTabb2');
                                $('.activeTabb3').removeClass('activeTabb3');
                                $(this).parent().addClass('activeTabb1');
                            "
                    data-toggle="tab">ویژه</a>
            </li>
            <li class="tabli" style="border: 1px solid #9e9a9a ;"><a href="#2" style="color: black"
                    onclick="
                                $('.activeTabb1').removeClass('activeTabb1');
                                $('.activeTabb3').removeClass('activeTabb3');
                                $(this).parent().addClass('activeTabb2');
                            "
                    data-toggle="tab">پر بازدید</a>
            </li>
            <li class="tabli" style="border: 1px solid #9e9a9a "><a href="#3" style="color: black"
                    onclick="
                                $('.activeTabb2').removeClass('activeTabb2');
                                $('.activeTabb1').removeClass('activeTabb1');
                                $(this).parent().addClass('activeTabb3');
                                        "
                    data-toggle="tab">محبوب ترین ها</a>
            </li>
        </ul>

        <div class="tab-content" style="background-color: #fee0ec;">
            <div class="tab-pane active " id="1">
                <div class="tabvizhe">



                    <div class="row">
                        <div class="col-12 d-flex background-color-product" style="overflow: hidden; ">
                            <img src="{{ url(env('PRODUCT_WHITEMANS') . 'v_bargozideh.gif') }}"
                                class="whitemanproductgif" style="height: 100%; width:220px;" alt="">
                            <div style="font-size: 18px !important; color:black !important;"
                                class="owl-carousel col-12 loop-vendor ">

                                @include('layouts.products' , ['item'=>$speciallProducts , 'type'=>$speciallProducts])

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" style="background-color: #f9c6d9; border-radius: 12px;" id="2">
                <div class="tabvizhe">




                    <div class="row">
                        <div class="col-12 d-flex background-color-product" style="overflow: hidden;">
                            <img src="{{ url(env('PRODUCT_WHITEMANS') . 'P_mostView.gif') }}" class="whitemanproductgif"
                                style="max-height: auto; width:337px;" alt="">

                            <div style="font-size: 18px !important; color:black !important;"
                                class="owl-carousel col-12 loop-vendor">


                                @include('layouts.products' , ['item'=>$most_view_products , 'type'=>'product'])






                            </div>
                        </div>
                    </div>




                </div>
            </div>
            <div class="tab-pane" style="background-color: #ed89b9; border-radius: 12px;" id="3">
                <div class="tabvizhe">



                    <div class="row">
                        <div class="col-12 d-flex background-color-product " style="overflow:hidden;">
                            <img src="{{ url(env('PRODUCT_WHITEMANS') . 'p_mahboob.gif') }}" style="width:220px;"
                                class="whitemanproductgif" alt="">
                            <div style="  font-size: 18px !important; color:black !important;"
                                class="owl-carousel loop-vendor ">

                                @include('layouts.products' , ['item'=>$popularProducts , 'type'=>'product'])

  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
