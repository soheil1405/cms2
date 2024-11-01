    {{-- شروع تب محصولات --}}



    <div class="container mt-3">
        <a href="{{ route('products.index') }}" class=" text-center ">
            <h2 style="font-family:'dastnevis' !important;">محصولات</h2>
        </a>
    </div>

    <div id="exTab2" class="container py-3">
        <ul style="overflow-wrap: hidden;  padding: 0px;top: 20px;" class="nav nav-tabs products col-lg-8 t">



            <li class="tabli   active  activeTabb1 tabfontsizeproduct" style="border: 1px solid #9e9a9a ;">
                <a class="iransansmedium p-2" style="color: black"
                    onclick="
                        $('.activeTabb2').removeClass('activeTabb2');
                        $('.activeTabb3').removeClass('activeTabb3');
                        $(this).parent().addClass('activeTabb1');
                        $('#1').removeClass('tab-pane');
                        $('#2').addClass('tab-pane');
                        $('#3').addClass('tab-pane');
                    "
                    data-toggle="tab">ویژه ها</a>
            </li>
            <li class="tabli " style="border: 1px solid #9e9a9a ;"><a class="iransansmedium p-2 tabfontsizeproduct"
                    style="color: black"
                    onclick="
                        $('.activeTabb1').removeClass('activeTabb1');
                        $('.activeTabb3').removeClass('activeTabb3');
                        $(this).parent().addClass('activeTabb2');
                        $('#1').addClass('tab-pane');
                        $('#3').addClass('tab-pane');
                        $('#2').removeClass('tab-pane');


                    "
                    data-toggle="tab">پربازدیدها</a>
            </li>
            <li class="tabli " style="border: 1px solid #9e9a9a "><a class="iransansmedium p-2 tabfontsizeproduct"
                    style="color: black"
                    onclick="
                        $('.activeTabb2').removeClass('activeTabb2');
                        $('.activeTabb1').removeClass('activeTabb1');
                        $(this).parent().addClass('activeTabb3');
                        $('#3').removeClass('tab-pane');
                        $('#1').addClass('tab-pane');
                        $('#2').addClass('tab-pane');
                                "
                    data-toggle="tab">محبوب ها</a>
            </li>
        </ul>

        <div class="tab-content"
            style="background-color: #fee0ec; border-radius: 25px;box-shadow: 2px 2px 7px 2px #888888d3;">
            <div class=" product-tab-vizheha" id="1">
                <div class="tabvizhe">



                    <div class="row">
                        <div class="row" style="overflow: hidden;">
                            <div class="imgdiv whitemanproductgif col-md-2 d-flex align-items-center">
                                <img loading="lazy" style="height : 260px"
                                    src="{{ url(env('PRODUCT_WHITEMANS') . 'tik.gif') }}" class="whitemanproductgif "
                                    alt="{{ url(env('PRODUCT_WHITEMANS') . 'tik.gif') }}">
                            </div>
                            <div style="font-size: 18px !important; color:black !important;"
                                class="owl-carousel col-12 loop-vendor col-md-10 my-3 mobile-margin">


                                {{-- @include('layouts.products' , ['item'=>$speciallProducts , 'type'=>'relationable']) --}}
                                @foreach ($speciallProducts as $product)
                                    @if (
                                        $product->product->status != 'reported' &&
                                            $product->product->status != 'new' &&
                                            $product->product->status != 'reported-edited')
                                        <x-productsCarousel :product="$product->Product" />
                                    @endif
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- پربازدید  --}}




            <div class="tab-pane"
                style="border-radius: 25px;
               background-image: linear-gradient(482deg, rgba(94, 94, 94, 0.04) 0%, rgba(94, 94, 94, 0.04) 48%,rgba(220, 220, 220, 0.04) 48%, rgba(220, 220, 220, 0.04) 100%),linear-gradient(444deg, rgba(232, 232, 232, 0.04) 0%, rgba(232, 232, 232, 0.04) 9%,rgba(135, 135, 135, 0.04) 9%, rgba(135, 135, 135, 0.04) 100%),linear-gradient(200deg, rgba(26, 26, 26, 0.04) 0%, rgba(26, 26, 26, 0.04) 47%,rgba(147, 147, 147, 0.04) 47%, rgba(147, 147, 147, 0.04) 100%),linear-gradient(382deg, rgba(235, 235, 235, 0.04) 0%, rgba(235, 235, 235, 0.04) 68%,rgba(140, 140, 140, 0.04) 68%, rgba(140, 140, 140, 0.04) 100%),linear-gradient(266deg, rgb(244, 71, 207),rgb(243, 198, 242));

