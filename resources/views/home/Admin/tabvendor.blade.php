<style>
    .vendorsss {
        margin-top: 33px !important;
    }




    .vendorsss .active {

        scale: 1.3;



        background-color: #ffff;
        padding: 0px !important;

        margin-left: 10px !important;


        border: none !important;

        margin-right: 10px !important;


        height: 30px !important;
        border-radius: 10% 10% 0px 0px !important;
        margin-top: 10px !important;




    }

    #scrolllll::-webkit-scrollbar {
        display: none;
    }

    @keyframes anim1 {
        0% {
            transform: scale(1);
            /* z-index: 1; */
            height: 100px;

        }



        100% {
            transform: scale(1.3);
            /* z-index: 100; */
            height: 250px;
            /* opacity: 1; */
        }
    }

    @keyframes anim2 {
        0% {
            transform: scale(1.3);
            /* z-index: 100; */
            height: 250px;

        }

        30% {
            opacity: .8;
        }

        to {
            transform: scale(1);
            /* z-index: 1; */
            height: 100px;
            opacity: 1;

        }
    }

    @keyframes nonedisplay {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .containner {
        margin: 20px auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }


    .box {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }




    .box1 {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }


    .box2 {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }

    .box3 {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }



    .prev {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;

        align-items: flex-start !important;
        padding: 0 !important;
    }

    .prev1 {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;

        align-items: flex-start !important;
        padding: 0 !important;
    }

    .prev2 {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;

        align-items: flex-start !important;
        padding: 0 !important;
    }

    .prev3 {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;

        align-items: flex-start !important;
        padding: 0 !important;
    }

    .next {
        order: 3;
        display: flex;

        padding: 15px;
        align-items: flex-end;

    }

    .next1 {
        order: 3;
        display: flex;

        padding: 15px;
        align-items: flex-end;

    }

    .next2 {
        order: 3;
        display: flex;

        padding: 15px;
        align-items: flex-end;

    }

    .next3 {
        order: 3;
        display: flex;

        padding: 15px;
        align-items: flex-end;

    }

    .activee {
        animation: anim1 forwards 1s;
        order: 2;
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }

    .activee1 {
        animation: anim1 forwards 1s;
        order: 2;[
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }

    .activee2 {
        animation: anim1 forwards 1s;
        order: 2;
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }

    .activee3 {
        animation: anim1 forwards 1s;
        order: 2;
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }


    .activee .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }

    .activee1 .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }


    .activee2 .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }


    .activee3 .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }


    .active #spcV {
        padding: 10px;
        width: 100% !important;
        height: 100% !important;
        background-color: #bdd9ed !important;


        border-radius: 10%;


    }



    .active #mahV {

        border-radius: 10%;
        padding: 10px;
        width: 100% !important;
        height: 100% !important;
        background-color: #3daaf8 !important;




    }


    .active #mosV {

        border-radius: 10%;
        padding: 10px;
        width: 100% !important;
        height: 100% !important;
        background-color: #0887e2 !important;




    }



    /* Chrome, Safari and Opera */
</style>




<style>
    .ven-section {
        height: 100%;
        width: 30%;
    }

    @media only screen and (max-width: 767px) {



        .ven-section {
            display: none;
        }




    }
</style>



