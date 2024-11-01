@extends('user.layouts.user')
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
<link rel="stylesheet" href="{{ asset('Croppie-master/croppie.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<script src="{{ asset('Croppie-master/croppie.min.js') }}"></script>
 --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> --}}



@section('title')
    edit products
@endsection

@section('script')
    {{-- <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script> --}}

    <script>
        // $('#brandSelect').selectpicker({
        //     'title': 'انتخاب برند'
        // });
        // $('#tagSelect').selectpicker({
        //     'title': 'انتخاب تگ'
        // });

        // let variations = @json($productVariations);
        // variations.forEach(variation => {
        //     $(`#variationDateOnSaleFrom-${variation.id}`).MdPersianDateTimePicker({
        //         targetTextSelector: `#variationInputDateOnSaleFrom-${variation.id}`,
        //         englishNumber: true,
        //         enableTimePicker: true,
        //         textFormat: 'yyyy-MM-dd HH:mm:ss',
        //     });

        //     $(`#variationDateOnSaleTo-${variation.id}`).MdPersianDateTimePicker({
        //         targetTextSelector: `#variationInputDateOnSaleTo-${variation.id}`,
        //         englishNumber: true,
        //         enableTimePicker: true,
        //         textFormat: 'yyyy-MM-dd HH:mm:ss',
        //     });
        // });
        // $('#categorySelect').selectpicker({
        //     'title': 'انتخاب دسته بندی'
        // });






        // $('#attributesContainer').hide();
        // $('#categorySelect').on('changed.bs.select', function() {
        //     let categoryId = $(this).val();

        //     $.get(`{{ url('/vendor-dashboard/category-attributes/${categoryId}') }}`, function(response,
        //         status) {
        //         if (status == 'success') {
        //             // console.log(response);

        //             $('#attributesContainer').fadeIn();

        //             // Empty Attribute Container
        //             $('#attributes').find('div').remove();

        //             // Create and Append Attributes Input
        //             response.attrubtes.forEach(attribute => {
        //                 let attributeFormGroup = $('<div/>', {
        //                     class: 'form-group col-md-3'
        //                 });
        //                 attributeFormGroup.append($('<label/>', {
        //                     for: attribute.name,
        //                     text: attribute.name
        //                 }));

        //                 attributeFormGroup.append($('<input/>', {
        //                     type: 'text',
        //                     class: 'form-control',
        //                     id: attribute.name,
        //                     name: `attribute_ids[${attribute.id}]`
        //                 }));

        //                 $('#attributes').append(attributeFormGroup);

        //             });

        //             $('#variationName').text(response.variation.name);

        //         } else {
        //             alert('مشکل در دریافت لیست ویژگی ها');
        //         }
        //     }).fail(function() {
        //         alert('مشکل در دریافت لیست ویژگی ها');
        //     });
        // });

        // $("#czContainer").czMore();









        // Show File Name
        // $('#primary_image').change(function() {
        //     //get the file name
        //     var fileName = $(this).val();
        //     //replace the "Choose a file" label
        //     $(this).next('.custom-file-label').html(fileName);
        // });

        // $('#images').change(function() {
        //     //get the file name
        //     var fileName = $(this).val();
        //     //replace the "Choose a file" label
        //     $(this).next('.custom-file-label').html(fileName);
        // });


        // function openWarantyModal() {

        //     if ($('#waranty').val() == '1') {

        //         $('.hasWarantyInputs').css('display', 'flex');
        //     }
        // }







        // function saveWaranty() {

        //     if ($('#waranty').val() == '1') {




        //         if ($('#inputNumberWaranty').val() != "") {

        //             var inputNumberWaranty = $('#inputNumberWaranty').val();
        //             var WarrantyDuration = $('#WarrantyDuration').val();
        //             var ProductWarranty = inputNumberWaranty + WarrantyDuration;
        //             console.log(ProductWarranty);
        //             $('#warrantyInputHidden').val(ProductWarranty);
        //             $('.modal').modal('hide');
        //             $('#newWarranty').html(ProductWarranty);

        //         } else {
        //             alert('مدت زمان گارانتی نمیتواند خالی باشد');
        //         }

        //     } else {
        //         $('#hasWarantyInputs').css('display', 'none');
        //         $('.modal').modal('hide');

        //     }

        // }





        // function submitAllEdits() {

        //     $('#photoForm').submit();
        // }


        // $('#myModal').on('shown.bs.modal', function() {
        //     $('#myInput').trigger('focus')
        // })



        //     $('#images').ijaboCropTool({
        //       preview : '.image-previewer',
        //       setRatio:1,
        //       allowedExtensions: ['jpg', 'jpeg','png'],
        //       buttonsText:['CROP','QUIT'],
        //       buttonsColor:['#30bf7d','#ee5155', -15],

        //       processUrl: "https://zivar-shop.ir/vendor-dashboard/products/"+ {{ $product->id }} +"/images-add " ,

        //       withCSRF:['_token','{{ csrf_token() }}'],
        //       onSuccess:function(data){

        //     },
        //       onError:function(data){

        //         console.log(data);
        //     }
        //    });file


        // $('#images').ijaboCropTool({
        //     preview: '.image-previewer',
        //     setRatio: 1,
        //     allowedExtensions: ['jpg', 'jpeg', 'png'],
        //     buttonsText: ['CROP', 'QUIT'],
        //     buttonsColor: ['#30bf7d', '#ee5155', -15],
        //     processUrl: "www.google.com ",
        //     onSuccess: function(message, element, status) {
        //         alert(message);
        //     },
        //     onError: function(message, element, status) {
        //         alert(message);
        //     }
        // });


        /*  Page Loading */
        document.onreadystatechange = function() {
            var state = document.readyState;
            if (state == "interactive") {
                document.getElementById("mainbody").style.visibility = "hidden";
            } else if (state == "complete") {
                setTimeout(function() {
                    document.getElementById("interactive");
                    document.getElementById("loader-main").style.visibility = "hidden";
                    document.getElementById("mainbody").style.visibility = "visible";
                }, 500);
            }
        };
    </script>

    <style>
        li {
            list-style-type: none;
        }

        nav ul ul {
            display: none;
        }

        nav ul li:hover>ul {
            display: block;
        }


        .first_ul {
            background: #efefef;
            background: linear-gradient(top, #efefef 0%, #bbbbbb 100%);
            background: -moz-linear-gradient(top, #efefef 0%, #bbbbbb 100%);
            background: -webkit-linear-gradient(top, #efefef 0%, #bbbbbb 100%);
            box-shadow: 0px 0px 9px rgba(0, 0, 0, 0.15);
            padding: 0 20px;

            list-style: none;
            position: relative;
            width: 100%;

            display: inline-table;
        }

        .first_ul:after {
            content: "";
            clear: both;
            display: block;

        }

        .first_ul li {}

        .first_ul li:hover {
            background: #4b545f;
            background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
            background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
            background: -webkit-linear-gradient(top, #4f5964 0%, #5f6975 40%);
        }

        nav ul li:hover a {
            color: #fff;
        }

        nav ul li a {
            width: 100%;
            display: block;
            padding: 25px 40px;
            color: #757575;
            text-decoration: none;
        }


        nav ul ul {
            background: #5f6975;
            border-radius: 0px;
            padding: 0;
            position: absolute;
            top: 100%;
        }

        nav ul ul li {
            float: none;
            border-top: 1px solid #6b727c;
            border-bottom: 1px solid #575f6a;
            position: relative;
        }

        nav ul ul li a {
            padding: 15px 40px;
            color: #fff;
        }

        nav ul ul li a:hover {
            background: #4b545f;
        }


        nav ul ul ul {
            position: absolute;
            left: 100%;
            top: 0;
        }


        #loader-main {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 9999;

            background-color: #fff;
        }

        #loader {

            margin: 0 auto;
            border: 10px solid rgba(217, 217, 217, 0.1);
            border-radius: 50%;
            border-top: 10px solid #049f5e;
            width: 120px;
            height: 120px;
            position: absolute;
            left: 50%;
            right: 0;
            top: 50%;
            margin-left: -60px;
            margin-top: -60px;
            bottom: 0;
            -webkit-animation: spin 2s linear infinite;
            -o-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <link href="sabt2/css/style.css" rel="stylesheet">
@endsection


{{-- <div id="loader-main">
    <div id="loader">
    </div>
</div>
 --}}


@section('content')








    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-5 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش تصاویر محصول : {{ $product->name }}</h5>
            </div>
            <hr>

            @include('user.sections.errors')
            <div class="row">
                <div class="col-12 col-md-12 mb-5 d-flex justify-content-md-between">
                    <h5>تصاویر : </h5>


                </div>

                {{-- @dd($product->Allimages); --}}
                @if (count($product->Allimages) > 0)
                    @foreach ($product->Allimages as $image)
                        <div class="col-md-3">
                            <div @if ($image->image == $product->primary_image) style="border:  3px solid red;" @endif class="card">
                                <img style="width: 350px;" class="card-img-top"
                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                    alt="{{ $product->name }}">
                                <div class="card-body text-center">
                                    <form id="photoForm"
                                        action="{{ route('user.products.images.destroy', ['product' => $product->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>
                                    </form>
                                    @if ($image->image != $product->primary_image)
                                        <form id="photoForm"
                                            action="{{ route('user.products.images.set_primary', ['product' => $product->id]) }}"
                                            method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="image_id" value="{{ $image->id }}">




                                            <button class="btn btn-primary btn-sm mb-3" type="submit">انتخاب به عنوان تصویر
                                                اصلی</button>


                                        </form>
                                    @endif

                                </div>

                            </div>

                        </div>
                    @endforeach
                    <div class="col-md-3">
                        <div style="overflow: hidden;" class="card">
                            <label style=" cursor: pointer ;position:absolute; padding:40%; width:100%; height: 100%; "
                                for="images" class="addnewPic">افزودن عکس</label>
                            <img style="width: 350px;" class="card-img-top"
                                src="{{ url(env('PRODUCT_DEFUALT_IMAGES_PATH')) }}" alt="{{ $product->name }}">


                        </div>

                    </div>
                @else
                    <div class="col-md-3">
                        <div style="overflow: hidden;" class="card">
                            <label style=" cursor: pointer ;position:absolute; padding:40%; width:100%; height: 100%; "
                                for="images" class="addnewPic">افزودن عکس</label>
                            <img style="width: 350px;" class="card-img-top"
                                src="{{ url(env('PRODUCT_DEFUALT_IMAGES_PATH')) }}" alt="{{ $product->name }}">


                        </div>

                    </div>
                @endif
                <form id="submitphotos" action="{{ route('user.products.imageadd', ['product' => $product]) }}"
                    id="" method="POST" enctype="multipart/form-data">


                    @csrf

                    <div class="form-group col-md-4">
                        <div class="custom-file">

                            <input type="file" accept="image/png, image/gif, image/jpeg" style="display:none !important;"
                                name="images[]"
                                onchange=" 
                                $('#overlay').css('display' , 'block');
                  $('#submitphotos').submit();    "
                                multiple id="images">

                            <input type="hidden" name="fromFinal" value="yesss">

                        </div>
                    </div>
                </form>

                
            </div>
            <div class="text-center">
                <a href="{{ route('user.products.create') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                <span class="btn btn-outline-primary mt-5"  onclick="submitForm()" >بازگشت</span>
                <a href="{{ route('user.products.finalSubmitCreatingProduct', ['product' => $product, 'id' => $product->id]) }}"
                    class="btn btn-primary mt-5 w-75 mr-3">تایید</a>
            </div>


        </div>

    </div>




    </div>

    </div>
@endsection


<style>
    .addnewPic:hover {

        transition: all 0.3s;
        background-color: #4b545f75;

    }
</style>


<script>
    (function($) {

        "use strict";

        /* Preload*/
        // $(window).on('load', function() { // makes sure the whole site is loaded
        //     $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
        //     $('#preloader').delay(350).fadeOut(
        //         'slow'); // will fade out the white DIV that covers the website.
        //     $('body').delay(350).css({
        //         'overflow': 'visible'
        //     });
        // })
        /* Tooltip*/
        $('.tooltip-1').tooltip({
            html: true
        });

        /* Check and radio input styles */
        $('input.icheck').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey'
        });

        /* Carousel About */
        $(".team-carousel").owlCarousel({
            items: 1,
            loop: false,
            margin: 10,
            autoplay: false,
            smartSpeed: 300,
            responsiveClass: false,
            responsive: {
                320: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1000: {
                    items: 3,
                }
            }
        });

    })(window.jQuery); // JavaScript Document
</script>

<script src="sabt2/js/functions.js"></script>
