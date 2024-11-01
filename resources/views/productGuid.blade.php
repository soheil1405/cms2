<?php

$_SESSION['page'] = false;

?>





@extends('master')

@section('title', ' راهنمای صفحه محصول ')


@push('header_styles')
    @include('layouts.home.header.styles')
@endpush


@push('header_scripts')
    @include('layouts.home.header.scripts')

    <script>
        window.addEventListener('scroll', function() {
            if (window.pageYOffset) {
                $('#toppp').css('display', 'none');
            } else {
                jQuery('#toppp').css({
                    position: 'fixed',
                    width: 100 % ,
                    z - index: 1000,
                    top: '',
                    display: 'block'
                });
            }

        })
    </script>
@endpush



@push('headers')
    @include('layouts.home.header.head')
@endpush



@push('contents')



    <div class="container bg-white">

        <div class=" p-5 pt-0">


            @if ($setting_detail->product_video_name)
                <div class=" row p-5 text-center bg-white">
                    <video controls>
                        <source src="{{ env('SETTING_VIDEOS_UPLOAD_PATH') . $setting_detail->product_video_name }}"
                            type="video/webm" />
                    </video>
                </div>
            @endif


            {!! $setting_detail->productPage_guid_Text !!}



            @if ($setting_detail->aparat_product)
                <div class="col-12">


                    {!! $setting_detail->aparat_product !!}



                </div>
            @endif




        </div>
    </div>







@endpush

@push('footer_scripts')
    @include('layouts.home.footer.script')
@endpush
