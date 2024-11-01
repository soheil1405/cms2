
<div class="row ven-big-sec" style="position: relative;">



    <div>


        <div class="container pt-4 mt-desktop-home-slider55 mt-mobile-home-slider">



            <div class="mostproduct-slider-container">
                <span class="mostproduct-arrow-left"></span>
                <span class="mostproduct-arrow-right"></span>
                <div class="mostproduct-slider" id="mostproduct-slider">





                    @for ($i = 0; $i < count($popularVendorrs); $i++)
                        <div class="mostproduct-slide   bg-white">


                            <div class=" bg-white  border-25 p-2  " style="">


                                <div class="">
                                    <img loading="lazy"
                                        style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:40px; height:40px;"class=""
                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->avatar) }}"
                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->name) }}"
                                        alt="" />


                                    <a style=" color:black; font-size:20px; padding:10px "
                                        href="{{ route('vendor.home', ['vendor' => $popularVendorrs[$i]->name]) }}"
                                        class=" ">
                                        {{ $popularVendorrs[$i]->title }}
                                    </a>






                                </div>



                                <div
                                    style=" opacity: 0;overflow-x:scroll;white-space: nowrap;  "class="vendorproducts d-block p-2 p-md-1">

                                    @foreach ($popularVendorrs[$i]->home_products as $product)
                                        <!-- Card image -->
                                        <a class="card p-1 d-inline-block" style="width:100px; "
                                            href="{{ route('products.show', ['product' => $product->slug]) }}">
                                            <div style="max-width: 100%;height:80px; text-align: center;"
                                                class="">
                                                <img class=""
                                                    style="max-width: 100%; height:inherit;border-radius: 10px;"
                                                    alt="{{ $product->name }}"
                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                    data-loaded="true">



                                            </div>

                                            <div class="">
                                                <!-- Title -->
                                                <p class="iransansmedium text-truncate px-1 text-center"
                                                    style="font-size:8px;">


                                                    {{ $product->name }}

                                                </p>
                                                <!-- Button -->
                                                <?php if($product->product_price !=null ) { ?>
                                                <p class="iransansmedium text-truncate px-1"
                                                    style="font-size:8px;">
                                                    قیمت
                                                    <small
                                                        style="width: 100%; text-align:center !important; font-size:8px;"
                                                        class="text-center texr-danger">
                                                        {{ $product->product_price }}
                                                    </small>
                                                    تومان
                                                </p>
                                                <?php }else{ ?>
                                                <p class="iransansmedium text-truncate px-1"
                                                    style="width: 100%; text-align:center !important;  font-size:8px;">
                                                    قیمت : -
                                                </p>
                                                <?php } ?>


                                            </div>
                                            <!--/ Card content -->
                                        </a>
                                    @endforeach


                                </div>

                            </div>
                        </div>
                    @endfor


                </div>
                <div class="mostproduct-dots">
                    {{-- <span></span> --}}

                    <span></span>
                    <span></span>
                    <span class="mostproduct-active"></span>
                    <span></span>
                    <span></span>


                </div>
            </div>
        </div>








    </div>







</div>

