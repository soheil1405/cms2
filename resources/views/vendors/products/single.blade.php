@if (Session::has('Session_rated_list_product'))


    <?php
    $rates_array = Session::get('Session_rated_list_product');
    // dd($rates_array);
    ?>



    @for ($i = 0; $i < count($rates_array); $i++)
        @if ($rates_array[$i]['product_id'] == $product->id)
            <?php $oldRated = $rates_array[$i]['rate']; ?>
        @endif
    @endfor

@endif






@extends('vendors.layouts.master')


@section('title', $product->name)



@section('metaTitle')
    {{ $product->name }}
@endsection


@section('description')
    {{ $metaDescription }}
@endsection

@section('image')
    {{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}
@endsection

@push('header_styles')
    @include('layouts.home.header.styles')
    <style>
        .hideScrollBar::-webkit-scrollbar {
            display: none;
        }

        body {
            overflow-x: hidden;
        }

        .vendorBoxItem {
            margin: 8px;
            padding-left: 8px;
        }

        .vendorVember {
            color: black;
        }

        .provider {

            height: 100%;
            border-left: 2px solid black;
        }

        .card-img-container {
            background: url(https://picsum.photos/300/300) center center no-repeat;
            background-size: cover;
            height: 200px;
            width: auto;
            border-radius: 5px 5px 0 0;
            filter: contrast(2) invert(0.2) sepia(0.7);
            transition: .4s all;
        }

        .card:hover .card-img-container {
            filter: none;
        }

        .card-text-container {
            padding: 20px;
            overflow: hidden;
        }

        .card-text-container.expanded {
            height: 500px;
        }

        .card-text-container h2,
        .card-text-container p {
            color: #13505c;
        }





        .card-link-container {
            height: 50px;
            position: absolute;
            bottom: 0;
            padding: 10px 20px 10px 20px;
        }

        .card-link-container a {
            color: #892f23;
            font-size: 18px;
            font-weight: bold;
        }

        .more-link:hover {
            cursor: pointer;
        }

        .filter-btn-row {
            text-align: center;
            margin-bottom: 30px;
        }

        .filter-btn {
            margin: 5px;
            width: 100px;
            font-size: 18px;
        }

        .selected {

            border: 2px solid #f0862c;
            color: #fff;
            box-shadow: none;
        }

        .card-location {
            display: none;
            font-weight: bold;
        }

        @media screen and (min-width: 0) and (max-width: 750px) {

            .vendorBoxItem {
                width: 100%;
                align-self: flex-start;
            }

            .vendorBox {
                display: flex;

                flex-direction: column;


            }

            .product-details-price {
                padding: 0px;
                margin: 0px;
                font-size: 13px;
            }

            .provider {
                display: none;
            }

            .btnjs {
                width: 150px !important;
            }




            .filtered-cards {
                padding: 0;
            }

            .product-details-content {

                padding: 0px auto !important;

            }

            .vazirFont {
                font-size: 12px !important;
            }

            .container {
                overflow: hidden;
            }


            .card {
                margin: 0px;
                margin-top: 5px;
                border-radius: 5px;
                text-align: left;

            }

            .filter-btn {
                width: 100px;
                font-size: 18px;
                margin: 10px;
            }

            .card-img-container {
                filter: none;

            }




            .TOPP {
                display: flex;
                flex-direction: column;


            }

            .allimgs {
                margin-bottom: 0px !important;

                height: 180px;
                border-bottom: 1px solid gray;
            }




            .product_nameee {
                font-size: 24px !important;
                padding: 30px !important;
            }

            .product_name1 {
                font-size: 18px !important;

                /* padding: 30px !important;      */
            }

            .otherimgsDiv {
                overflow-y: scroll;
            }



            .card:hover {
                box-shadow: 2px 3px 12px 0px rgba(248, 70, 70, 0.75);

            }

            .vazirFont {


                font-family: "vazir" !important;


            }

            .blur {
                background-color: rgba(0, 0, 0, 0.9);
                border-radius: 5px;
                font-family: sans-serif;
                text-align: center;
                -webkit-backdrop-filter: blur(25px);
                backdrop-filter: blur(25px);
                width: 80%;
                height: 80%;
                right: 13%;
                position: fixed;
                align-items: center;
                justify-content: center;
                color: #ffff;
                display: flex;

                z-index: 1000;
                top: 10%;

            }


            hr {
                width: 100%;
            }


            .blur span {
                padding: 20px;
                cursor: pointer;
            }

            .blur ul li span {
                color: red;
            }

            li {
                list-style-type: none;
            }

            .desc {
                padding: 30px;
                list-style-type: none;
            }

            .twice_ul {
                padding: 30px;
            }

            .desc {
                width: 100%;
                text-align: right;
            }

            .blur btn {
                width: 50px;
            }

            .show {
                display: block !important;
            }

            .ImagesView {
                display: none;

                max-width: 200px !important;
            }



            .otherimgsDiv {
                overflow-x: scroll;
                flex-direction: row !important;
            }

            .zoompro {
                height: 180px !important;

            }

            .mainproductImage {
                justify-content: center !important;

                object-fit: cover !important;
                margin: 0 auto;
            }



            .card {


                margin: 5px !important;
                height: 250px;
            }

            .productImgDiv {
                height: 150px;
            }

            .productImg {
                width: 100%;
                height: 150px;
                object-fit: center !important;
            }

            .product_nameee {
                padding: 5px;
                /* font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important; */

                font-size: 12px;
            }

            .normalFont {
                padding: 0px !important;
                margin: 0px !important;
            }



        }
































        .row>.column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Create four equal columns that floats next to eachother */
        .column {
            float: left;
            width: 25%;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: black;
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .close {
            color: white;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }


        /* parent of book-container & container (slider) */
        main {
            overflow: hidden;
            display: flex;
            justify-content: space-between;
        }

        /* wraps entire slider */
        .slider-wrapper {
            overflow: hidden;
            width: 100%;
            position: relative;
        }

        .slider-nav {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            text-align: center;
            margin: 0;
            padding: 1%;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
        }

        /* slider controls*/
        .control {
            position: absolute;
            top: 50%;
            width: 40px;
            height: 10px;
            color: #fff;
            font-size: 3rem;
            padding: 0;
            margin: 0;
            line-height: 5px;
        }

        .prev,
        .next {
            cursor: pointer;
            transition: all 0.2s ease;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background: rgba(0, 0, 0, 0.3);
            padding: 1rem;
        }

        .prev {
            left: 1.1rem;
        }

        .next {
            right: 1.1rem;
        }

        .prev:hover,
        .next:hover {
            transform: scale(1.5, 1.5);
        }

        .slider-container {
            /*
                                                                                                                                                                                                                      n variable holds number of images to make .container wide enough
                                                                                                                                                                                                                      to hold all its image children
                                                                                                                                                                                                                      that still have the same width as its parent
                                                                                                                                                                                                                      */
            display: flex;
            align-items: center;
            overflow-y: hidden;
            width: 100%;
            /* fallback */
            width: calc(var(--n)*100%);
            height: 31vw;
            max-height: 100vh;
            transform: translate(calc(var(--i, 0)/var(--n)*-100% + var(--tx, 0px)));
        }

        /* transition animation for the slider */
        .smooth {
            /* f computes actual animation duration via JS */
            transition: transform calc(var(--f, 1)*.5s) ease-out;
        }

        /* images for the slider */
        img {
            width: 100%;
            /* can't take this out either as it breaks Chrome */
            width: calc(100%/var(--n));
            pointer-events: none;
        }

        .fullImageGallery {
            width: 100vw;
            display: none;
            height: 100vh;
            z-index: 100000000000000000000000000000000000;
            position: fixed !important;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.712);
            /* display: flex; */
            align-content: center;

        }

        .fullImageGallery.main {
            width: 75vw !important;
            height: 75vh !important;

        }


        .img-gallery-big {
            /* width: 100% !important; */
            height: auto;
            max-height: 800px;
        }

        @media screen and (max-width:720px) {
            .img-gallery-big {
                /* width: 100% !important; */
                height: auto;
                max-height: 4500px;
            }

        }
    </style>
  

    <script>
        function showImage(imgUrl) {

            $(".fullImageGallery").css("display", "flex");

            console.log(imgUrl)

            $("#mainImg").attr("src", imgUrl)

        }

        function closeimage() {

            $('.fullImageGallery').css('display', 'none');
        }

        $(document).ready(function() {

            var pageWidth = $(window).width();



            if (pageWidth > 750) {

                $("#mobileImgs").remove();
                console.log('bayad hazf she');


            } else {

                $("#descktopImgs").remove();

            }
        });

        // Open the Modal
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Close the Modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }


        function openimg(src) {


            var newSrc = src; /* problem line ?*/

            focus = document.getElementById('focus');

            console.log(focus);
            focus.src = newSrc;
            console.log(src);

            focusDiv = document.getElementById('focusDiv');
            focusDiv.style.display = "block";

        }


        function closeimg() {

            focusDiv.style.display = "none";


        }

        //  set --n (used for calc in CSS) via JS, after getting
        // .container and the number of child images it holds:

        const _C = document.querySelector(".slider-container"),
            N = _C.children.length;

        _C.style.setProperty("--n", N);

        // detect the direction of the motion between "touchstart" (or "mousedown") event
        // and the "touched" (or "mouseup") event
        // and then update --i (current slide) accordingly
        // and move the container so that the next image in the desired direction moves into the viewport

        // on "mousedown"/"touchstart", lock x-coordiate
        // and store it into an initial coordinate variable x0:
        let x0 = null;
        let locked = false;

        function lock(e) {
            x0 = unify(e).clientX;
            // remove .smooth class
            _C.classList.toggle("smooth", !(locked = true));
        }

        // next, make the images move when the user swipes:
        // was the lock action performed aka is x0 set?
        // if so, read current x coordiante and compare it to x0
        // from the difference between these two determine what to do next

        let i = 0; // counter
        let w; //image width

        // update image width w on resive
        function size() {
            w = window.innerWidth;
        }

        function move(e) {
            if (locked) {
                // set threshold of 20% (if less, do not drag to the next image)
                // dx = number of pixels the user dragged
                let dx = unify(e).clientX - x0,
                    s = Math.sign(dx),
                    f = +(s * dx / w).toFixed(2);

                // Math.sign(dx) returns 1 or -1
                // depending on this, the slider goes backwards or forwards

                if ((i > 0 || s < 0) && (i < N - 1 || s > 0) && f > 0.2) {
                    _C.style.setProperty("--i", (i -= s));
                    f = 1 - f;
                }

                _C.style.setProperty("--tx", "0px");
                _C.style.setProperty("--f", f);
                _C.classList.toggle("smooth", !(locked = false));
                x0 = null;
            }
        }

        size();

        addEventListener("resize", size, false);

        // ===============
        // drag-animation for the slider when it reaches the end
        // ===============

        function drag(e) {
            e.preventDefault();

            if (locked) {
                _C.style.setProperty("--tx", `${Math.round(unify(e).clientX - x0)}px`);
            }
        }

        // ===============
        // prev, next
        // ===============
        let prev = document.querySelector(".prev");
        let next = document.querySelector(".next");

        prev.addEventListener("click", () => {
            if (i == 0) {
                console.log("start reached");
            } else if (i > 0) {
                // decrease i as long as it is bigger than the number of slides
                _C.style.setProperty("--i", i--);
            }
        });

        next.addEventListener("click", () => {
            if (i < N) {
                // increase i as long as it's smaller than the number of slides
                _C.style.setProperty("--i", i++);
            }
        });

        // ===============
        // slider event listeners for mouse and touch (start, move, end)
        // ===============

        _C.addEventListener("mousemove", drag, false);
        _C.addEventListener("touchmove", drag, false);

        _C.addEventListener("mousedown", lock, false);
        _C.addEventListener("touchstart", lock, false);

        _C.addEventListener("mouseup", move, false);
        _C.addEventListener("touchend", move, false);

        // override Edge swipe behaviour
        _C.addEventListener(
            "touchmove",
            e => {
                e.preventDefault();
            },
            false
        );

        // unify touch and click cases:
        function unify(e) {
            return e.changedTouches ? e.changedTouches[0] : e;
        }
    </script>
@endpush


@push('header_scripts')
    @include('layouts.home.header.scripts')


@endpush


@push('headers')
    @include('layouts.home.header.head')
@endpush

@push('bodyClass', 'bg-body')



@push('contents')
   
    @if (count($product->avtiveImages) > 0)

        <div class="fullImageGallery ">
            <div style=" cursor:pointer; top:15px;right:35px;" class="position-absolute" onclick="closeimage()">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-x-circle-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                </svg>
            </div>
            <div class="row justify-content-center align-items-center w-100">

                <div class="moreImages p-4 col-md-2 col-12 d-flex flex-md-column " style="">
                    @foreach ($product->avtiveImages as $key => $img)
                        <div onclick="showImage(`{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH_ORIGINAL') . $img->image) }}`)"
                            class="">
                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $img->image) }}"
                                class="p-1 img-fluid img-thumb-gallery" alt="">
                        </div>
                    @endforeach
                </div>

                <div class="col-md-8 col-12 text-center">
                    <img id="mainImg" class="img-fluid img-gallery-big"
                        src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->avtiveImages[0]->image) }}"
                        alt="">
                </div>
                <div class="col-md-2"></div>

            </div>

        </div>

    @endif

    </script>
    @if (isset($vendorrr) && !is_null($vendorrr))
        @include('layouts.home.openstories2')
    @endif

    @if (session('SaveCommentSuccessfully'))
        <script>
            location.href = "#alert";
        </script>
    @endif




    {{-- for mobile --}}
    <div style="    margin-top:40px !important ;    width:100%; " class="container TOPP div-product-mob ">


        <div class="row pt-1">

            {{-- عکس ، امتیاز لایک اشتراک گذاری و ... --}}

            <div class="    col-sm-12 order-1 order-sm-1 order-md-1  ">


                @include('vendors.products.ProductImage')



                <div style="display: flex;" class="col-12  pb-5">
                    <div style="display: flex; flex-direction: column; width:100%;" class=" mainproductImage">

                        <div style="" class=" vazirFont pro-details-rating-wrap toolbarproduct row mt-4">

                            <div class="col-3">
                                {{-- تعداد بازدید  --}}

                                {{ $product->view_counter }}

                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16"
                                    onmouseover="$(this).next().css('display' , 'block')"
                                    onmouseout="$(this).next().css('display' , 'none')">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                <span
                                    style=" transition: all 0.4s; background-color: rgb(33, 32, 32); padding:5px; color:#efefef;position:absolute;display:none;margin-top:25px;margin-left:-250px;">

                                    بازدید این محصول

                                </span>
                            </div>
                            <div class="col-9 " style="text-align: left;">




                                <span title="مقایسه"
                                    onclick="addTocomp({{ $product->id }})
                                     "

                                     >
                                    <img src="{{ asset('main/tool/8373506.png') }}" width="30" height="30"
                                        alt="">
                                </span>

















                                <a title="اشتراک گذاری" onclick="copyToClipboard()">
                                    <img width="30" height="30"
                                        src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                                        alt="external-send-email-flatart-icons-outline-flatarticons" />
                                </a>


                                <span
                                    style=" transition: all 0.4s; background-color: rgb(33, 32, 32); padding:5px; color:#efefef;position:absolute;display:none;margin-top:25px;margin-left:-250px;">



                                </span>

                                <a href="#commentsection " style="color: #000;" title="دیدگاه ها">

                                    <svg width="25" height="25" style="" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="var(--ci-primary-color, currentColor)"
                                            d="M496,496H480a273.39,273.39,0,0,1-179.025-66.782l-16.827-14.584C274.814,415.542,265.376,416,256,416c-63.527,0-123.385-20.431-168.548-57.529C41.375,320.623,16,270.025,16,216S41.375,111.377,87.452,73.529C132.615,36.431,192.473,16,256,16S379.385,36.431,424.548,73.529C470.625,111.377,496,161.975,496,216a171.161,171.161,0,0,1-21.077,82.151,201.505,201.505,0,0,1-47.065,57.537,285.22,285.22,0,0,0,63.455,97L496,457.373ZM294.456,381.222l27.477,23.814a241.379,241.379,0,0,0,135,57.86,317.5,317.5,0,0,1-62.617-105.583v0l-4.395-12.463,9.209-7.068C440.963,305.678,464,262.429,464,216c0-92.636-93.309-168-208-168S48,123.364,48,216s93.309,168,208,168a259.114,259.114,0,0,0,31.4-1.913Z"
                                            class="ci-primary" />
                                    </svg>

                                </a>
                                @auth
                                    <small class="dissliked addToFAvorite_{{ $product->id }}" title="افزودن به علاقه مندی"
                                        onclick="addToFAvorite('p' , {{ $product->id }} ) "
                                        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) >= 1) style="display:none" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" style="color: #000;" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </small>

                                    <small class="liked removeFromFavorite{{ $product->id }}"
                                        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) < 1) style="display:none" @endif
                                        onclick="removeFromFavorite('p',{{ $product->id }})" title="حذف از علاقه مندی ها">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                                            class="bi bi-heart-fill" style="color: #000;" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </small>



                                @endauth

                                @guest

                                    <?php
                                    $counter = null;
                                    
                                    if (Session::has('favorite_p')) {
                                        $Pfavorited = Session::get('favorite_p');
                                    
                                        foreach ($Pfavorited as $item) {
                                            if ($item['id'] == $product->id) {
                                                $counter = true;
                                            }
                                        }
                                    }
                                    
                                    ?>

                                    <small
                                        @if ($counter) style="display:block;" @else style="display:none;" @endif
                                        class="liked removeFromFavorite{{ $product->id }}" title="حذف از علاقه مندی ها"
                                        onclick="removeFromFavorite('p',{{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red"
                                            class="bi bi-heart-fill Seticonsingleproduct" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </small>

                                    <small title="افزودن به علاقه مندی ها"
                                        @if ($counter) style="display:none;"@else style="display:block;" @endif
                                        class="dissliked addToFAvorite_{{ $product->id }}"
                                        onclick="addToFAvorite('p' , {{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" style="color: #000;" class="bi bi-heart Seticonsingleproduct"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </small>

                                @endguest

                            </div>


                        </div>



                        {{-- انتهای تولبار  --}}



                    </div>

                    <div style=" display:flex; flex-direction: column; padding:5px;overflow: hidden;  padding-top:15px;"
                        class="otherimgsDiv">

                        {{-- <div class="" style=" width:100px; height: 250px ; overflow: scroll;">
                        @foreach ($product->avtiveImages as $image)
                            <?php
                            
                            $src = $image->image;
                            
                            ?>
                            


                            @if ($src != $product->primary_image)
                                <label onclick="openimg('{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}')"
                                    class="otherimgsDiv"
                                    style="margin:10px; width: 100px !important;  height:100px !important;  "
                                    for="imgRadio({{ $image->id }})">
                                    <img id="subImg_{{ $image->id }}"
                                        style="cursor:pointer;  width: 100px  height:100px ;  "
                                        src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                        alt="{{ $product->name }}" class="otherimgs">
                                </label>

                                <input style="display: none;"
                                    onchange="openimg('{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}')"
                                    type="radio" id="imgRadio({{ $image->id }})" name="imgRadio" class="imgRadio"
                                    value="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}">
                            @endif
                        @endforeach

                    </div> --}}
                    </div>

                </div>











            </div>

            {{-- نام محصول دسته محصول برند محصول قیمت  --}}

            <div class=" order-2 order-sm-2 order-md-2 productTopPart2 " style="direction: rtl;">
                <h1 class="  text-center   dastnevis"> {{ $product->name }} </h1>
                <div class="product-details-content ml-30 p-1">

                    <div>

                        <div class="product-details-price variation-price">

                            <?php if($product->product_price !=null ) { ?>
                            <p style="width: 100%; text-align:start !important;" class="">
                                قیمت
                                <strong style="width: 100%; text-align:start !important; color:#0782f5 !important;"
                                    class="text-center ">
                                    {{ number_format($product->product_price) }}
                                    تومان
                                </strong>
                            </p>
                            <?php }else{ ?>
                            <p style="width: 100%; text-align:start !important;">
                                قیمت : -
                            </p>
                            <?php } ?>






                        </div>



                        <div class="pro-details-meta">
                            <span>دسته بندی :</span>

                            <ul class="d-inline-block">
                                {{-- @if ($product->category->parent)
                                    <li><a class="vazirFont" style="color: black;"
                                            href="#">{{ $product->category->parent->name }}،
                                            {{ $product->category->name }}</a></li>
                                @else --}}
                                <li><a class="vazirFont" style="color: black;"
                                        href="#">{{ $product->category->name }}</a></li>
                                {{-- @endif --}}
                            </ul>

                        </div>




                        <div class="pro-details-meta">
                            <span> برند :</span>
                            <ul class="d-inline-block">
                                <li><a class="vazirFont" href=""> {{ $product->brand->name }} </a></li>
                            </ul>
                        </div>



                        <div class="pro-details-meta">
                            <ul>
                                <li><a class="vazirFont" href="">
                                        {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($product->acceptedbyAdmin)) }}
                                    </a></li>
                            </ul>
                        </div>






                    </div>

                    <div class="">




                        <div class="alert alert-success alertVEndorRate" style="height: 60px; display:none;">

                            <strong> امتیاز شما به این محصول ثبت شد . باتشکر </strong>

                        </div>
                    </div>


                </div>



            </div>
        </div>










        <div class="row p-2">

            {{-- قسمت اطلاعات فروشگاه   --}}


            <div class="vendor-product-page pt-2" style="">
                <div class="container">
                    <h4 class="h6 text-center">اطلاعات فروشگاه</h4>
                    <hr>



                    @include('layouts.vendors-mob', [
                        'items' => [$product->vendor],
                        'type' => 'vendors',
                    ])

                </div>
            </div>

            {{-- قسمت توضیحات محصول   --}}

            <div class="" style="text-align: justify;  ">

                <strong> توضیحات بیشتر :</strong>

                <pre class=" text-right" style="white-space: initial; font-family:IRANSans;line-height: 2.0rem;
                ">
                    {!! nl2br($product->description) !!}
                </pre>



            </div>
        </div>

    </div>



    {{-- for desktop --}}
    <div style="  padding-top: 25px;      width:100%; justify-content: space-around;"
        class="container TOPP div-product-desk">

        <ul>
            <li>
                <a href="{{ route('home') }}" style="color: #000;">
                    خانه
                    /
                </a>
                <a href="{{ route('products.index') }}" style="color: #000;">
                    محصولات
                    /
                </a>
                @if ($product->category->parent)

                    @if ($product->category->parent->parent)
                        <a class="vazirFont" style="color: #000;"
                            href="{{ route('categories.show', ['category' => $product->category->parent->parent->slug]) }}">{{ $product->category->parent->parent->name }}/</a>
                    @endif

                    <a class="vazirFont" style="color: #000;"
                        href="{{ route('categories.show', ['category' => $product->category->parent->slug]) }}">{{ $product->category->parent->name }}/
                    </a>

                    <a class="vazirFont" style="color: #000;"
                        href="{{ route('categories.show', ['category' => $product->category->slug]) }}">{{ $product->category->name }}
                    </a>
                @else
                    <a class="vazirFont" style="color: #000;"
                        href="{{ route('categories.show', ['category' => $product->category->slug]) }}">{{ $product->category->name }}
                    </a>
                @endif
                /
                <a href="">

                    {{ $product->name }}
                </a>
            </li>
        </ul>



        <div class="row pt-3">

            {{-- عکس ، امتیاز لایک اشتراک گذاری و ... --}}

            <div style=" display:flex; flex-direction: column; justify-content: space-between; "
                class="   col-md-6 col-sm-12 order-1 order-sm-1 order-md-1  ">



                













                <div style="display: flex;" class="col-12 allimgs pb-1">
                    <div style="display: flex; flex-direction: column; width:100%;" class=" mainproductImage">




                        @include('vendors.products.ProductImage')









                        {{-- <img onclick=" openimg('{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}') "
                            id="MainPic" style="border-radius: 11px;  height: 300px; margin:0 auto; "class="zoompro"
                            src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                            data-zoom-image="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                            alt="" />

                             --}}

                        <!-- END slider-wrapper -->
                        {{-- @include('layouts.home.sliders' , ['product'=>$product]) --}}


                        {{-- tool icon  --}}
                        {{-- دکمه های اشتراک گذاری و لایک و کامنت --}}


                        <div style="" class=" vazirFont pro-details-rating-wrap toolbarproduct row mt-4">

                            <div class="col-3">
                                {{-- تعداد بازدید  --}}

                                {{ $product->view_counter }}

                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"
                                    onmouseover="$(this).next().css('display' , 'block')"
                                    onmouseout="$(this).next().css('display' , 'none')">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                                <span
                                    style=" transition: all 0.4s; background-color: rgb(33, 32, 32); padding:5px; color:#efefef;position:absolute;display:none;margin-top:25px;margin-left:-250px;">

                                    بازدید این محصول

                                </span>
                            </div>
                            <div class="col-9 " style="text-align: left;">


                                @guest

                                    <?php
                                    $counter = null;
                                    
                                    if (Session::has('favorite_p')) {
                                        $Pfavorited = Session::get('favorite_p');
                                    
                                        foreach ($Pfavorited as $item) {
                                            if ($item['id'] == $product->id) {
                                                $counter = true;
                                            }
                                        }
                                    }
                                    
                                    ?>

                                    <small
                                        @if ($counter) style="display:inline-block;" @else style="display:none;" @endif
                                        class="liked removeFromFavorite{{ $product->id }}" title="حذف از علاقه مندی ها"
                                        onclick="removeFromFavorite('p',{{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red"
                                            class="bi bi-heart-fill Seticonsingleproduct" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </small>

                                    <small title="افزودن به علاقه مندی ها"
                                        @if ($counter) style="display:none;"@else style="display:inline-block;" @endif
                                        class="dissliked addToFAvorite_{{ $product->id }}"
                                        onclick="addToFAvorite('p' , {{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" style="color: #000;" class="bi bi-heart Seticonsingleproduct"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </small>

                                @endguest



                                <span title="مقایسه"
                                    onclick="addTocomp({{ $product->id }})
                                     ">
                                    <img src="{{ asset('main/tool/8373506.png') }}" width="30" height="30"
                                        alt="">
                                </span>

















                                <a title="اشتراک گذاری" onclick="copyToClipboard()">
                                    <img width="30" height="30"
                                        src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                                        alt="external-send-email-flatart-icons-outline-flatarticons" />
                                </a>


                                <span
                                    style=" transition: all 0.4s; background-color: rgb(33, 32, 32); padding:5px; color:#efefef;position:absolute;display:none;margin-top:25px;margin-left:-250px;">



                                </span>

                                <a href="#commentsection " style="color: #000;" title="دیدگاه ها">

                                    <svg width="25" height="25" style="" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="var(--ci-primary-color, currentColor)"
                                            d="M496,496H480a273.39,273.39,0,0,1-179.025-66.782l-16.827-14.584C274.814,415.542,265.376,416,256,416c-63.527,0-123.385-20.431-168.548-57.529C41.375,320.623,16,270.025,16,216S41.375,111.377,87.452,73.529C132.615,36.431,192.473,16,256,16S379.385,36.431,424.548,73.529C470.625,111.377,496,161.975,496,216a171.161,171.161,0,0,1-21.077,82.151,201.505,201.505,0,0,1-47.065,57.537,285.22,285.22,0,0,0,63.455,97L496,457.373ZM294.456,381.222l27.477,23.814a241.379,241.379,0,0,0,135,57.86,317.5,317.5,0,0,1-62.617-105.583v0l-4.395-12.463,9.209-7.068C440.963,305.678,464,262.429,464,216c0-92.636-93.309-168-208-168S48,123.364,48,216s93.309,168,208,168a259.114,259.114,0,0,0,31.4-1.913Z"
                                            class="ci-primary" />
                                    </svg>

                                </a>
                                @auth
                                    <small class="dissliked addToFAvorite_{{ $product->id }}" href="#"
                                        title="افزودن به علاقه مندی" onclick="addToFAvorite('p' , {{ $product->id }} ) "
                                        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) >= 1) style="display:none" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" style="color: #000;" class="bi bi-heart"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </small>

                                    <small @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) < 1) style="display:none" @endif
                                        class="liked removeFromFavorite{{ $product->id }}" href="#"
                                        onclick="removeFromFavorite('p',{{ $product->id }})" title="حذف از علاقه مندی ها">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                                            class="bi bi-heart-fill" style="color: #000;" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </small>



                                @endauth

                            </div>


                        </div>



                        {{-- انتهای تولبار  --}}



                    </div>
                    <div style=" display:flex; flex-direction: column; padding:5px;overflow: hidden;  padding-top:15px;"
                        class="otherimgsDiv">


                    </div>

                </div>











            </div>

            {{-- نام محصول دسته محصول برند محصول قیمت  --}}

            <div class="col-lg-6 col-md-6 order-2 order-sm-2 order-md-2 productTopPart2 "
                style="direction: rtl;border-right : solid 2px #b1b1b189;">
        

                <h1 class="  text-center  product_nameee dastnevis"> {{ $product->name }} </h1>
                <div style="" class="product-details-content ml-30 p-1">

                    <div>
                        

                        <div class="product-details-price variation-price">

                            <?php if($product->product_price !=null ) { ?>
                            <p style="width: 100%; text-align:start !important;" class="mt-5">
                                قیمت
                                <strong style="width: 100%; text-align:start !important; color:#0782f5 !important;"
                                    class="text-center ">
                                    {{ number_format($product->product_price) }}
                                    تومان
                                </strong>
                            </p>
                            <?php }else{ ?>
                            <p style="width: 100%; text-align:start !important;">
                                قیمت : -
                            </p>
                            <?php } ?>






                        </div>



                        <div class="pro-details-meta">
                            <span>دسته بندی :</span>
                            <ul>
                                {{-- @if ($product->category->parent)
                                    <li><a class="vazirFont"
                                            style="color: black;"href="{{ route('categories.show', ['category' => $product->category->slug]) }}">{{ $product->category->parent->name }}،
                                            {{ $product->category->name }}</a></li>
                                @else --}}
                                <li><a class="vazirFont" style="color: black;"
                                        href="{{ route('categories.show', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                                </li>
                                {{-- @endif --}}
                            </ul>
                        </div>




                        <div class="pro-details-meta">
                            <span> برند :</span>
                            <ul>
                                <li><a class="vazirFont"
                                        href="{{ route('showByBrand', ['brand' => $product->brand->name]) }}">
                                        {{ $product->brand->name }}
                                    </a></li>
                            </ul>
                        </div>



                        <div class="pro-details-meta">
                            <ul>
                                <li><a class="vazirFont" href="">
                                        {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($product->created_at)) }}
                                    </a></li>
                            </ul>
                        </div>
                        <form id="RateVendorForm " action="{{ route('ratevendor') }}" class="" method="post">
                            @csrf
                            <div class="row ">
                                <p class="col-5 " style="line-height: 32px;">
                                    امتیاز شما به محصول :</p>
        
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
        
        
                                <div class="rate  col-6">
                                    <input type="radio" id="star5" name="rate" value="5"
                                        @if (Session::has('Session_rated_list_product') && isset($oldRated) && $oldRated == '5') checked @endif
                                        onchange="ProductRate({{ $product->id }} , '5')" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4"
                                        onchange="ProductRate({{ $product->id }}, '4')"
                                        @if (Session::has('Session_rated_list_product') && isset($oldRated) && $oldRated == '4') checked @endif />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3"
                                        @if (Session::has('Session_rated_list_product') && isset($oldRated) && $oldRated == '3') checked @endif
                                        onchange="ProductRate({{ $product->id }}, '3')" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2"
                                        @if (Session::has('Session_rated_list_product') && isset($oldRated) && $oldRated == '2') checked @endif
                                        onchange="ProductRate({{ $product->id }}, '2')" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1"
                                        @if (Session::has('Session_rated_list_product') && isset($oldRated) && $oldRated == '1') checked @endif
                                        onchange="ProductRate({{ $product->id }}, '1')" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
        
                            </div>
        
        
                        </form>






                    </div>

                    <div class="">




                        <div class="alert alert-success alertVEndorRate" style="height: 60px; display:none;">

                            <strong> امتیاز شما به این محصول ثبت شد . باتشکر </strong>

                        </div>
                    </div>


                </div>



            </div>
        </div>










        <div class="row" style="border-top: solid 2px #b1b1b189;">

            {{-- قسمت اطلاعات فروشگاه   --}}


            <div class="col-6" style="">
                <div class="container" style="margin-top:30px!important">
                    <h4 class="text-center">اطلاعات فروشگاه</h4>



                    {{-- <x-vendors  :item="$product->vendor" /> --}}


                    @include('layouts.vendors-p', ['items' => [$product->vendor], 'type' => 'vendors'])

                </div>
            </div>

            {{-- قسمت توضیحات محصول   --}}

            <div class="col-6 p-5" style="text-align: justify; border-right : solid 2px #b1b1b189; ">

                <strong> توضیحات بیشتر :</strong>

                <pre class=" text-right" style="white-space: initial; font-family:IRANSans;line-height: 2.0rem;
                ">
                    {!! nl2br($product->description) !!}


                    <hr>
                    @include('vendors.layouts.moreDescription')
                </pre>



            </div>
        </div>

    </div>

























    <br>

    <br>




    @if ($product->apatatVideoLink && App\Models\Admin\SiteSetting::first()->aparat_product)
        <div class="col-6 m-auto p-3">
            {!! $product->apatatVideoLink !!}
        </div>
    @endif
    <br>



    <hr>
    <br><br>

    <div class="container-fluid position-relative">
        <div class="row ">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="">
                    <h3 style="margin:10px; "> محصولات مشابه </h3>
                    <div class="row"
                        style="margin-bottom: 5%;
                        overflow: scroll;
                        border-radius: 25px;
                        padding-right: 10px;
                        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;">


                        <div style="font-size: 18px !important; color:black !important;"
                            class=" col-12 similar-product owl-carousel   my-3 mobile-margin">


                            {{-- @include('layouts.products' , ['item'=>$sameProducts , 'type'=>'relationable'])  --}}

                            {{-- @include('layouts.products', ['item' => $samplePr, 'type' => 'product']) --}}


                            @foreach ($samplePr as $productss)
                                <x-productsCarousel :product="$productss" />
                            @endforeach


                        </div>

                    </div>






                    <hr>
                    <br><br>
                    <div style="display: flex; justify-content: space-between;" class="">

                        <h3 style="margin:10px;  "> سایر محصولات فروشگاه </h3>


                        <a class="btn btn-outline-primary" style="margin: 10px;"
                            href="{{ route('vendor.home', ['vendor' => $product->vendor->name]) }}"> همه محصولات
                            فروشگاه</a>

                    </div>
                    <div class=" hideScrollBar col-12"
                        style="
                            
                        margin-bottom:5%;
                        overflow: scroll;
                        border-radius: 25px;
                        padding-right:10px;
                        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;        
                        
                        ">
                        <div class="row">
                            <div class="col-12" style="padding:30px; border-radius:35px;">
                                <div style="display:flex;" class="owl-carousel col-12 other-vendor-product">



                                    @php
                                        $listAll = 'vendor';
                                    @endphp

                                    {{--  @dd($VendoAnotherProducts)  --}}
                                    @foreach ($VendoAnotherProducts as $productss)
                                        <x-productsCarousel :product="$productss" :pinType="$listAll" />
                                    @endforeach




                                </div>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-2 mt-4">
                <div class="position-sticky" style="top:6px;">
                    <x-siteSideBarAdds :sideAddLinks="$sideAddLinks" />


                </div>
            </div>
        </div>
    </div>



    <div id="commentsection"></div>



    @include('vendors.products.ProductComments')