box-shadow: 2px 2px 7px 2px #888888d3;
               "
                id="2">
                <div class="tabvizhe">




                    <div class="row">
                        <div class="row " style="overflow: hidden; ">
                            <div class="imgdiv whitemanproductgif col-md-2 d-flex align-items-center">
                                <img loading="lazy"
                                    src="{{ url(env('PRODUCT_WHITEMANS') . 'P_mostView.gif') }}"alt="{{ url(env('PRODUCT_WHITEMANS') . 'P_mostView.gif') }}"
                                    class="whitemanproductgif h-65px" style="max-height: auto" alt="">
                            </div>

                            <div style="font-size: 18px !important; color:black !important;"
                                class="owl-carousel col-md-10 loop-vendor my-3 mobile-margin">


                                {{-- @include('layouts.products', [
                                    'item' => $most_view_products,
                                    'type' => 'product',
                                ]) --}}

                                @foreach ($most_view_products as $product)
                                    @if ($product->status != 'reported' && $product->status != 'new' && $product->status != 'reported-edited')
                                        <x-productsCarousel :product="$product" />
                                    @endif
                                @endforeach





                            </div>
                        </div>
                    </div>




                </div>
            </div>
            <div class="tab-pane"
                style="
                background-image: linear-gradient(257deg, rgba(246, 246, 246, 0.03) 0%, rgba(246, 246, 246, 0.03) 4%,rgba(152, 152, 152, 0.03) 4%, rgba(152, 152, 152, 0.03) 32%,rgba(123, 123, 123, 0.03) 32%, rgba(123, 123, 123, 0.03) 41%,rgba(189, 189, 189, 0.03) 41%, rgba(189, 189, 189, 0.03) 45%,rgba(151, 151, 151, 0.03) 45%, rgba(151, 151, 151, 0.03) 47%,rgba(61, 61, 61, 0.03) 47%, rgba(61, 61, 61, 0.03) 77%,rgba(34, 34, 34, 0.03) 77%, rgba(34, 34, 34, 0.03) 100%),linear-gradient(300deg, rgba(222, 222, 222, 0.03) 0%, rgba(222, 222, 222, 0.03) 7%,rgba(67, 67, 67, 0.03) 7%, rgba(67, 67, 67, 0.03) 18%,rgba(61, 61, 61, 0.03) 18%, rgba(61, 61, 61, 0.03) 26%,rgba(32, 32, 32, 0.03) 26%, rgba(32, 32, 32, 0.03) 52%,rgba(119, 119, 119, 0.03) 52%, rgba(119, 119, 119, 0.03) 60%,rgba(252, 252, 252, 0.03) 60%, rgba(252, 252, 252, 0.03) 68%,rgba(9, 9, 9, 0.03) 68%, rgba(9, 9, 9, 0.03) 100%),linear-gradient(496deg, rgba(193, 193, 193, 0.03) 0%, rgba(193, 193, 193, 0.03) 12%,rgba(184, 184, 184, 0.03) 12%, rgba(184, 184, 184, 0.03) 24%,rgba(194, 194, 194, 0.03) 24%, rgba(194, 194, 194, 0.03) 43%,rgba(128, 128, 128, 0.03) 43%, rgba(128, 128, 128, 0.03) 54%,rgba(87, 87, 87, 0.03) 54%, rgba(87, 87, 87, 0.03) 71%,rgba(169, 169, 169, 0.03) 71%, rgba(169, 169, 169, 0.03) 93%,rgba(83, 83, 83, 0.03) 93%, rgba(83, 83, 83, 0.03) 100%),linear-gradient(202deg, rgba(186, 186, 186, 0.03) 0%, rgba(186, 186, 186, 0.03) 9%,rgba(77, 77, 77, 0.03) 9%, rgba(77, 77, 77, 0.03) 19%,rgba(38, 38, 38, 0.03) 19%, rgba(38, 38, 38, 0.03) 27%,rgba(203, 203, 203, 0.03) 27%, rgba(203, 203, 203, 0.03) 39%,rgba(130, 130, 130, 0.03) 39%, rgba(130, 130, 130, 0.03) 43%,rgba(184, 184, 184, 0.03) 43%, rgba(184, 184, 184, 0.03) 81%,rgba(108, 108, 108, 0.03) 81%, rgba(108, 108, 108, 0.03) 100%),linear-gradient(168deg, rgb(107, 4, 15),rgb(240, 4, 35));

border-radius: 25px;box-shadow: 2px 2px 7px 2px #888888d3;"
                id="3">
                <div class="tabvizhe">



                    <div class="row">
                        <div class="row" style="overflow:hidden;">
                            <div class="imgdiv whitemanproductgif col-md-2 d-flex align-items-center ">
                                <img loading="lazy" src="{{ url(env('PRODUCT_WHITEMANS') . 'setare.gif') }}"
                                    class="whitemanproductgif h-65px" alt="">
                            </div>
                            <div style="  font-size: 18px !important; color:black !important; "
                                class="owl-carousel col-md-10 loop-vendor my-3 mobile-margin">

                                {{-- @include('layouts.products', [
                                    'item' => $popularProducts,
                                    'type' => 'product',
                                ]) --}}
                                @foreach ($popularProducts as $product)
                                    @if ($product->status != 'reported' && $product->status != 'new' && $product->status != 'reported-edited')
                                        <x-productsCarousel :product="$product" />
                                    @endif
                                @endforeach



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
