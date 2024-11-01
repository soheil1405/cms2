{{-- فروشگاه ها شروع --}}

<script>
    var time1;
    var time2;
    var time3;


    let n1um = 0;

    let n2um = 0;

    let n3um = 0;



    window.onload = function() {

        time1 = setInterval(() => {

            startTime1();
            startTime2();
            startTime3();

        }, 5000)

        // function startTime1() {
        //     let boxs1 = document.getElementsByClassName('box1');





        //     // other div0
        //     if (n1um != 0) {
        //         let n1um3 = n1um;
        //         let n1um4 = n1um;
        //         let pr = n1um;


        //         if (boxs1[boxs1.length - 1].classList.contains('prev')) {
        //             boxs1[boxs1.length - 1].classList.remove('prev')
        //         } else {
        //             pr -= 2
        //             boxs1[pr].classList.remove('prev')
        //             boxs1[pr].classList.remove('next')
        //         }
        //         --n1um3
        //         boxs1[n1um3].classList.replace('activee', 'prev')
        //         boxs1[n1um].classList.replace('next', 'activee')

        //         // boxs[n1um].classList.add('activee')

        //         if (n1um != boxs1.length - 1) {
        //             boxs1[++n1um4].classList.add('next')
        //         }


        //     }

        //     //first div
        //     else {


        //         boxs1[n1um].classList.remove('next');

        //         if (boxs1[boxs1.length - 1].classList.contains('activee')) {
        //             boxs1[boxs1.length - 1].classList.remove('activee')
        //             boxs1[boxs1.length - 2].classList.remove('prev')
        //         }
        //         boxs1[boxs1.length - 1].classList.add('prev')
        //         boxs1[n1um].classList.add('activee')

        //         let n1um2 = n1um;
        //         ++n1um2
        //         boxs1[n1um2].classList.add('next')
        //     }

        //     if (n1um === boxs1.length - 1) {
        //         boxs1[0].classList.remove('activee')
        //         boxs1[0].classList.add('next')
        //     }

        //     n1um++


        //     if (n1um === boxs1.length) {
        //         let pv = boxs1.length - 1
        //         boxs1[boxs1.length - 1].classList.remove('next')
        //         boxs1[boxs1.length - 1].classList.remove('prev')
        //             --pv


        //         boxs1[pv].classList.remove('next')
        //         boxs1[pv].classList.remove('activee')
        //         n1um = 0

        //     }

        // }

        // function startTime2() {
        //     let boxs2 = document.getElementsByClassName('box2');





        //     // other div0
        //     if (n2um != 0) {
        //         let n2um3 = n2um;
        //         let n2um4 = n2um;
        //         let pr = n2um;


        //         if (boxs2[boxs2.length - 1].classList.contains('prev')) {
        //             boxs2[boxs2.length - 1].classList.remove('prev')
        //         } else {
        //             pr -= 2
        //             boxs2[pr].classList.remove('prev')
        //             boxs2[pr].classList.remove('next')
        //         }
        //         --n2um3
        //         boxs2[n2um3].classList.replace('activee', 'prev')
        //         boxs2[n2um].classList.replace('next', 'activee')

        //         // boxs[n2um].classList.add('activee')

        //         if (n2um != boxs2.length - 1) {
        //             boxs2[++n2um4].classList.add('next')
        //         }


        //     }

        //     //first div
        //     else {

        //         boxs2[n2um].classList.remove('next');

        //         if (boxs2[boxs2.length - 1].classList.contains('activee')) {
        //             boxs2[boxs2.length - 1].classList.remove('activee')
        //             boxs2[boxs2.length - 2].classList.remove('prev')
        //         }
        //         boxs2[boxs2.length - 1].classList.add('prev')
        //         boxs2[n2um].classList.add('activee')

        //         let n2um2 = n2um;
        //         ++n2um2
        //         boxs2[n2um2].classList.add('next')
        //     }

        //     if (n2um === boxs2.length - 1) {
        //         boxs2[0].classList.remove('activee')
        //         boxs2[0].classList.add('next')
        //     }

        //     n2um++


        //     if (n2um === boxs2.length) {
        //         let pv = boxs2.length - 1
        //         boxs2[boxs2.length - 1].classList.remove('next')
        //         boxs2[boxs2.length - 1].classList.remove('prev')
        //             --pv


        //         boxs2[pv].classList.remove('next')
        //         boxs2[pv].classList.remove('activee')
        //         n2um = 0

        //     }

        // }

        // function startTime3() {
        //     let boxs = document.getElementsByClassName('box3');





        //     // other div0
        //     if (n3um != 0) {
        //         let n3um3 = n3um;
        //         let n3um4 = n3um;
        //         let pr = n3um;


        //         if (boxs[boxs.length - 1].classList.contains('prev')) {
        //             boxs[boxs.length - 1].classList.remove('prev')
        //         } else {
        //             pr -= 2
        //             boxs[pr].classList.remove('prev')
        //             boxs[pr].classList.remove('next')
        //         }
        //         --n3um3
        //         boxs[n3um3].classList.replace('activee', 'prev')
        //         boxs[n3um].classList.replace('next', 'activee')

        //         // boxs[n3um].classList.add('activee')

        //         if (n3um != boxs.length - 1) {
        //             boxs[++n3um4].classList.add('next')
        //         }


        //     }

        //     //first div
        //     else {

        //         boxs[n3um].classList.remove('next');

        //         if (boxs[boxs.length - 1].classList.contains('activee')) {
        //             boxs[boxs.length - 1].classList.remove('activee')
        //             boxs[boxs.length - 2].classList.remove('prev')
        //         }
        //         boxs[boxs.length - 1].classList.add('prev')
        //         boxs[n3um].classList.add('activee')

        //         let n3um2 = n3um;
        //         ++n3um2
        //         boxs[n3um2].classList.add('next')
        //     }

        //     if (n3um === boxs.length - 1) {
        //         boxs[0].classList.remove('activee')
        //         boxs[0].classList.add('next')
        //     }

        //     n3um++


        //     if (n3um === boxs.length) {
        //         let pv = boxs.length - 1
        //         boxs[boxs.length - 1].classList.remove('next')
        //         boxs[boxs.length - 1].classList.remove('prev')
        //             --pv


        //         boxs[pv].classList.remove('next')
        //         boxs[pv].classList.remove('activee')
        //         n3um = 0

        //     }

        // }

    }

    function startTime1(up = null) {
        let boxs1 = document.getElementsByClassName('box1');

        if (up) {
            let nextIndex = n1um;
            let nextNextIndex = n1um;
            nextNextIndex += 2;
            // console.log(++nextIndex);
            // console.log(n1um);
            boxs1[n1um].classList.replace('activee', 'prev');
            boxs1[++nextIndex].classList.replace('next', 'activee');
            boxs1[nextNextIndex].classList.add('next');

            // ........................................................................

        } else {
            if (n1um != 0) {
                // when other index
                let n1um3 = n1um;
                let n1um4 = n1um;
                let pr = n1um;

                if (boxs1[boxs1.length - 1].classList.contains('prev')) {
                    boxs1[boxs1.length - 1].classList.remove('prev');
                } else {
                    pr -= 2;
                    boxs1[pr].classList.remove('prev');
                    boxs1[pr].classList.remove('next');
                }

                --n1um3;
                boxs1[n1um3].classList.replace('activee', 'prev');
                boxs1[n1um].classList.replace('next', 'activee');

                if (n1um != boxs1.length - 1) {
                    boxs1[++n1um4].classList.add('next');
                }
            } else {
                // when is first index
                boxs1[n1um].classList.remove('next');


                if (boxs1[boxs1.length - 1].classList.contains('activee')) {
                    boxs1[boxs1.length - 1].classList.remove('activee');
                    boxs1[boxs1.length - 2].classList.remove('prev');
                }

                boxs1[boxs1.length - 1].classList.add('prev');
                boxs1[n1um].classList.add('activee');

                let n1um2 = n1um;
                ++n1um2;
                boxs1[n1um2].classList.add('next');
            }

            // when index is equal to end
            if (n1um === boxs1.length - 1) {
                boxs1[0].classList.remove('activee');
                boxs1[0].classList.add('next');
            }


            // update index
            n1um++;


            // reset index
            if (n1um === boxs1.length) {
                let pv = boxs1.length - 1;
                boxs1[boxs1.length - 1].classList.remove('next');
                boxs1[boxs1.length - 1].classList.remove('prev');
                --pv;

                boxs1[pv].classList.remove('next');
                boxs1[pv].classList.remove('activee');
                n1um = 0;
            }
        }





    }








    function startTime2(up = null) {
        let boxs2 = document.getElementsByClassName('box2');





        // other div0
        if (n2um != 0) {
            let n2um3 = n2um;
            let n2um4 = n2um;
            let pr = n2um;


            if (boxs2[boxs2.length - 1].classList.contains('prev')) {
                boxs2[boxs2.length - 1].classList.remove('prev')
            } else {
                pr -= 2
                boxs2[pr].classList.remove('prev')
                boxs2[pr].classList.remove('next')
            }
            --n2um3
            boxs2[n2um3].classList.replace('activee', 'prev')
            boxs2[n2um].classList.replace('next', 'activee')

            // boxs[n2um].classList.add('activee')

            if (n2um != boxs2.length - 1) {
                boxs2[++n2um4].classList.add('next')
            }


        }

        //first div
        else {

            boxs2[n2um].classList.remove('next');

            if (boxs2[boxs2.length - 1].classList.contains('activee')) {
                boxs2[boxs2.length - 1].classList.remove('activee')
                boxs2[boxs2.length - 2].classList.remove('prev')
            }
            boxs2[boxs2.length - 1].classList.add('prev')
            boxs2[n2um].classList.add('activee')

            let n2um2 = n2um;
            ++n2um2
            boxs2[n2um2].classList.add('next')
        }

        if (n2um === boxs2.length - 1) {
            boxs2[0].classList.remove('activee')
            boxs2[0].classList.add('next')
        }

        n2um++


        if (n2um === boxs2.length) {
            let pv = boxs2.length - 1
            boxs2[boxs2.length - 1].classList.remove('next')
            boxs2[boxs2.length - 1].classList.remove('prev')
                --pv


            boxs2[pv].classList.remove('next')
            boxs2[pv].classList.remove('activee')
            n2um = 0

        }

    }

    function startTime3(up = null) {
        let boxs = document.getElementsByClassName('box3');





        // other div0
        if (n3um != 0) {
            let n3um3 = n3um;
            let n3um4 = n3um;
            let pr = n3um;


            if (boxs[boxs.length - 1].classList.contains('prev')) {
                boxs[boxs.length - 1].classList.remove('prev')
            } else {
                pr -= 2
                boxs[pr].classList.remove('prev')
                boxs[pr].classList.remove('next')
            }
            --n3um3
            boxs[n3um3].classList.replace('activee', 'prev')
            boxs[n3um].classList.replace('next', 'activee')

            // boxs[n3um].classList.add('activee')

            if (n3um != boxs.length - 1) {
                boxs[++n3um4].classList.add('next')
            }


        }

        //first div
        else {

            boxs[n3um].classList.remove('next');

            if (boxs[boxs.length - 1].classList.contains('activee')) {
                boxs[boxs.length - 1].classList.remove('activee')
                boxs[boxs.length - 2].classList.remove('prev')
            }
            boxs[boxs.length - 1].classList.add('prev')
            boxs[n3um].classList.add('activee')

            let n3um2 = n3um;
            ++n3um2
            boxs[n3um2].classList.add('next')
        }

        if (n3um === boxs.length - 1) {
            boxs[0].classList.remove('activee')
            boxs[0].classList.add('next')
        }

        n3um++


        if (n3um === boxs.length) {
            let pv = boxs.length - 1
            boxs[boxs.length - 1].classList.remove('next')
            boxs[boxs.length - 1].classList.remove('prev')
                --pv


            boxs[pv].classList.remove('next')
            boxs[pv].classList.remove('activee')
            n3um = 0

        }

    }


    function up(which) {

        switch (which) {
            case "startTime1":
                startTime1('up')

                break;
            case "startTime2":
                startTime2('up')
                break;
            case "startTime3":
                startTime3('up')
                break;

            default:
                break;
        }
    }


    function down(which) {


        switch (which) {
            case "startTime1":
                startTime1()

                console.log('asdsads')
                break;
            case "startTime2":
                startTime2()
                break;
            case "startTime3":
                startTime3()
                break;

            default:
                break;
        }
    }