@endpush

@push('footer_scripts')

    <script src="{{ asset('/js/home/jquery-1.12.4.min.js') }}"></script>
    <script src="https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js"></script>




    <script>
        $('.variation-select').on('change', function() {
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation-price');
            variationPriceDiv.empty();

            if (variation.is_sale) {
                let spanSale = $('<span />', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.sale_price)) + ' تومان'
                });
                let spanPrice = $('<span />', {
                    class: 'old',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                });

                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);
            } else {
                let spanPrice = $('<span />', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                });
                variationPriceDiv.append(spanPrice);
            }

            $('.quantity-input').attr('data-max', variation.quantity);
            $('.quantity-input').val(1);

        });
        // var start = true;
        // var pan_elem = $(".pan");
        // var pan_zoom = Panzoom(pan_elem[0], {

        //     maxZoom: 2,
        //     minZoom: 0.5,
        //     initialZoom: 1,
        //     zoomSpeed: 1,
        //     animate: true,
        //     overflow: 'unset',
        // });

        // pan_elem[0].addEventListener('panzoomstart', (event) => {
        //     start = false;
        // });
        // pan_elem[0].addEventListener('panzoomend', (event) => {
        //     console.log(event.detail);
        //     pan_zoom.zoom(1, {
        //         animate: true
        //     });
        //     pan_zoom.pan(0, 0);
        //     start = true;
        // });
        // pan_elem[0].parentElement.addEventListener('wheel', (event) => {
        //     if (start) {
        //         pan_zoom.zoomWithWheel(event);
        //         setInterval((pan_zoom) => {
        //             pan_zoom.zoom(1, {
        //                 animate: true
        //             });
        //             pan_zoom.pan(0, 0);
        //         }, 1000, pan_zoom);
        //     }
        // });




        function ChangPic() {

            console.log($('.imgRadio:checked').val())

            $('#MainPic').attr('src', $('.imgRadio:checked').val());
        }


        function showVendorPhone() {


            $('#phoneSvg').css('display', 'none');
            $('#phoneVendor').css('display', 'block');
        }

        function showVendorAddress() {


            $('#AddressSvg').css('display', 'none');
            $('#Address').css('display', 'block');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.similar-product').owlCarousel({
                items: 5,
                margin: 10,
                @if ($samplePr->count() > 5)
                    loop: true,
                @endif
                autoplay: true,
                rtl: true,
                autoplayTimeout: 4500,
                dots: false,
                responsive: {
                    0: {
                        items: 2,
                        margin: 40,
                    },
                    440: {
                        items: 2,
                        margin: 5,
                    },
                    // breakpoint from 480 up
                    768: {
                        items: 2,
                    },
                    // breakpoint from 768 up
                    900: {
                        items: 3,
                    },
                    1200: {
                        items: 5,
                    }
                }
            });

            $('.other-vendor-product').owlCarousel({
                items: 5,
                margin: 10,
                @if ($VendoAnotherProducts->count() >= 6)
                    autoplay: true,
                    loop: true,
                @endif
                rtl: true,
                autoplayTimeout: 4500,
                dots: false,
                responsive: {
                    0: {
                        items: 2,
                        margin: 40,
                    },
                    440: {
                        items: 2,
                        margin: 5,
                    },
                    // breakpoint from 480 up
                    768: {
                        items: 2,
                    },
                    // breakpoint from 768 up
                    900: {
                        items: 3,
                    },
                    1200: {
                        items: 5,
                    }
                }
            });
            $('.product-image-owl-carousel').owlCarousel({
                items: 1,
                margin: 10,
                rtl: true,
                @if ($product->Allimages->count() >= 2)
                    loop: true,
                @endif
                autoplay: true,
                autoplayTimeout: 3500,

            });



        });
    </script>
    <script>
        $(document).ready(function() {
            $('.img-for-product').on('click', function() {
                $(this).addClass('full-image-for-product');
            });
        });
    </script>

