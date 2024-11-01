<nav class="nav-login showOnScrollTop  " style="background-color: white">
    @include('subtitle')

    <div class="d-flex flex-row justify-content-between px-4">
        <div>
            <a href="{{ route('home') }}"><img src="{{ url('main/logo.png') }}" class="logo"></a>
        </div>


        @include('layouts.home.header.search')




        <div class="p-1 btn btn- align-items-end">
            @guest
                <div class="">

                    {{-- <a class="logItems" href="{{ route('favorite.index') }}"
                        onmouseover="$(this).next().css('display' , 'block')"
                        onmouseout="$(this).next().css('display' , 'none')">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-heart " viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                    </a> --}}
                    <span
                        style=" transition: all 0.4s; background-color: rgb(33, 32, 32); padding:5px; color:#efefef;position:absolute;display:none;margin-top:25px;margin-left:-250px;">

                        لیست علاقه مندی

                    </span>

                    <a href="{{ route('login') }}" class="vazirFont logItems" style="width: 100px;">

                        ورود /
                    </a>


                    <a href="{{ route('register') }}" class="vazirFont logItems" style="width: 100px;">

                        ثبت نام
                    </a>


                </div>
            @endguest

            @auth

                <a class="logItems" style="margin-left: 3px;" href="{{ route('favorite.index') }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        @if (count(Auth::user()->vendor->favorites) > 0) fill="red"
                                            
                                        @else
                                        fill="currentColor" @endif
                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                    </svg>
                </a>

                <a class="logItems" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black"
                        class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                        <path fill-rule="evenodd"
                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg>

                </a>

                @if (Auth::user()->rols()->where('name', 'admin')->count() == 0)
                    <a class="logItems"href="{{ route('user.dashboard') }}" class="b">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg>


                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="">

                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg>
                    </a>
                @endif


                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            @endauth
        </div>
    </div>

    <div id="searchResult" style="" class="col-8 desktop-search">

    </div>

</nav>

<div class="hideOnScroll">

    <nav style="width: 100% !important;" class="main mainnn">
        <div style="width: 90%;" class="main ">
            @include('layouts.home.header.menu')
        </div>
    </nav>
    <div style="display: flex; width:100%">
        <div style="margin-right:10%" class="col-md-10">
            @include('layouts.home.header.category')
        </div>
    </div>
</div>
@include('layouts.home.header.mobile-menu')

<style>
    .stickyMenu {
        position: fixed;
        background-color: white;
        width: 100%;
        z-index: 10000;
    }

    .stickymain {
        position: fixed;

        top: 120px;

        width: 100% !important;
        z-index: 10000;

    }
</style>

<script>
    var scrollableElement = document.body; //document.getElementById('scrollableElement');
    window.addEventListener('scroll', () => {
        if ($(document).scrollTop() < 100) {
            $('.bg-subtitle').css('display', 'block');

        }
        if ($(document).scrollTop() > 100) {
            $('.bg-subtitle').css('display', 'none');

        }

    })


    scrollableElement.addEventListener('wheel', checkScrollDirection);

    function checkScrollDirection(event) {


        if ($(document).scrollTop() < 200) {
            $('.hideOnScroll').css('display', 'block');


            $('.showOnScrollTop').css('position', 'relative');
            $('.bg-subtitle').css('display', 'block');

            // console.log('is in top');
        } else {

            if (checkScrollDirectionIsUp(event)) {

                // var e = document.querySelector("#searchResult");

                // var child = e.lastElementChild;
                // while (child) {
                //     e.removeChild(child);
                //     child = e.lastElementChild;
                // }

                // $('.hideOnScroll').css('display' , 'none');
                $('.showOnScrollTop').css('position', 'fixed');
                $('.showOnScrollTop').css('z-index', '1000000000000000000000000');
                $('.bg-subtitle').css('display', 'none');

                console.log('up')

            } else {

                $('.showOnScrollTop').css('position', 'relative');


                $('.showOnScrollTop').css('width', '100%');


                $('.hideOnScroll').css('display', 'none');



                $('.bg-subtitle').css('display', 'none');





                // else {
                // $('.hideOnScroll').css('display' , 'block');p
                // }






            }



        }

    }

    function checkScrollDirectionIsUp(event) {
        if (event.wheelDelta) {
            return event.wheelDelta > 0;
        }
        return event.deltaY < 0;
    }
</script>