<script>
    var time1;
    var time2;
    var time3;


    window.onload = function() {

        let num = 0;



        var prev = document.querySelectorAll('.prev');
        var activee = document.querySelectorAll('.activee');
        var next = document.querySelectorAll('.next');



        prev.forEach(element => {
            element.classList.remove('prev')

        });

        activee.forEach(element => {
            element.classList.remove('activee')

        });
        next.forEach(element => {
            element.classList.remove('next')

        });



        clearInterval(time2);

        clearInterval(time1);
        clearInterval(time3);

        time1 = setInterval(() => {

            startTime()

        }, 4000)







        function startTime() {
            let boxs = document.getElementsByClassName('box1');

            // other div
            if (num != 0) {
                let num3 = num;
                let num4 = num;
                let pr = num;


                if (boxs[boxs.length - 1].classList.contains('prev')) {
                    boxs[boxs.length - 1].classList.remove('prev')
                } else {
                    pr -= 2
                    boxs[pr].classList.remove('prev')
                    boxs[pr].classList.remove('next')
                }
                --num3
                boxs[num3].classList.replace('activee', 'prev')

                boxs[num].classList.add('activee')

                if (num != boxs.length - 1) {
                    boxs[++num4].classList.add('next')
                }


            }

            //first div
            else {

                if (boxs[boxs.length - 1].classList.contains('activee')) {
                    boxs[boxs.length - 1].classList.remove('activee')
                    boxs[boxs.length - 2].classList.remove('prev')
                }
                boxs[boxs.length - 1].classList.add('prev')
                boxs[num].classList.add('activee')

                let num2 = num;
                ++num2
                boxs[num2].classList.add('next')
            }

            if (num === boxs.length - 1) {
                boxs[0].classList.remove('activee')
                boxs[0].classList.add('next')
            }

            num++

            if (num === boxs.length) {
                let pv = boxs.length - 1
                boxs[boxs.length - 1].classList.remove('next')
                boxs[boxs.length - 1].classList.remove('prev')
                    --pv

                boxs[pv].classList.remove('next')
                boxs[pv].classList.remove('activee')
                num = 0

            }

        }





    }

    function spceial() {

        let num = 0;



        var prev = document.querySelectorAll('.prev');
        var activee = document.querySelectorAll('.activee');
        var next = document.querySelectorAll('.next');



        prev.forEach(element => {
            element.classList.remove('prev')

        });

        activee.forEach(element => {
            element.classList.remove('activee')

        });
        next.forEach(element => {
            element.classList.remove('next')

        });



        clearInterval(time2);

        clearInterval(time3);

        time1 = setInterval(() => {

            startTime()

        }, 4000)







        function startTime() {
            let boxs = document.getElementsByClassName('box1');




            // other div
            if (num != 0) {
                let num3 = num;
                let num4 = num;
                let pr = num;


                if (boxs[boxs.length - 1].classList.contains('prev')) {
                    boxs[boxs.length - 1].classList.remove('prev')
                } else {
                    pr -= 2
                    boxs[pr].classList.remove('prev')
                    boxs[pr].classList.remove('next')
                }
                --num3
                boxs[num3].classList.replace('activee', 'prev')

                boxs[num].classList.add('activee')

                if (num != boxs.length - 1) {
                    boxs[++num4].classList.add('next')
                }


            }

            //first div
            else {

                if (boxs[boxs.length - 1].classList.contains('activee')) {
                    boxs[boxs.length - 1].classList.remove('activee')
                    boxs[boxs.length - 2].classList.remove('prev')
                }
                boxs[boxs.length - 1].classList.add('prev')
                boxs[num].classList.add('activee')

                let num2 = num;
                ++num2
                boxs[num2].classList.add('next')
            }

            if (num === boxs.length - 1) {
                boxs[0].classList.remove('activee')
                boxs[0].classList.add('next')
            }

            num++

            if (num === boxs.length) {
                let pv = boxs.length - 1
                boxs[boxs.length - 1].classList.remove('next')
                boxs[boxs.length - 1].classList.remove('prev')
                    --pv

                boxs[pv].classList.remove('next')
                boxs[pv].classList.remove('activee')
                num = 0

            }

        }
    }

    function mahboobbb() {
        let num = 0;


        var prev = document.querySelectorAll('.prev');
        var activee = document.querySelectorAll('.activee');
        var next = document.querySelectorAll('.next');




        prev.forEach(element => {
            element.classList.remove('prev')

        });

        activee.forEach(element => {
            element.classList.remove('activee')

        });
        next.forEach(element => {
            element.classList.remove('next')

        });


        clearInterval(time2);

        clearInterval(time1);



        time2 = setInterval(() => {

            startTime()

        }, 4000)


        function startTime() {
            let boxs = document.getElementsByClassName('box2');

            // other div
            if (num != 0) {
                let num3 = num;
                let num4 = num;
                let pr = num;


                if (boxs[boxs.length - 1].classList.contains('prev')) {
                    boxs[boxs.length - 1].classList.remove('prev')
                } else {
                    pr -= 2
                    boxs[pr].classList.remove('prev')
                    boxs[pr].classList.remove('next')
                }
                --num3
                boxs[num3].classList.replace('activee', 'prev')

                boxs[num].classList.add('activee')

                if (num != boxs.length - 1) {
                    boxs[++num4].classList.add('next')
                }


            }

            //first div
            else {

                if (boxs[boxs.length - 1].classList.contains('activee')) {
                    boxs[boxs.length - 1].classList.remove('activee')
                    boxs[boxs.length - 2].classList.remove('prev')
                }
                boxs[boxs.length - 1].classList.add('prev')
                boxs[num].classList.add('activee')

                let num2 = num;
                ++num2
                boxs[num2].classList.add('next')
            }

            if (num === boxs.length - 1) {
                boxs[0].classList.remove('activee')
                boxs[0].classList.add('next')
            }

            num++

            if (num === boxs.length) {
                let pv = boxs.length - 1
                boxs[boxs.length - 1].classList.remove('next')
                boxs[boxs.length - 1].classList.remove('prev')
                    --pv

                boxs[pv].classList.remove('next')
                boxs[pv].classList.remove('activee')
                num = 0

            }

        }
    }

    function most_ppp() {
        let num = 0;


        var prev = document.querySelectorAll('.prev');
        var activee = document.querySelectorAll('.activee');
        var next = document.querySelectorAll('.next');



        prev.forEach(element => {
            element.classList.remove('prev')

        });

        activee.forEach(element => {
            element.classList.remove('activee')

        });
        next.forEach(element => {
            element.classList.remove('next')

        });


        clearInterval(time1);

        clearInterval(time2);


        console.log(',wqwdasd');
        time3 = setInterval(() => {

            startTime()

        }, 4000)


        function startTime() {
            let boxs = document.getElementsByClassName('box3');




            // other div
            if (num != 0) {
                let num3 = num;
                let num4 = num;
                let pr = num;


                if (boxs[boxs.length - 1].classList.contains('prev')) {
                    boxs[boxs.length - 1].classList.remove('prev')
                } else {
                    pr -= 2
                    boxs[pr].classList.remove('prev')
                    boxs[pr].classList.remove('next')
                }
                --num3
                boxs[num3].classList.replace('activee', 'prev')

                boxs[num].classList.add('activee')

                if (num != boxs.length - 1) {
                    boxs[++num4].classList.add('next')
                }


            }

            //first div
            else {

                if (boxs[boxs.length - 1].classList.contains('activee')) {
                    boxs[boxs.length - 1].classList.remove('activee')
                    boxs[boxs.length - 2].classList.remove('prev')
                }
                boxs[boxs.length - 1].classList.add('prev')
                boxs[num].classList.add('activee')

                let num2 = num;
                ++num2
                boxs[num2].classList.add('next')
            }

            if (num === boxs.length - 1) {
                boxs[0].classList.remove('activee')
                boxs[0].classList.add('next')
            }

            num++

            if (num === boxs.length) {
                let pv = boxs.length - 1
                boxs[boxs.length - 1].classList.remove('next')
                boxs[boxs.length - 1].classList.remove('prev')
                    --pv

                boxs[pv].classList.remove('next')
                boxs[pv].classList.remove('activee')
                num = 0

            }

        }
    }