<script>
    setInterval(() => {
        var nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").next();

        if ($(this).hasClass("mostproduct-arrow-left")) {
            nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").prev();
        }

        if (nextActiveSlideMostproduct.length > 0) {


            var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
            $(".mostproduct-dots span").removeClass("mostproduct-active");
            $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass("mostproduct-active");

            updateSlidesMostproduct(nextActiveSlideMostproduct);
        } else {
            console.log('no');
            if ($(this).hasClass("mostproduct-arrow-left")) {



                nextActiveSlideMostproduct = $(".mostproduct-slider").children().last();

                var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
                $(".mostproduct-dots span").removeClass("mostproduct-active");
                $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass("mostproduct-active");

                updateSlidesMostproduct(nextActiveSlideMostproduct);

            } else {

                nextActiveSlideMostproduct = $(".mostproduct-slider").children().first();

                var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();

                $(".mostproduct-dots span").removeClass("mostproduct-active");
                $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass("mostproduct-active");


                updateSlidesMostproduct(nextActiveSlideMostproduct);

            }
        }


    }, "3000");


    var updateSlidesMostproduct = function(nextActiveSlideMostproduct) {

        // console.log(nextActiveSlideMostproduct);
        var nextActiveSlideMostproductIndex = $(nextActiveSlideMostproduct).index();

        $(".mostproduct-slide").removeClass("mostproduct-prev-1");
        $(".mostproduct-slide").removeClass("mostproduct-next-1");
        $(".mostproduct-slide").removeClass("mostproduct-active");
        $(".mostproduct-slide").removeClass("mostproduct-prev-2");
        $(".mostproduct-slide").removeClass("mostproduct-next-2");

        nextActiveSlideMostproduct.addClass("mostproduct-active");

        nextActiveSlideMostproduct.prev().addClass("mostproduct-prev-1");
        nextActiveSlideMostproduct.prev().prev().addClass("mostproduct-prev-2");
        nextActiveSlideMostproduct.addClass("mostproduct-active");
        nextActiveSlideMostproduct.next().addClass("mostproduct-next-1");
        nextActiveSlideMostproduct.next().next().addClass("mostproduct-next-2");
    }

    var mostproductSlider = (function() {
        var initSliderMostproduct = function() {
            var dir = $("html").attr("dir");
            var swipeHandlerMostproduct = new Hammer(document.getElementById("mostproduct-slider"));
            swipeHandlerMostproduct.on('swipeleft', function(e) {
                if (dir == "ltr")
                    $(".mostproduct-arrow-left").trigger("click");
                else
                    $(".mostproduct-arrow-right").trigger("click");
            });

            swipeHandlerMostproduct.on('swiperight', function(e) {

                if (dir == "ltr")
                    $(".mostproduct-arrow-right").trigger("click");
                else
                    $(".mostproduct-arrow-left").trigger("click");
            });

            $(".mostproduct-arrow-right , .mostproduct-arrow-left").click(function(event) {
                var nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").next();

                if ($(this).hasClass("mostproduct-arrow-left")) {
                    nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").prev();
                }

                if (nextActiveSlideMostproduct.length > 0) {


                    var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
                    $(".mostproduct-dots span").removeClass("mostproduct-active");
                    $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass(
                        "mostproduct-active");

                    updateSlidesMostproduct(nextActiveSlideMostproduct);
                } else {
                    console.log('no');
                    if ($(this).hasClass("mostproduct-arrow-left")) {



                        nextActiveSlideMostproduct = $(".mostproduct-slider").children().last();

                        var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
                        $(".mostproduct-dots span").removeClass("mostproduct-active");
                        $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass(
                            "mostproduct-active");

                        updateSlidesMostproduct(nextActiveSlideMostproduct);

                    } else {

                        nextActiveSlideMostproduct = $(".mostproduct-slider").children().first();

                        var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();

                        $(".mostproduct-dots span").removeClass("mostproduct-active");
                        $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass(
                            "mostproduct-active");


                        updateSlidesMostproduct(nextActiveSlideMostproduct);

                    }
                }

            });

            $(".mostproduct-dots span").click(function(event) {
                var slideIndexMostproduct = $(this).index();
                var nextActiveSlideMostproduct = $($(".mostproduct-slider").children()[slideIndexMostproduct]);
                $(".mostproduct-dots span").removeClass("mostproduct-active");
                $(this).addClass("mostproduct-active");

                updateSlidesMostproduct(nextActiveSlideMostproduct);
            });

            var updateSlidesMostproduct = function(nextActiveSlideMostproduct) {

                var nextActiveSlideMostproductIndex = $(nextActiveSlideMostproduct).index();

                $(".mostproduct-slide").removeClass("mostproduct-prev-1");
                $(".mostproduct-slide").removeClass("mostproduct-next-1");
                $(".mostproduct-slide").removeClass("mostproduct-active");
                $(".mostproduct-slide").removeClass("mostproduct-prev-2");
                $(".mostproduct-slide").removeClass("mostproduct-next-2");

                nextActiveSlideMostproduct.addClass("mostproduct-active");

                nextActiveSlideMostproduct.prev().addClass("mostproduct-prev-1");
                nextActiveSlideMostproduct.prev().prev().addClass("mostproduct-prev-2");
                nextActiveSlideMostproduct.addClass("mostproduct-active");
                nextActiveSlideMostproduct.next().addClass("mostproduct-next-1");
                nextActiveSlideMostproduct.next().next().addClass("mostproduct-next-2");
            }

            var updateToNextSlide = function(nextActiveSlideMostproduct) {

            }
        }
        return {
            init: function() {
                initSliderMostproduct();
            }
        }
    })();

    $(function() {
        mostproductSlider.init();
    });
</script>

