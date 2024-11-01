<?php

// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = 'Articles';

?>



@extends('master')

@section('title', 'مقالات')


@section('description',
    'اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس با ما :
    ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس : تهران لاله زارنو کوچه امین زاده پلاک 20')



    @push('header_styles')
        @include('layouts.home.header.styles')
    @endpush


    @push('header_scripts')
        @include('layouts.home.header.scripts')

        <script>
            $(document).ready(function() {

                /*FILTER/CARDS PAGES JS************************************/
                var filterBtns = $('.filter-btn');
                var cards = $('.card');
                filterBtns.click(function(event) {
                    /*Takes care of highlighting current filter*/
                    event.preventDefault();
                    $('.selected').removeClass('selected');
                    $(this).addClass('selected');

                    /*Takes care of showing correct cards*/
                    var currentFilter = $(this).attr('data-filter');
                    if (currentFilter === 'all') {
                        jQuery.each(cards, function(i, v) {
                            $(this).show();
                        });
                    } else {
                        jQuery.each(cards, function(i, v) {
                            /*If statement checks if any of the filters are in the currentFilter*/
                            if (v.getAttribute('data-filter').indexOf(currentFilter) >= 0) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    }
                });



                /*Takes care of cutting extra chars from cards*/
                var bodyText = $('.card-body');
                bodyText.each(function() {
                    $(this).text($(this).attr('data-short-text'));
                });


                /*Takes care of expanding card when more info is clicked*/
                var moreLinks = $('.more-link');

                moreLinks.click(function(event) {
                    var cardClicked = $(this).parents('.card');
                    var textContainer = cardClicked.find('.card-text-container');
                    var cardClickText = cardClicked.find('.card-body');
                    var locationInfo = cardClicked.find('p.card-location');

                    /*Checks to see if card is already open*/
                    if ($(this).html() === 'Back') {
                        if ($(window).width() >= 768) {
                            $("html, body").animate({
                                scrollTop: 400
                            }, "slow");
                        }
                        cardClickText.text(cardClickText.attr('data-short-text'));
                        locationInfo.fadeOut('easeOutExpo');

                        cardClicked.css({
                            'width': '300px',
                            'height': '500px',
                            'margin': '10px',
                            'display': 'inline-block'
                        });
                        cardClicked.find('.card-img-container').css({
                            'height': '200px'
                        });
                        $(this).html('More Info');
                        textContainer.removeClass('expanded');
                    }

                    /*If it isnt open, then depending on device transform width and height or just height*/
                    else {
                        $(this).html('Back');

                        cardClickText.text(cardClickText.attr('data-orig-text'));
                        locationInfo.fadeIn('easeInQuint');
                        var pos = cardClicked.position();

                        /*If desktop*/
                        if ($(window).width() >= 768) {
                            cardClicked.css({
                                'display': 'block',
                                'margin': '0 auto',
                                'width': '750px',
                                'height': '750px'
                            });

                            cardClicked.find('.card-img-container').css({
                                'height': '350px'
                            });


                        }
                        /*If mobile*/
                        else {
                            cardClicked.css('height', '750px');
                        }
                        textContainer.addClass('expanded');
                        // $("html, body").animate({ scrollTop: pos.top + 900 }, "slow");
                    }

                });
                /**/

            });


            function showVendorPhone(id) {
                $("#phoneSvg(" + id + ")").css('display', 'none');
                $('#phoneVendor(' + id + ')').css('display', 'block ');
            }

            function showVendorAddress(id) {

                $('#AddressSvg(' + id + ')').css('display', 'none');
                $('#Address(' + id + ')').css('display', 'block');
            }
        </script>
    @endpush


    @push('headers')
        @include('layouts.home.header.head')
        <a href="#" onclick="hideOrShowFilterOnMobile()" class="BtOpenCloseFilte btn btn-primary">جستجوی پیشرفته</a>
    @endpush


    @push('contents')
        <div class="container pt-4 ">
            <div class="row g-5  py-3">
                <h2 class="text-center mt-4"> مقاله های اینستابرق</h2>
               
                
                @foreach ($articles as $article)
                
                
                @php
                
                    $href = route('home.HomeArticle.show' , ['article'=>$article->slug])
                
                @endphp

                    <x-articles :article="$article"  :href="$href"   />
                @endforeach

            </div>
        </div>
        {{-- 3 pic --}}
        {{-- <div class=" Allproducts col-12 d-lg-flex"> --}}

        {{-- categories filter (right side) --}}
        {{-- <div class="col-md-2 p-2 col-xs-12" id="formFilter"> --}}


        {{-- </div> --}}



        {{-- </div>
  --}}



        {{-- <div class="col-md-8  col-xs-10">


            <h1 class="text-center text-black m-3">همه مقاله های اینستا برق</h1>

            <div class="col-lg-12 col-sm-12 ">



                <div class=" all row p-4 col-12">
                    @for ($i = 0; $i < count($articles); $i++)
                        <div onclick="location.href= {{ route('HomeArticle.show', ['article' => $articles[$i]->slug]) }} "
                            style="">


                            <div
                                style="width: 100% !important; align-items: center;  display:flex;  justify-content: space-between;">

                                <div style="width: 10%" class="">
                                    @if ($articles[$i]->main_img)
                                        <img src="{{ asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . $articles[$i]->main_img) }} "
                                            style=" margin:5px 5px 0px 5px; border:1px solid black; padding:3px; object-fit: cover; max-width:100px; height: 100px;"alt="" />
                                    @endif

                                </div>





                                <div style="width: 70%; margin-right: 5%; display:flex; justify-content: space-between  "
                                    class="">


                                    <div style=" display:flex; flex-direction: column;" class="">
                                        <a href="{{ route('HomeArticle.show', ['article' => $articles[$i]->slug]) }}"
                                            style="width:100%; color:black; font-size:20px;">
                                            {{ $articles[$i]->title }}
                                        </a>

                                        <small> 
                                            <?php echo substr($articles[$i]->pre_show, 0, 200) . '...'; ?>
                                         </small>

                                        <div class="">
                                            <small>تاریخ انتشار مقاله:</small>
                                            {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($articles[$i]->updated_at)) }}
                                        </div>

                                    </div>
                                    <div style="padding:20px;" class="">

                                        @auth
                                            <a class="disslikedArticle" href="#"
                                                onclick="addToFAvorite('c' , {{ $articles[$i]->id }} ) ; window.location.reload();
                                                "
                                                @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('categoryArticle_id', $articles[$i]->id)->get(),
    ) >= 1) style="display:none" @endif>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                    fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path
                                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                </svg>

                                            </a>


                                            <a @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('categoryArticle_id', $articles[$i]->id)->get(),
    ) < 1) style="display:none" @endif
                                                class="likedArticle" href="#"
                                                onclick="removeFromFavorite('c',{{ $articles[$i]->id }}); window.location.reload();
                                                ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                    fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                                </svg>
                                            </a>

                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                    fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z" />
                                                </svg>
                                            </a>

                                        @endauth
                                    </div>
                                </div>


                                <div class="provider">


                                </div>

                                <div id="Address" style="floa" class="vendorBoxItem">

                                    <a class="btn btn-outline-primary m-3"
                                        style="border:1px solid blue; border-radius:10%;"href="{{ route('HomeArticle.show', ['article' => $articles[$i]->slug]) }}">
                                        مشاهده
                                        مقاله</a>

                                </div>

                            </div>


                        </div>
                    @endfor
                 





            </div>
        </div>  --}}





        </div>


        </div>



        {{-- {{$articles->links()}} --}}

    @endpush

    @push('footer_scripts')
        {{-- <div class="container"> --}}

        @include('layouts.home.footer.script')
    @endpush
