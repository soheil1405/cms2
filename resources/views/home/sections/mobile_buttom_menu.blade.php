@push('header_styles')
    <style>
        .mobiconefect {
            background-color: #000;

            width: 97px;
            height: 97px;
            padding: 10px;
            border-radius: 50%;
        }

        .mobiconefect svg {
            color: #2e72d8 !important;
        }

        .txt-hover:hover svg {
            color: #2e72d8 !important;
            transition: 0.3s;
        }

        .txt-hover:hover h6 {
            color: #2e72d8 !important;
            transition: 0.3s;
        }

        .menu-moble-items {
            position: fixed !important;
            bottom: 0 !important;
            z-index: 1000 !important;
            width: 100%;
        }

        .chaild-svg {
            margin: 50px 25px 8px 8px !important;

            position: absolute;
            opacity: 0;
        }

        .second-chaild-svg {
            margin: 50px 75px 8px 8px !important;
            position: absolute;
            opacity: 0;
        }

        .txt-hover:hover svg {
            color: #2e72d8 !important;
            transition: 0.3s;
        }

        .txt-hover:hover h6 {
            color: #2e72d8 !important;
            transition: 0.3s;
        }

        .third-chaild-svg {
            margin: 50px 125px 8px 8px !important;
            /* margin: -158px 50px 8px 8px !important; */

            position: absolute;
            opacity: 0;
        }

        .parent-svg-div {
            position: relative;
        }

        .parent-svg-div:hover .chaild-svg {
            transform: rotate(360deg) !important;

            margin: -150px -25px 26px 0px !important;
            opacity: 1;
            transition: 0.4s;
        }

        .parent-svg-div:hover .second-chaild-svg {
            transform: rotate(360deg) !important;

            margin: -199px 55px 8px 8px !important;
            opacity: 1;
            transition: 0.4s;
        }

        .parent-svg-div:hover .third-chaild-svg {
            margin: -150px 132px 8px 0 !important;
            transform: rotate(360deg) !important;
            opacity: 1;
            transition: 0.4s;
        }

        .childs-styles {
            margin-right: -186px !important;
        }

        .parent-style {
            margin-top: 15px !important;
        }

        .inamited-image-slider {
            margin-top: -15px;
        }

        .border-top-icon {
            display: inline-block;
            margin-top: -30px;
            position: absolute;
        }

        .mobiconefect {
            background-color: #000;
            color: #fff;
            width: 77px;
            height: 77px;
            padding: 10px;
            border-radius: 50%;
        }

        .mobiconefect:hover {
            color: #82b2fa !important;
            transition: 0s !important;
        }

        .mobiconefect svg:hover {
            color: #82b2fa !important;
            transition: 0s !important;
        }

        .mobiconefect svg {
            color: #fff !important;
            transition: 0s !important;
        }
    </style>
@endpush





<div class="menu-moble-items text-center  rounded py-2 pb-2 d-md-none d-flex justify-content-evenly"
    style="background-color:#212529;justify-content: space-evenly;">

    <div class="icons-settings   d-inline-block txt-hover">
        <a href="{{ route('home') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-house-door-fill text-light " viewBox="0 0 16 16">
                <path
                    d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
            </svg>
            <h6 class="txt-white py-1 m-0  dastnevis">
                خانه
            </h6>
        </a>
    </div>


    <div class="icons-settings  d-inline-block">
        <div class="icons-settings  d-inline-block txt-hover">
            <a href="{{ route('categories.index') }}" class="">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-search text-light " viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
                <h6 class="txt-white py-1 m-0 dastnevis">

                    دسته بندی 
                </h6>

            </a>
        </div>
    </div>

    <div class="icons-settings d-inline-block parent-svg-div " style="margin-top: -29px;">


        <div class=" d-inline txt-hover">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" style="color: white;background-color: #212529;border-radius:50%;"
                width="40" height="40" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg> --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                style="    color: white;
            background-color: #212529;
            border-radius: 50%;
            border: 1px solid #fff;
            padding: 5px;"
                fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
            <h6 class="txt-white py-1 m-0  dastnevis">
                منو
            </h6>
        </div>

        @auth
            <div class="childs-styles ">
                <a class="chaild-svg mobiconefect" href="{{ route('user.products.index') }}">

                    <p class="py-2 dastnevis " style="font-size: 16px;"> ویرایش محصول </p>
                </a>

                <a class="second-chaild-svg mobiconefect" href="{{ route('user.products.create') }}">

                    <p class="py-2 dastnevis " style="font-size: 16px;">افزودن محصول</p>
                </a>
                <a class="mobiconefect third-chaild-svg" href="{{ route('user.upgrade') }}">

                    <p class="py-2 dastnevis " style="font-size: 16px;"> تبلیغ محصول</p>

                </a>
            </div>

        @endauth

        @guest


            <div class="childs-styles ">
                <a class="chaild-svg mobiconefect" href="{{ route('Vendors.list') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-shop-window" viewBox="0 0 16 16">
                        <path
                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z" />
                    </svg>


                    <h6 class="py-2 dastnevis">فروشگاه ها</h6>

                </a>

                <a class="second-chaild-svg mobiconefect" href="{{ route('products.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-lightbulb" viewBox="0 0 16 16">
                        <path
                            d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z" />
                    </svg>
                    <h6 class="py-2 dastnevis">محصولات</h6>
                </a>
                <a class="mobiconefect third-chaild-svg" href="{{ route('brands.homeIndex') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-tags" viewBox="0 0 16 16">
                        <path
                            d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                        <path
                            d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
                    </svg>
                    <h6 class="py-2 dastnevis">برندها</h6>

                </a>
            </div>


        @endguest
    </div>

    <div class="icons-settings  d-inline-block txt-hover">
        <a href="{{ route('favorite.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-heart-fill text-light " viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
            </svg>
            <h6 class="txt-white py-1 m-0  dastnevis">
                علاقه مندی 
            </h6>
        </a>
    </div>
    <div class="icons-settings  d-inline-block txt-hover">
        <a href="{{ route('user.dashboard') }}
       ">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-person-circle text-light " viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>
            <h6 class="txt-white  py-1 m-0 dastnevis">
                اکانت
            </h6>
        </a>
    </div>




</div>