<style>
    
    .mostproduct-slider-container {
        display: block;
        height: 400px;
        width: auto;
        margin: 0 auto;
        position: relative;
        /* max-width: 1300px; */
        margin-top: 20px;
    }

    .mostproduct-slider-container .mostproduct-arrow-left {
        position: absolute;
        left: 10%;
        top: 50%;
        transform: translate3d(0, -50%, 0);
        color: rgb(0, 0, 0);
        font-size: 28px;
        cursor: pointer;
        z-index: 9;
        border-top: 12px solid transparent;
        border-right: 7px solid #000000;
        border-bottom: 12px solid transparent;
    }

    @media (max-width: 768px) {
        .mostproduct-slider-container .mostproduct-arrow-left {
            display: none;
        }
    }

    .mostproduct-slider-container .mostproduct-arrow-right {
        position: absolute;
        right: 10%;
        top: 50%;
        transform: translate3d(0, -50%, 0);
        color: rgb(0, 0, 0);
        font-size: 28px;
        cursor: pointer;
        z-index: 9;
        border-top: 12px solid transparent;
        border-left: 7px solid #000000;
        border-bottom: 12px solid transparent;
    }

    @media (max-width: 768px) {
        .mostproduct-slider-container .mostproduct-arrow-right {
            display: none;
        }

        .mostproduct-slider-container {
            height: 250px;
        }
    }

    .mostproduct-slider-container .mostproduct-dots {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin: 5px 0;
        user-select: none;
    }

    .mostproduct-slider-container .mostproduct-dots span {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 2px;
        cursor: pointer;
        user-select: none;
        padding: 10px 0;
        position: relative;
    }

    .mostproduct-slider-container .mostproduct-dots span:before {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate3d(-50%, -50%, 0);
        height: 10px;
        width: 10px;
        border-radius: 50%;
        background-color: #000000;
        opacity: 0.6;
    }

    @media (max-width: 768px) {
        .mostproduct-slider-container .mostproduct-dots span {
            width: 23px;
            margin-bottom: 15px;
        }
    }

    .mostproduct-slider-container .mostproduct-dots span.mostproduct-active:before {
        background-color: #ad36aa;
        opacity: 1;
    }

    .mostproduct-slider-container .mostproduct-slider {
        display: block;
        /* width: 650px; */
        height: 100%;
        margin: 0 auto;
        position: relative;
        text-align: center;
        /* line-height: 270px; */
        color: white;
    }

    @media (max-width: 768px) {
        .mostproduct-slider-container .mostproduct-slider {
            height: 200px;
        }
    }

    .mostproduct-slider-container .mostproduct-slider .mostproduct-slide {
        display: inline-block;
        width: 90%;
        /* height: 270px; */
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate3d(-50%, -50%, 0) scale3d(0.4, 0.4, 1);
        transition: transform 0.3s ease-in-out 0s, z-index 0.2s ease-in-out 0.1s;
    }

    @media (max-width: 768px) {
        .mostproduct-slider-container .mostproduct-slider .mostproduct-slide {
            /* width: 100%;
                height: 450px; */
        }
    }

    .mostproduct-slider-container .mostproduct-slider .mostproduct-slide.mostproduct-prev-2 {
        transform: translate3d(-105%, -50%, 0) scale3d(0.4, 0.4, 1);
        z-index: 1;
        opacity: 0.5;
    }

    .mostproduct-slider-container .mostproduct-slider .mostproduct-slide.mostproduct-prev-1 {
        transform: translate3d(-85%, -50%, 0) scale3d(0.6, 0.6, 1);
        z-index: 2;
    }

    .mostproduct-slider-container .mostproduct-slider .mostproduct-slide.mostproduct-next-1 {
        z-index: 2;
        transform: translate3d(-15%, -50%, 0) scale3d(0.6, 0.6, 1);
    }

    .mostproduct-slider-container .mostproduct-slider .mostproduct-slide.mostproduct-next-2 {
        z-index: 1;
        transform: translate3d(5%, -50%, 0) scale3d(0.4, 0.4, 1);
        opacity: 0.5;
    }

    .mostproduct-slider-container .mostproduct-slider .mostproduct-slide.mostproduct-active {
        z-index: 3;
        transform: translate3d(-50%, -50%, 0) scale3d(1, 1, 1);

        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .mostproduct-slider-container .mostproduct-slider .mostproduct-slide.mostproduct-active img {
        box-shadow: 2px 2px 30px 10px #3d3d3d8a;
    }

</style>