@endpush
{{-- @endpush
      class: 'new',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                });
                variationPriceDiv.append(spanPrice);
            }

            $('.quantity-input').attr('data-max', variation.quantity);
            $('.quantity-input').val(1);

        });
        // var start = true;
        // var pan_elem = $(".pan");
        // var pan_zoom = Panzoom(pan_elem[0], {

        //     maxZoom: 2,
        //     minZoom: 0.5,
        //     initialZoom: 1,
        //     zoomSpeed: 1,
        //     animate: true,
        //     overflow: 'unset',
        // });

        // pan_elem[0].addEventListener('panzoomstart', (event) => {
        //     start = false;
        // });
        // pan_elem[0].addEventListener('panzoomend', (event) => {
        //     console.log(event.detail);
        //     pan_zoom.zoom(1, {
        //         animate: true
        //     });
        //     pan_zoom.pan(0, 0);
        //     start = true;
        // });
        // pan_elem[0].parentElement.addEventListener('wheel', (event) => {
        //     if (start) {
        //         pan_zoom.zoomWithWheel(event);
        //         setInterval((pan_zoom) => {
        //             pan_zoom.zoom(1, {
        //                 animate: true
        //             });
        //             pan_zoom.pan(0, 0);
        //         }, 1000, pan_zoom);
        //     }
        // });




        function ChangPic() {

            console.log($('.imgRadio:checked').val())

            $('#MainPic').attr('src', $('.imgRadio:checked').val());
        }


        function showVendorPhone() {


            $('#phoneSvg').css('display', 'none');
            $('#phoneVendor').css('display', 'block');
        }

        function showVendorAddress() {


            $('#AddressSvg').css('display', 'none');
            $('#Address').css('display', 'block');
        }
    </script>
@endpush --}}