</script>


{{-- فروشگاه ها شروع --}}
<div class="container" style="margin-top:33px !important;">
    <h2>فروشندگان</h2>
</div>



<form method="POST" id="HomeEditVendorsStatus" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}">

    @csrf

    <div class="">

        <label class="switch">

            <input type="hidden" name="vndr" value="1">

            <input name="HomeVndrs" type="checkbox" id="produtController" style="display: none;"
                onchange="$('#HomeEditVendorsStatus').submit();" @if ($setting->vendors) checked @endif>
            <span class="round"></span>
        </label>

    </div>

</form>




<div id="exTab3" class="container py-4">
    <ul style="margin-right: 20px;" class="nav vendorsss nav-tabs
    
    

    
    
    
    ">
        <li class="active" style="border: 1px solid #9e9a9a; background-color: #ffff; padding:10px; color:black;">
            <a href="#4" id="spcV" style="color:black;"
                onclick="     spceial();  ('.active').removeClass('active'); $(this).parent().addClass('active');  "
                data-toggle="tab">برگزیده</a>
        </li>
        <li style="border: 1px solid #9e9a9a; background-color: #ffff; padding:10px;">
            <a href="#5" id="mahV" style="color:black;"
                onclick="   mahboobbb();  ('.active').removeClass('active'); $(this).parent().addClass('active');     "
                data-toggle="tab">محبوب</a>
        </li>
        <li style="border:1px solid #9e9a9a; background-color: #ffff; padding:10px;">
            <a href="#6" id="mosV" style="color:black;"
                onclick="  most_ppp(); ('.active').removeClass('active'); $(this).parent().addClass('active');       "
                data-toggle="tab">پرمحصول</a>
        </li>
    </ul>

    <div class="tab-content
    
    @if (!$setting->vendors) notttt @endif
    
    
    ">
        <div class="tab-pane active" id="4">

            <div class="tabvizhe"
                style="height: 500px; background-color: #bdd9ed; display: flex; justify-content: space-around ;
                box-shadow: 2px 2px 7px 2px #888888d3;">

                <div style="" class="ven-section">


                    <img src="{{ url(env('PRODUCT_WHITEMANS') . 'Blanc_superhero_fly.gif') }}"
                        class="whitemanproductgif" style="height: 100%; width:220px;" alt="">

                </div>

                <div class="row" style="width: 65%">


                    <div class="containner " style="display: flex; justify-content: space-between">


                        @for ($i = 0; $i < count($specialVendors); $i++)

                            <div class="col-12 bg-white box box1" style="">


                                <div class="" style="display: flex;  justify-content: center;  width: 100%;">
                                    <img style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:40px; height:40px;"class=""
                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $specialVendors[$i]->vendor->avatar) }}"
                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $specialVendors[$i]->vendor->name) }}"
                                        alt="" />


                                    <a style=" color:black; font-size:20px; padding:10px; width:150px "
                                        href="{{ route('vendor.home', ['vendor' => $specialVendors[$i]->vendor->name]) }}"
                                        class=" ">
                                        {{ $specialVendors[$i]->vendor->title }}
                                    </a>


                                    <div class="   " style="width: 50%; ">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>





                                    </div>

                                    {{-- <div id="Address">

                                        <a class="btn btn-outline-primary"
                                            style=" width:150px; border:1px solid blue; border-radius:10%;"
                                            href="{{ route('vendor.home', ['vendor' => $specialVendors[$i]->vendor->name]) }}">
                                            مشاهده
                                            فروشگاه</a>

                                    </div> --}}



                                </div>



                                <div style="margin:5px; opacity: 0;width: 100%;  "class="vendorproducts">

                                    @foreach ($specialVendors[$i]->vendor->home_products as $product)
                                        <!-- Card image -->
                                        <a class=" card"
                                            style="width: 150px !important; text-align: center; border-radius: 20px; display:flex; flex-direction: column; justify-content: space-between; padding:5%; height: 130px;"
                                            href="{{ route('products.show', ['vendor' => $specialVendors[$i]->vendor->name, 'product' => $product->slug]) }}">

                                            <div style="width: 100%; text-align: center;" class="">
                                                <img class="" style="width: 100%; height:80px; "
                                                    alt="{{ $product->name }}"
                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                    data-loaded="true">



                                            </div>

                                            <div class="">
                                                <!-- Title -->
                                                <p class="vazirFont" style="font-size:10px;">


                                                    {{ $product->name }}

                                                </p>
                                                <!-- Button -->
                                                <?php if($product->product_price !=null ) { ?>
                                                <p class="vazirFont"
                                                    style="width: 100%; text-align:center !important; font-size:10px;">
                                                    قیمت
                                                    <small
                                                        style="width: 100%; text-align:start !important; font-size:10px;"
                                                        class="text-center texr-danger">
                                                        {{ $product->product_price }}
                                                    </small>
                                                    تومان
                                                </p>
                                                <?php }else{ ?>
                                                <p class="vazirFont"
                                                    style="width: 100%; text-align:center !important;  font-size:10px;">
                                                    قیمت : -
                                                </p>
                                                <?php } ?>


                                            </div>
                                            <!--/ Card content -->
                                        </a>
                                    @endforeach


                                </div>

                            </div>
                        @endfor


                    </div>


                </div>
            </div>

        </div>
        <div class="tab-pane" id="5">

            <div class="tabvizhe"
                style="height: 500px; background-color: #3daaf8;  display: flex; justify-content: space-around ;box-shadow: 2px 2px 7px 2px #888888d3;">
                <div class="ven-section">


                    <img src="{{ url(env('PRODUCT_WHITEMANS') . '80769568.gif') }}" class="whitemanproductgif"
                        style="height:auto; width:
                    ;" alt="">
                </div>

                <div class="row" style="width: 65%">


                    <div class="containner " style="display: flex; justify-content: space-between">


                        @for ($i = 0; $i < count($popularVendorrs); $i++)

                            <div class="col-12 bg-white box box2 " style="">


                                <div class="" style="display: flex;  justify-content: center;  width: 100%;">
                                    <img style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover ; width:40px; height:40px;"class=""
                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->avatar) }}"
                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->name) }}"
                                        alt="" />


                                    <a style=" color:black; font-size:20px; padding:10px; width:150px "
                                        href="{{ route('vendor.home', ['vendor' => $popularVendorrs[$i]->name]) }}"
                                        class=" ">
                                        {{ $popularVendorrs[$i]->title }}
                                    </a>


                                    <div class="   " style="width: 50%; ">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>





                                    </div>

                                    <div id="Address">

                                        <a class="btn btn-outline-primary"
                                            style=" width:150px; border:1px solid blue; border-radius:10%;"
                                            href="{{ route('vendor.home', ['vendor' => $popularVendorrs[$i]->name]) }}">
                                            مشاهده
                                            فروشگاه</a>

                                    </div>



                                </div>



                                <div style="margin:5px; opacity: 0;width: 100%;  "class="vendorproducts">

                                    @foreach ($popularVendorrs[$i]->home_products as $product)
                                        <!-- Card image -->
                                        <a class=" card"
                                            style="width: 150px !important; text-align: center; border-radius: 20px; display:flex; flex-direction: column; justify-content: space-between; padding:5%; height: 130px;"
                                            href="{{ route('products.show', ['vendor' => $popularVendorrs[$i]->name, 'product' => $product->slug]) }}">
                                            <div style="width: 100%; text-align: center;" class="">
                                                <img class="" style="width: 100%; height:80px; "
                                                    alt="{{ $product->name }}"
                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                    data-loaded="true">



                                            </div>

                                            <div class="">
                                                <!-- Title -->
                                                <p class="vazirFont" style="font-size:10px;">


                                                    {{ $product->name }}

                                                </p>
                                                <!-- Button -->
                                                <?php if($product->product_price !=null ) { ?>
                                                <p class="vazirFont"
                                                    style="width: 100%; text-align:center !important; font-size:10px;">
                                                    قیمت
                                                    <small
                                                        style="width: 100%; text-align:start !important; font-size:10px;"
                                                        class="text-center texr-danger">
                                                        {{ $product->product_price }}
                                                    </small>
                                                    تومان
                                                </p>
                                                <?php }else{ ?>
                                                <p class="vazirFont"
                                                    style="width: 100%; text-align:center !important;  font-size:10px;">
                                                    قیمت : -
                                                </p>
                                                <?php } ?>


                                            </div>
                                            <!--/ Card content -->
                                        </a>
                                    @endforeach


                                </div>

                            </div>
                        @endfor


                    </div>






                </div>
            </div>
        </div>
        <div class="tab-pane" id="6">
            <div class="tabvizhe"
                style="height: 500px; background-color: #0887e2;  display: flex; justify-content: space-around;box-shadow: 2px 2px 7px 2px #888888d3;">
                <div class="ven-section">


                    <img src="{{ url(env('PRODUCT_WHITEMANS') . 'v_most_p.gif') }}" class="whitemanproductgif"
                        style="height: 100%; width:220px;" alt="">

                </div>

                <div class="row" style="width: 65%">


                    <div class="containner " style="display: flex; justify-content: space-between">


                        @for ($i = 0; $i < count($most_product_vendors); $i++)

                            <div class="col-12 bg-white box box3" style="">


                                <div class="" style="display: flex;  justify-content: center;  width: 100%;">
                                    <img style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:40px; height:40px;"class=""
                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $most_product_vendors[$i]->avatar) }}"
                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $most_product_vendors[$i]->name) }}"
                                        alt="" />


                                    <a style=" color:black; font-size:20px; padding:10px; width:150px "
                                        href="{{ route('vendor.home', ['vendor' => $most_product_vendors[$i]->name]) }}"
                                        class=" ">
                                        {{ $most_product_vendors[$i]->title }}
                                    </a>


                                    <div class="   " style="width: 50%; ">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>





                                    </div>

                                    <div id="Address">

                                        <a class="btn btn-outline-primary"
                                            style=" width:150px; border:1px solid blue; border-radius:10%;"
                                            href="{{ route('vendor.home', ['vendor' => $most_product_vendors[$i]->name]) }}">
                                            مشاهده
                                            فروشگاه</a>

                                    </div>



                                </div>



                                <div style="margin:5px; opacity: 0;width: 100%;  "class="vendorproducts">

                                    @foreach ($most_product_vendors[$i]->home_products as $product)
                                        <!-- Card image -->
                                        <a class=" card"
                                            style="width: 150px !important; text-align: center; border-radius: 20px; display:flex; flex-direction: column; justify-content: space-between; padding:5%; height: 130px;"
                                            href="{{ route('products.show', ['vendor' => $most_product_vendors[$i]->name, 'product' => $product->slug]) }}">
                                            <div style="width: 100%; text-align: center;" class="">
                                                <img class="" style="width: 100%; height:80px; "
                                                    alt="{{ $product->name }}"
                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                    data-loaded="true">



                                            </div>

                                            <div class="">
                                                <!-- Title -->
                                                <p class="vazirFont" style="font-size:10px;">


                                                    {{ $product->name }}

                                                </p>
                                                <!-- Button -->
                                                <?php if($product->product_price !=null ) { ?>
                                                <p class="vazirFont"
                                                    style="width: 100%; text-align:center !important; font-size:10px;">
                                                    قیمت
                                                    <small
                                                        style="width: 100%; text-align:start !important; font-size:10px;"
                                                        class="text-center texr-danger">
                                                        {{ $product->product_price }}
                                                    </small>
                                                    تومان
                                                </p>
                                                <?php }else{ ?>
                                                <p class="vazirFont"
                                                    style="width: 100%; text-align:center !important;  font-size:10px;">
                                                    قیمت : -
                                                </p>
                                                <?php } ?>


                                            </div>
                                            <!--/ Card content -->
                                        </a>
                                    @endforeach


                                </div>

                            </div>
                        @endfor


                    </div>


                </div>


            </div>

        </div>
    </div>