</script>


<div class="container mt-3">
    <a href="{{ route('Vendors.list') }}" class=" text-center ">
        <h2 style="font-family:'dastnevis' !important;">فروشندگان</h2>
    </a>
</div>


<div id="exTab3" class="container pt-4">
    <ul class="nav  nav-tabs">
        <li class="activetab1" style="border: 1px solid #9e9a9a; background-color: #ffff; padding:15px; color:black;">
            <a class="iransansmedium tabfontsizeproduct" id="spcV" style="color:#000;"
                onclick="  
                  $('.activetab2').removeClass('activetab2'); $('.activetab3').removeClass('activetab3'); $(this).parent().addClass('activetab1');
                  $('#4').removeClass('tab-pane'); 
                  $('#6').addClass('tab-pane'); 
                  $('#5').addClass('tab-pane');
                  "
                data-toggle="tab">برگزیده</a>
        </li>
        <li style="border: 1px solid #9e9a9a; background-color: #ffff; padding:15px;">
            <a class="iransansmedium tabfontsizeproduct" id="mahV" style="color:black;"
                onclick="    $('.activetab1').removeClass('activetab1');$('.activetab3').removeClass('activetab3'); $(this).parent().addClass('activetab2'); 
                  $('#5').removeClass('tab-pane'); 
                  $('#4').addClass('tab-pane'); 
                  $('#6').addClass('tab-pane'); 


                  "
                data-toggle="tab">محبوب</a>
        </li>
        <li style="border:1px solid #9e9a9a; background-color: #ffff; padding:15px;">
            <a class="iransansmedium tabfontsizeproduct" id="mosV" style="color:black;"
                onclick="   $('.activetab1').removeClass('activetab1');$('.activetab2').removeClass('activetab2'); $(this).parent().addClass('activetab3'); 
                  $('#6').removeClass('tab-pane'); 
                  $('#4').addClass('tab-pane'); 
                  $('#5').addClass('tab-pane');
                      "
                data-toggle="tab">پرمحصول</a>
        </li>
    </ul>

    {{-- @dd($specialVendors); --}}
    <div class="tab-content " style="">
        <div class=" active1" id="4">

            <div class="tabvizhe bargozide-tab mb-3"
                style="">

                <div class="ven-section row align-items-center">


                    <img loading="lazy" src="{{ url(env('PRODUCT_WHITEMANS') . 'superman.gif') }}"
                        class="whitemanproductgif whitemanproductgif-vendor img-fluid " style="" alt="">

                </div>

                <div class="row ven-big-sec" style="position: relative;">



                    <div class="">




                        <div class="container  mt-desktop-home-slider55 width-vendor-slider ">



                            <div class="vendor-slider-container slider-moteharek-container">
                                <span class="vendor-arrow-left"></span>
                                <span class="vendor-arrow-right"></span>
                                <div class="vendor-slider slider-moteharek" id="vendor-slider">





                                    @for ($i = 0; $i < count($specialVendors); $i++)
                                        <div class="vendor-slide  border-25  bg-white">


                                            @if (!is_null($specialVendors[$i]->vendor))
                                                <div class="">
                                                    <img loading="lazy"
                                                        style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:60px; height:60px;"class="shadow-none"
                                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $specialVendors[$i]->vendor->avatar) }}"
                                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $specialVendors[$i]->vendor->name) }}"
                                                        alt="" />


                                                    <a style=" color:black; font-size:20px; padding:10px;  "
                                                        href="{{ route('vendor.home', ['vendor' => $specialVendors[$i]->vendor->name]) }}"
                                                        class="vendor-title-abs fw-bold ">
                                                        {{ $specialVendors[$i]->vendor->title }}
                                                    </a>





                                                </div>



                                                <div style="overflow-x:scroll;white-space: nowrap;  "
                                                    class="vendorproducts d-block p-2 p-md-1">

                                                    @foreach ($specialVendors[$i]->vendor->home_products as $product)
                                                        <!-- Card image -->
                                                        <a class="card p-1 d-inline-block" style="width:100px; "
                                                            href="{{ route('products.show', ['product' => $product->slug]) }}">


                                                            <div class=""
                                                                style=" text-align: center; border-radius: 10px;   ">
                                                                <div style="max-width: 100%;height:100px; text-align: center;"
                                                                    class="">

                                                                    <img class=""
                                                                        style="max-width: 100%; height:inherit;border-radius: 10px;object-fit: cover;width:100%;"
                                                                        alt="{{ $product->name }}"
                                                                        src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                                        data-loaded="true">



                                                                </div>

                                                                <div class="">
                                                                    <!-- Title -->
                                                                    <p class="iransansmedium text-truncate mb-0 px-1 py-2 fw-bold text-center"
                                                                        style="font-size:10px;">


                                                                        {{ $product->name }}

                                                                    </p>
                                                                    <!-- Button -->
                                                                    <?php if($product->product_price !=null ) { ?>
                                                                    <p class="iransansmedium fw-bold"
                                                                        style="width: 100%; text-align:center !important; font-size:9px;">
                                                                        قیمت
                                                                        <small
                                                                            style="width: 100%; text-align:start !important; font-size:9px;"
                                                                            class="text-center texr-danger fw-bold text-truncate px-1">
                                                                            {{ $product->product_price }}
                                                                        </small>
                                                                        تومان
                                                                    </p>
                                                                    <?php }else{ ?>
                                                                    <p class="iransansmedium text-truncate fw-bold px-1 text-center"
                                                                        style="width: 100%; text-align:center !important;  font-size:9px;">
                                                                        قیمت : -
                                                                    </p>
                                                                    <?php } ?>


                                                                </div>




                                                            </div>

                                                        </a>
                                                    @endforeach


                                                </div>
                                            @endif



                                        </div>
                                    @endfor


                                </div>
                               
                            </div>
                        </div>
                    </div>



                </div>



            </div>

        </div>






        <!-- other tabs -->
        <div class="tab-pane" id="5">

            <div class="tabvizhe mahboob-tab mb-3"
                >
                <div class="ven-section row align-items-center">


                    <img loading="lazy" src="{{ url(env('PRODUCT_WHITEMANS') . 'sabz.gif') }}"
                        class="whitemanproductgif whitemanproductgif-vendor img-fluid " style="width:80%;" alt="">
                </div>

                <div class="row ven-big-sec" style="position: relative;">



                    <div>


                        <div class="container  mt-desktop-home-slider55 width-vendor-slider ">



                            <div class="mahboob-slider-container slider-moteharek-container">
                                <span class="mahboob-arrow-left"></span>
                                <span class="mahboob-arrow-right"></span>
                                <div class="mahboob-slider slider-moteharek" id="mahboob-slider">





                                    @for ($i = 0; $i < count($popularVendorrs); $i++)
                                        <div class="mahboob-slide border-25   bg-white">


                                            <div class=" bg-white  border-25 p-2  " style="">


                                                <div class="">
                                                    <img loading="lazy"
                                                        style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:60px; height:60px;"class="shadow-none"
                                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->avatar) }}"
                                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->name) }}"
                                                        alt="" />


                                                    <a style=" color:black; font-size:20px; padding:10px "
                                                        href="{{ route('vendor.home', ['vendor' => $popularVendorrs[$i]->name]) }}"
                                                        class="vendor-title-abs fw-bold">
                                                        {{ $popularVendorrs[$i]->title }}
                                                    </a>






                                                </div>



                                                <div
                                                    style=" overflow-x:scroll;white-space: nowrap;  "class="vendorproducts d-block p-2 p-md-1">

                                                    @foreach ($popularVendorrs[$i]->home_products as $product)
                                                        <!-- Card image -->
                                                        <a class="card p-1 d-inline-block" style="width:100px; "
                                                            href="{{ route('products.show', ['product' => $product->slug]) }}">
                                                            <div style="max-width: 100%;height:100px; text-align: center;"
                                                                class="">
                                                                <img class=""
                                                                    style="max-width: 100%; height:inherit;border-radius: 10px;object-fit: cover;width:100%;"
                                                                    alt="{{ $product->name }}"
                                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                                    data-loaded="true">



                                                            </div>

                                                            <div class="">
                                                                <!-- Title -->
                                                                <p class="iransansmedium text-truncate mb-0 px-1 py-2 fw-bold text-center"
                                                                    style="font-size:10px;">


                                                                    {{ $product->name }}

                                                                </p>
                                                                <!-- Button -->
                                                                <?php if($product->product_price !=null ) { ?>
                                                                <p class="iransansmedium text-truncate fw-bold px-1 text-center"
                                                                    style="font-size:9px;">
                                                                    قیمت
                                                                    <small
                                                                        style="width: 100%; text-align:center !important; font-size:9px;"
                                                                        class="text-center fw-bold texr-danger">
                                                                        {{ $product->product_price }}
                                                                    </small>
                                                                    تومان
                                                                </p>
                                                                <?php }else{ ?>
                                                                <p class="iransansmedium fw-bold text-truncate px-1 text-center"
                                                                    style="width: 100%; text-align:center !important;  font-size:9px;">
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
                                
                            </div>
                        </div>








                    </div>







                </div>
            </div>
        </div>
        <div class="tab-pane" id="6">
            <div class="tabvizhe pormahsol-tab mb-3">
                <div class="ven-section row align-items-center">


                    <img loading="lazy" src="{{ url(env('PRODUCT_WHITEMANS') . 'charkh.gif') }}"
                        class="whitemanproductgif whitemanproductgif-vendor img-fluid " style="" alt="">

                </div>






                <div class="row ven-big-sec" style="position: relative;">



                    <div>


                        <div class="container  mt-desktop-home-slider55 width-vendor-slider ">



                            <div class="mostproduct-slider-container slider-moteharek-container">
                                <span class="mostproduct-arrow-left"></span>
                                <span class="mostproduct-arrow-right"></span>
                                <div class="mostproduct-slider slider-moteharek" id="mostproduct-slider">





                                    @for ($i = 0; $i < count($most_product_vendors); $i++)
                                        <div class="mostproduct-slide border-25   bg-white">


                                            <div class=" bg-white  border-25 p-2  " style="">


                                                <div class="">
                                                    <img loading="lazy"
                                                        style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:60px; height:60px;"class="shadow-none"
                                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $most_product_vendors[$i]->avatar) }}"
                                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $most_product_vendors[$i]->name) }}"
                                                        alt="" />


                                                    <a style=" color:black; font-size:20px; padding:10px "
                                                        href="{{ route('vendor.home', ['vendor' => $most_product_vendors[$i]->name]) }}"
                                                        class="vendor-title-abs fw-bold">
                                                        {{ $most_product_vendors[$i]->title }}
                                                    </a>






                                                </div>



                                                <div
                                                    style=" overflow-x:scroll;white-space: nowrap;  "class="vendorproducts d-block p-2 p-md-1">

                                                    @foreach ($most_product_vendors[$i]->home_products as $product)
                                                        <!-- Card image -->
                                                        <a class="card p-1 d-inline-block" style="width:100px; "
                                                            href="{{ route('products.show', ['product' => $product->slug]) }}">
                                                            <div style="max-width: 100%;height:100px; text-align: center;"
                                                                class="">
                                                                <img class=""
                                                                    style="max-width: 100%; height:inherit;border-radius: 10px;object-fit: cover;width:100%;"
                                                                    alt="{{ $product->name }}"
                                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                                    data-loaded="true">



                                                            </div>

                                                            <div class="">
                                                                <!-- Title -->
                                                                <p class="iransansmedium text-truncate mb-0 px-1 py-2 fw-bold text-center"
                                                                    style="font-size:10px;">


                                                                    {{ $product->name }}

                                                                </p>
                                                                <!-- Button -->
                                                                <?php if($product->product_price !=null ) { ?>
                                                                <p class="iransansmedium text-truncate fw-bold px-1 text-center"
                                                                    style="font-size:9px;">
                                                                    قیمت
                                                                    <small
                                                                        style="width: 100%; text-align:center !important; font-size:9px;"
                                                                        class="text-center fw-bold texr-danger">
                                                                        {{ $product->product_price }}
                                                                    </small>
                                                                    تومان
                                                                </p>
                                                                <?php }else{ ?>
                                                                <p class="iransansmedium text-truncate fw-bold px-1 text-center"
                                                                    style="width: 100%; text-align:center !important;  font-size:9px;">
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
                                
                            </div>
                        </div>








                    </div>







                </div>


            </div>

        </div>
    </div>
</div>
