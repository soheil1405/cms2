@extends('user.layouts.user')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
<link rel="stylesheet" href="{{ asset('Croppie-master/croppie.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css"> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="https://static.neshan.org/sdk/openlayers/5.3.0/ol.css">
<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL">
</script>
<script type="text/javascript" src="https://static.neshan.org/sdk/openlayers/5.3.0/ol.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>



@section('title')
    ویرایش فروشگاه
@endsection


@section('script')
    <script>
        function showSocialInputs() {

            $('#divSocials').css('display', 'block');
        }


        function deleteCover() {


            $("#deletedCoverPic").val("true")
            $(".imgCustomCover").css("display", "none");
            $(".coverImgPrevDiv").css("display", "none");
            $(".imgCoverDefualt").css("display", "block");
        }


        function deleteAvatar() {
            $("#AvatarimagePreview").attr("src",
                "https://instabargh.com/upload/files/vendors/images/avatars/default-avatar.png")
            $("#deletedavatarPic").val("true")
        }


        function inputCats() {
            let cat_array = [];
            $('.categoryCheckBox:checked').each(function() {
                cat_array.push(this.value);
            });
            $('#hiddenCatInput').val(cat_array);
        };

        var map = L.map('map', {
            attributionControl: false
        }).setView([{{ $vendor->lat }}, {{ $vendor->lng }}], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© {{ env('APP_NAME') }}',


        }).addTo(map);
        var marker = L.marker([{{ $vendor->lat }}, {{ $vendor->lng }}]).addTo(map);
        L.control.attribution({
            position: 'topright'
        }).addTo(map);

        map.on('move', function(e) {
            marker.setLatLng(L.latLng(map.getCenter()));

            $('#latlng').val(map.getCenter().lat + "," + map.getCenter().lng);

            // console.log(map.getCenter().lat , map.getCenter().lng);
        });


        $("#avatar_img").on("change", function() {


            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#AvatarimagePreview').attr('src', e.target.result);

                }
                reader.readAsDataURL(this.files[0]);
            }

            $("#deletedavatarPic").val(null)
            window.location.hash = "#";

        });

        $("#cover_img").on("change", function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#coverImgPrev').attr('src', e.target.result);

                }
                reader.readAsDataURL(this.files[0]);

                $(".imgCustomCover").css("display", "block");
                $(".coverImgPrevDiv").css("display", "block");
                $(".imgCoverDefualt").css("display", "none");
            }


            $("#deletedCoverPic").val(null)
            window.location.hash = "#";


        });
    </script>


    <style>
        .editPhotoBtn {
            transition: all .1s;
        }

        .editPhotoBtn:hover {
            background-color: black;
            scale: 1.1;
        }

        .ac {
            display: block;
        }
    </style>
@endsection
@push('footer_scripts')
    <script>
        function deleteProductImage(element, id) {
            if (confirm('در صورت حذف، این تصویر از تمام قسمت‌های سایت حذف خواهد شد')) {
                $.ajax({
                    url: '/vendor-dashboard/product-image-delete-image',
                    type: 'POST',
                    data: {
                        product_image_id: id,
                        _token: $('meta[name="csrf-token"]').attr('content') // برای امنیت و جلوگیری از CSRF
                    },
                    success: function(response) {
                        // بررسی پاسخ و انجام عملیات مورد نظر
                        console.log('تصویر با موفقیت حذف شد');
                        console.log(response);
                    },
                    error: function(xhr) {
                        // مدیریت خطاها
                        console.log(xhr);
                        console.log('خطایی رخ داده است. لطفاً دوباره تلاش کنید.');
                    }
                });

                let div_image = event.target.parentElement.parentElement.parentElement;
                // console.log('element', div_image);
                div_image.remove();

            }
        }

        function deleteAvatarImage(element, id) {
            if (confirm('در صورت حذف، این تصویر از تمام قسمت‌های سایت حذف خواهد شد')) {
                $.ajax({
                    url: '/vendor-dashboard/logo-avatar-delete-image',
                    type: 'POST',
                    data: {
                        vendor_id: id,
                        _token: $('meta[name="csrf-token"]').attr('content') // برای امنیت و جلوگیری از CSRF
                    },
                    success: function(response) {
                        // بررسی پاسخ و انجام عملیات مورد نظر
                        console.log('تصویر با موفقیت حذف شد');
                        console.log(response);
                    },
                    error: function(xhr) {
                        // مدیریت خطاها
                        console.log(xhr);
                        console.log('خطایی رخ داده است. لطفاً دوباره تلاش کنید.');
                    }
                });

                let div_image = event.target.parentElement.parentElement.parentElement;
                // console.log('element', div_image);
                div_image.remove();

            }
        }

        function deleteCoverImage(element, id) {
            if (confirm('در صورت حذف، این تصویر از تمام قسمت‌های سایت حذف خواهد شد')) {
                $.ajax({
                    url: '/vendor-dashboard/cover-vendor-delete',
                    type: 'POST',
                    data: {
                        vendor_id: id,
                        _token: $('meta[name="csrf-token"]').attr('content') // برای امنیت و جلوگیری از CSRF
                    },
                    success: function(response) {
                        // بررسی پاسخ و انجام عملیات مورد نظر

                        console.log(response);
                    },
                    error: function(xhr) {
                        // مدیریت خطاها
                        console.log(xhr);
                        console.log('خطایی رخ داده است. لطفاً دوباره تلاش کنید.');
                    }
                });

                let div_image = event.target.parentElement.parentElement.parentElement;
                // console.log('element', div_image);
                div_image.remove();

            }
        }
    </script>
@endpush


<style>
    .modal-window {
        height: 83%;
        width: 65%;
        margin: auto;
        position: fixed;
        background-color: rgb(237, 237, 237);
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        border-radius: 18px;
        z-index: 999;
        visibility: hidden;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s;
    }

    .modal-window:target {
        visibility: visible;
        opacity: 1;
        pointer-events: auto;
    }

    /* .modal-window > div {
    position: absolute;
    top: 20%;
    left: 20%;

    margin:50px;
    transform: translate(-50%, -50%);
    padding: 2em;
    background: white;
    } */
    .modal-window header {
        font-weight: bold;
    }

    .modal-window h1 {
        font-size: 150%;
        margin: 0 0 15px;
    }

    .modal-close {
        color: #aaa;
        line-height: 50px;
        font-size: 80%;
        position: absolute;
        right: 0;
        text-align: center;
        top: 0;
        width: 70px;
        text-decoration: none;
    }

    .modal-close:hover {
        color: black;
    }

    .image-container {
        position: relative;
        display: inline-block;

    }

    .image-container img {
        width: 100px;
        height: 100px;
    }

    .image-actions {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: center;
        background: rgba(255, 255, 255, 0.7);
    }

    .preview-image {
        display: none;
        width: 300px;
        height: 300px;
    }

    a {
        text-decoration: none !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewIcons = document.querySelectorAll('.preview-icon');
        const previewImage = document.getElementById('preview-image');
        const hidePreviewButton = document.getElementById('hide-preview-button');


        const previewIconCover = document.querySelectorAll('.preview-icon-cover');
        const previewImageCover = document.getElementById('preview-image-cover');
        const hidePreviewButtonCover = document.getElementById('hide-preview-button-cover');


        previewIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                previewImage.src = src;
                previewImage.style.display = 'block';
                hidePreviewButton.style.display = 'block';
            });
        });
        hidePreviewButton.addEventListener('click', function() {
            previewImage.style.display = 'none';
            hidePreviewButton.style.display = 'none';
        });




        previewIconCover.forEach(icon => {
            icon.addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                previewImageCover.src = src;
                previewImageCover.style.display = 'block';
                hidePreviewButtonCover.style.display = 'block';
            });
        });


        hidePreviewButtonCover.addEventListener('click', function() {
            previewImageCover.style.display = 'none';
            hidePreviewButtonCover.style.display = 'none';
        });

        $('input:radio[name="useLogoFromLastImages"]').change(function() {
            var src = $(this).data('src');


            if (this.checked) {
                var src = $(this).data('src');
                $("#AvatarimagePreview").attr("src", src);
                $("#deletedavatarPic").val(null);
            }
            window.location.hash = "#";

        });

        $('input:radio[name="coverLastImageUsing"]').change(function() {

            var src = $(this).data('src');
            if (this.checked) {
                $('#coverImgPrev').attr('src', src);
                $(".imgCustomCover").css("display", "block");
                $(".coverImgPrevDiv").css("display", "block");
                $(".imgCoverDefualt").css("display", "none");
                $("#deletedCoverPic").val(null);
            }
            window.location.hash = "#";
        });

    });
</script>

@section('content')
    <div id="open-modal1" class="modal-window p-3 shadow border">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-right"> <a href="#" title="Close" class="btn btn-danger m-4 ">بستن</a></div>
            <h2 class="text-center text-black fw-bold">انتخاب تصاویر</h2>
            <label for="avatar_img" class="btn upload__btn btn btn-warning text-dark">
                بارگزاری تصویر جدید
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-upload" viewBox="0 0 16 16">
                        <path
                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                        <path
                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                    </svg></span>

            </label>
        </div>

        <hr>
        <div class="container">
            <div class="upload__box row scroll-bar border  p-1">
                <div class=" position-relative col-md-3 order-md-2 col-12">
                    <img id="preview-image" class="preview-image" alt="Preview">
                    <span id="hide-preview-button" class="btn btn-danger position-absolute"
                        style="top: 2px;right:13px;display:none;">✖</span>
                </div>
                <div class=" col-md-9 order-md-1 col-12 upload__btn-box  mx-auto text-center mt-4"
                    style="overflow-y: scroll;max-height:550px;direction:ltr;">
                    <div class="row">

                        @foreach (Auth::user()->vendor->images as $image)
                            <div class="col-md-2 col-6 p-2">
                                <div class="image-container bg-white  border rounded p-0">
                                    <label for="{{ $image->image }}">
                                        <img class="w-100 img-fluid"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                            alt="">
                                    </label>
                                    <button onclick="deleteProductImage(event,{{ $image->id }})"
                                        class="position-absolute text-danger bg-white" style="top:2px;left:2px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></button>
                                    <input value="{{ $image->image }}"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                        class="image-radio1 position-absolute" style="top:2px; right:2px;" type="radio"
                                        name="useLogoFromLastImages" id="{{ $image->image }}">
                                    <span class="preview-icon btn btn-info w-100" style="font-size: 7px;"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}">
                                        پیش نمایش
                                    </span>
                                </div>
                            </div>
                        @endforeach
                        @if (Auth::user()->vendor->avatar != 'default-avatar.jpg')
                            <div class="col-md-2 col-6 p-2">
                                <div class="image-container bg-white  rounded p-0">
                                    <label for="">
                                        <img class="w-100 img-fluid"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->avatar) }}"
                                            alt="">
                                    </label>
                                    <button onclick="deleteAvatarImage(event,{{ Auth::user()->vendor->id }})"
                                        class="position-absolute text-danger bg-white" style="top:2px;left:2px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></button>
                                    <input value="{{ Auth::user()->vendor->avatar }}"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->avatar) }}"
                                        class="image-checkbox position-absolute" style="top:2px; right:2px;" type="checkbox"
                                        name="lastImages[]" id="{{ Auth::user()->vendor->avatar }}">
                                    <span class="preview-icon btn btn-info w-100" style="font-size: 12px;"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->avatar) }}">
                                        پیش نمایش
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->vendor->avatar != 'default-cover.jpg')
                            <div class="col-md-2 col-6 p-2">
                                <div class="image-container bg-white  rounded p-0">
                                    <label for="">
                                        <img class="w-100 img-fluid"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->cover) }}"
                                            alt="">
                                    </label>
                                    <button onclick="deleteCoverImage(event,{{ Auth::user()->vendor->id }})"
                                        class="position-absolute text-danger bg-white" style="top:2px;left:2px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></button>
                                    <input value="{{ Auth::user()->vendor->cover }}"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->cover) }}"
                                        class="image-checkbox position-absolute" style="top:2px; right:2px;"
                                        type="checkbox" name="lastImages[]" id="{{ Auth::user()->vendor->cover }}">
                                    <span class="preview-icon btn btn-info w-100" style="font-size: 12px;"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->cover) }}">
                                        پیش نمایش
                                    </span>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>





        </div>


    </div>

    <div id="open-modal2" class="modal-window">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-right"> <a href="#" title="Close" class="btn btn-danger m-4 ">بستن</a></div>
            <h2 class="text-center text-black fw-bold">انتخاب تصاویر</h2>
            <label for="avatar_img" class="btn upload__btn btn btn-warning text-dark">
                بارگزاری تصویر جدید
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-upload" viewBox="0 0 16 16">
                        <path
                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                        <path
                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                    </svg></span>

            </label>
        </div>
        <hr>
        <div class="container">
            <div class="upload__box row scroll-bar border  p-1">
                <div class=" position-relative col-md-3 order-md-2 col-12">
                    <img id="preview-image-cover" class="preview-image " alt="Preview">
                    <span id="hide-preview-button-cover" class="btn btn-danger  position-absolute"
                        style="top: 2px;right:13px;display:none;">✖</span>
                </div>
                <div class="col-md-9 order-md-1 col-12 upload__btn-box  mx-auto text-center mt-4 "
                    style="overflow-y: scroll;max-height:550px;direction:ltr;">
                    <div class="row">

                        @foreach (Auth::user()->vendor->images as $image)
                            <div class="col-md-2 col-6 p-2">
                                <div class="image-container bg-white   rounded p-0">
                                    <label for="cover{{ $image->image }}">
                                        <img class="w-100 img-fluid"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                            alt="">
                                    </label>
                                    <button onclick="deleteProductImage(event,{{ $image->id }})"
                                        class="position-absolute text-danger bg-white" style="top:2px;left:2px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></button>
                                    <input value="{{ $image->image }}"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                        class="image-radio2  position-absolute" style="top:2px; right:2px;"
                                        type="radio" name="coverLastImageUsing" id="cover{{ $image->image }}">
                                    <span class="preview-icon-cover btn btn-info w-100" style="font-size: 12px;"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}">
                                        پیش نمایش
                                    </span>
                                </div>
                            </div>
                        @endforeach
                        @if (Auth::user()->vendor->avatar != 'default-avatar.jpg')
                            <div class="col-md-2 col-6 p-2">
                                <div class="image-container bg-white  rounded p-0">
                                    <label for="">
                                        <img class="w-100 img-fluid"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->avatar) }}"
                                            alt="">
                                    </label>
                                    <button onclick="deleteAvatarImage(event,{{ Auth::user()->vendor->id }})"
                                        class="position-absolute text-danger bg-white" style="top:2px;left:2px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></button>
                                    <input value="{{ Auth::user()->vendor->avatar }}"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->avatar) }}"
                                        class="image-checkbox position-absolute" style="top:2px; right:2px;"
                                        type="checkbox" name="lastImages[]" id="{{ Auth::user()->vendor->avatar }}">
                                    <span class="preview-icon btn btn-info w-100" style="font-size: 12px;"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->avatar) }}">
                                        پیش نمایش
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->vendor->avatar != 'default-cover.jpg')
                            <div class="col-md-2 col-6 p-2">
                                <div class="image-container bg-white  rounded p-0">
                                    <label for="">
                                        <img class="w-100 img-fluid"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->cover) }}"
                                            alt="">
                                    </label>
                                    <button onclick="deleteCoverImage(event,{{ Auth::user()->vendor->id }})"
                                        class="position-absolute text-danger bg-white" style="top:2px;left:2px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></button>
                                    <input value="{{ Auth::user()->vendor->cover }}"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->cover) }}"
                                        class="image-checkbox position-absolute" style="top:2px; right:2px;"
                                        type="checkbox" name="lastImages[]" id="{{ Auth::user()->vendor->cover }}">
                                    <span class="preview-icon btn btn-info w-100" style="font-size: 12px;"
                                        data-src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . Auth::user()->vendor->cover) }}">
                                        پیش نمایش
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>


        </div>


    </div>

    @if (Auth::user()->vendor->status == 'no')
        <div class="alert alert-info">

            خوش آمدید ،

            لطفا ابتدا فیلد های زیر را با پر کنید و در انتها دسته فعالیت فروشگاه خود را انتخاب نمایید

        </div>
    @endif








    <?php
    
    if (isset($dataa)) {
        if (!is_null($dataa)) {
            $lastOne = count($dataa) - 1;
        }
    }
    
    // dd($data);
    $vid = $user->vendor->id;
    
    ?>



    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif



    <!-- Content Row -->
    <div class="row">



        <div class="col-xl-2 col-md-2 mb-4 bg-white rounded">

            <h5 class="mt-1">لوگو : </h5>


            <div class="position-relative " style="text-align: center">

                @if (getVendorLastDate($vid, 'avatar') != 'default-avatar.png')
                    <label class="position-absolute bg-secondary btn text-danger p-2 rounded-circle"
                        style="top:20px;right:5px;" onclick="deleteAvatar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </label>
                @endif



                <a class="position-absolute bg-secondary text-warning  p-2 rounded-circle" style="top:95px;right:5px;"
                    href="#open-modal1">

                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-pen" viewBox="0 0 16 16">
                        <path
                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                    </svg>
                </a>
                <img class="rounded-circle mx-auto" style="width: 165px; height:165px;  border:2px solid gray;"
                    id="AvatarimagePreview"
                    src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . getVendorLastDate($vid, 'avatar')) }}"
                    alt="{{ getVendorLastDate($vid, 'avatar') }}">

            </div>


            <div class="py-3"> <small class="">لوگوی فروشگاه خود را از اینجا تغییر دهید</small></div>
        </div>

        <div class="col-xl-10 col-md-10 mb-4 bg-white">


            {{-- @include('user.sections.errors') --}}

            {{-- Show Primary Image --}}
            <div class="row">


                <div class="col-12 col-md-12">
                    <h5 class="mt-1">کاور : </h5>
                </div>
                <div class="col-12 position-relative">

                    {{--  @if (getVendorLastDate($vid, 'cover') != 'default-cover.jpg')  --}}
                    <div @if (getVendorLastDate($vid, 'cover') == 'default-cover.jpg') style="display: none" @endif
                        class="cover-vendor-div  
                
                coverImgPrevDiv
                ">

                        <img class="" id="coverImgPrev"
                            src="{{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . getVendorLastDate($vid, 'cover')) }}"
                            alt="{{ getVendorLastDate($vid, 'cover') }}">

                    </div>
                    {{--  @endif  --}}

                    <div class="imgCustomCover  "
                        style="overflow: hidden !important;
                        
                        @if (getVendorLastDate($vid, 'cover') == 'default-cover.jpg') display:none; @endif
                        ">




                        <div class="" style="">

                            <label class=" position-absolute bg-white p-2 rounded-circle btn" style="top:14px;right:24px;"
                                onclick="deleteCover()"> <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" fill="currentColor" class="bi bi-trash text-danger"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                            </label>

                            <a href="#open-modal2" class="btn bg-white p-2 text-warning rounded-circle position-absolute"
                                style="top:13px;right:74px;">

                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg>
                            </a>




                            {{--  <button class="editPhotoBtn" data-toggle="modal" data-target="#exampleModal"> ویرایش
                                پیشرفته </button>  --}}

                        </div>
                        <p class="pt-4">ابعاد کاور فروشگاه باید 1300 * 350 باشد</p>
                    </div>

                    <div class="card imgCoverDefualt py-3"
                        style="overflow: hidden !important;
                            
                            @if (getVendorLastDate($vid, 'cover') != 'default-cover.jpg') display:none; @endif
                        
                        ">

                        <div class="card-img-top img-fluid" style="width: 100%; height: 25vh; border: 2px dashed black; "
                            src="" alt="">
                        </div>

                        <label for="cover_img" class=" btn btn-info ">
                            کاور فروشگاه خود را از اینجا تغییر دهید

                        </label>
                    </div>

                </div>

            </div>
        </div>
    </div>

    </div>


    <div class="mb-4 text-center text-md-right">
        @if ($user->vendor->status == 'no')
            <hr>

            <h5 class="font-weight-bold">
                تکمیل اطلاعات فروشگاه
            </h5>
            <hr>
        @endif
    </div>

    {{-- @include('user.sections.errors') --}}

    <form action="{{ route('user.vendor.update', ['vendor' => $user->vendor->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')



        <input type="hidden" name="deletedavatarPic" id="deletedavatarPic">

        <input type="hidden" name="deletedCoverPic" id="deletedCoverPic">



        <input type="file" accept=".png, .jpg, .jpeg" name="avatar" id="avatar_img" style="display: none;">


        <input type="file" accept=".png, .jpg, .jpeg" name="cover" id="cover_img" style="display: none;">



        <input type="hidden" id="hiddenCatInput" name="Category">



        <div class="form-row px-4">
            <div class="form-group col-sm-12 col-md-2">
                <label for="name">نام فروشگاه</label>
                <input class="form-control" id="name" name="name" type="text"
                    value="@if (is_null($vendor->EditedData)) {{ $vendor->title }}@else {{ getVendorLastDate($vid, 'title') }} @endif">
            </div>

            <div class="form-group col-md-2">

                <label for="phone_number">
                    شماره تلفن همراه
                </label>
                <input class="form-control" id="cellphone" name="phone_number" type="text"
                    value="{{ getVendorLastDate($vid, 'phone_number') }}">


            </div>

            <div class="form-group col-sm-12 col-md-2">
                <label for="phone">تلفن ثابت</label>
                <input class="form-control" id="phone" name="number" type="text"
                    value="{{ getVendorLastDate($vid, 'number') }}">
            </div>
            <div class="form-group col-sm-12 col-md-2">
                <label for="phone_number2"> تلفن ثابت2</label>
                <input class="form-control" id="phone_number2" name="phone_number2" type="text"
                    value="{{ getVendorLastDate($vid, 'phone_number2') }}">
            </div>

            <div class="form-group col-sm-12 col-md-4">
                <label for="address">آدرس</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ getVendorLastDate($vid, 'address') }}">

            </div>




            <div class="form-group col-xs-12 col-md-4   ">
                <label for="description">
                    شرح فعالیت
                </label>
                <textarea class="form-control" id="description" style="height: 200px; " name="description">{{ str_replace('<br />', ' ', getVendorLastDate($vid, 'description')) }}</textarea>








                @if (App\Models\Admin\SiteSetting::select('aparat_vendor')->first()->aparat_vendor)
                    <div class="form-group ">
                        <label for="apatatVideoLink">لینک آپارات <small>(این ویدیو باید درباره فروشگاه شما باشد و در صفحه
                                فروشگاه نشان داده خواهد شد ... برای این کار شما باید لینک script ویویو را در سایت آپارات کپی
                                و در اینجا جایگذاری کنید ...)</small> </label>
                        <input type="text" class="form-control" id="apatatVideoLink" name="apatatVideoLink"
                            value="{{ getVendorLastDate($vid, 'apatatVideoLink') }}">

                    </div>
                @endif
            </div>
            <hr>


            <div class="form-group col-xs-12 col-md-3 col-12" style="margin-top: 10px">

                <div class="form-group">

                    <span style="">امکان ارسال سریع محصولات</span>

                    <div>
                        <label for="q1y">بله</label>

                        <input type="radio" name="q1"
                            @if ($user->vendor->q1 == 1) @checked(true) @endif value="1"
                            id="q1y">

                        <label for="q1">خیر</label>
                        <input type="radio" name="q1"
                            @if ($user->vendor->q1 == 0) @checked(true) @endif value="0"
                            id="q1n">

                    </div>


                </div>
                <div class="form-group">

                    <span>ارسال رایگان</span>

                    <div>
                        <label for="q2y">بله</label>
                        <input @if ($user->vendor->q2 != 0) @checked(true) @endif
                            onchange="$('#minq2').css('display' , 'block');" type="radio" name="q2"
                            value="1" id="q2y">


                        <label for="q2n">خیر</label>
                        <input @if ($user->vendor->q2 == 0) @checked(true) @endif type="radio"
                            onchange="$('#minq2').css('display' , 'none');" name="q2" value="0"
                            id="q2n">
                    </div>

                    <input type="text" id="minq2" @if ($user->vendor->q2 == 0) style="display:none;" @endif
                        name="minq2" placeholder="حداقل مبلغ خرید" value="{{ $user->vendor->q2 }}">


                </div>

                <div class="form-group">


                    <span>امکان ارسال به شهرستان </span>
                    <div class="">
                        <label for="q3y">بله</label>

                        <input @if ($user->vendor->q3 == 1) @checked(true) @endif type="radio"
                            name="q3" value="1" id="q3y">

                        <label for="q3n">خیر</label>
                        <input type="radio" @if ($user->vendor->q3 == 0) @checked(true) @endif
                            name="q3" value="0" id="q3n">

                    </div>
                </div>

                <div class="form-group">

                    <span>امکان مرجوعی کالا </span>

                    <div class="">

                        <label for="q4y">بله</label>

                        <input @if ($user->vendor->q4 != 0) @checked(true) @endif
                            onchange="$('#minq4').css('display' , 'block');" type="radio" name="q4"
                            value="1" id="q4y">


                        <label for="q4n">خیر</label>
                        <input @if ($user->vendor->q4 == 0) @checked(true) @endif type="radio"
                            name="q4" onchange="$('#minq4').css('display' , 'none');" value="0"
                            id="q4n">
                    </div>

                    <input type="text" @if ($user->vendor->q4 == 0) style="display:none;" @endif id="minq4"
                        name="minq4" value="{{ $user->vendor->q4 }}" placeholder="چند روز">
                </div>



            </div>

            <div class="form-group col-xs-12 col-12 col-md-3" style="margin-top: 10px">

                لوکیشن




                <div id="map" style=" height: 250px; background: #eee; border: 2px solid #aaa;"></div>

            </div>



            <div class="col-12">

                <label for="description">

                    دسته فعالیت
                    <svg style="width: 11px;height: 11px;color: red;" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
                        <path
                            d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                    </svg>
                </label>
                @if ($errors->has('Category'))
                    <div class="text-danger">{{ $errors->first('Category') }}</div>
                @endif
            </div>
            <div class="col-12 d-md-flex">
                @foreach (\App\Models\Category::lvl_one()->orderBy('created_at')->get() as $key => $category)
                    <div class="" style="">

                        <input <?php
                        
                        $data = str_replace('-', ' ', strval($user->vendor->category_activity));
                        
                        $d = explode('-', $user->vendor->category_activity);
                        ?>
                            @foreach ($d as $ddd) 

                            @if ($ddd == $category->id)

                                checked

                            @endif @endforeach
                            class="form-check-input m-0 d-inline categoryCheckBox" type="checkbox" onchange="inputCats()"
                            style="position: inherit;" value="{{ $category->id }}" id="category_{{ $key }}">
                        <label class="form-check-label" for="category_{{ $key }}"
                            style="margin: 0 0 0 7.5px!important;">
                            {{ $category->name }}

                        </label>
                    </div>
                @endforeach

            </div>
            <hr>






            <div class="form-row" id="divSocials" style=" margin:5%;">



                <div class="form-group col-sm-12 col-md-3">
                    <img class="iconsocialhover input-group-prepend d-inline my-1" style="width:30px;"
                        src="{{ asset('images/logo-website-website-logo-png-transparent-background-background-15.png') }}"
                        alt="">
                    <label for="website">
                        وبسایت:
                    </label>


                    <input type="text" dir="ltr" class="form-control" name="website"
                        value="{{ getVendorLastSocialMediaDate($vid, 'website') }}" aria-describedby="basic-addon3">




                </div>




                <div class="form-group col-sm-12 col-md-3 ">
                    <img class="iconsocialhover input-group-prepend d-inline  my-1" style="width:30px;"
                        src="{{ asset('main/images/socialicons/icons8-telegram-app.svg') }}" alt="">
                    <label for="site_url">
                        تلگرام:

                        <small>
                            (بدون @)
                        </small>
                    </label>

                    <?php $telegram = $user->vendor->socialMedias ? substr($user->vendor->socialMedias->telegram, 20) : ' '; ?>
                    <input type="text" dir="ltr" class="form-control" name="telegram"
                        value="{{ getVendorLastSocialMediaDate($vid, 'telegram') }}" aria-describedby="basic-addon3">



                </div>




                <div class="form-group col-sm-12 col-md-3">
                    <img class="iconsocialhover input-group-prepend d-inline my-1" style="width:30px;"
                        src="{{ asset('images/Rubika_logo888.png') }}" alt="">
                    <label for="site_url" style="margin-right: 2px;">
                        روبیکا:


                    </label>

                    <?php $robika = $user->vendor->socialMedias ? $user->vendor->socialMedias->robika : ' '; ?>
                    <input type="text" dir="ltr" class="form-control" name="robika"
                        value="{{ getVendorLastSocialMediaDate($vid, 'robika') }}" aria-describedby="basic-addon3">

                </div>



                <div class="form-group col-sm-12 col-md-3">
                    <div class="input-group-prepend d-inline">
                        <img class="iconsocialhover " style="width:40px;"
                            src="{{ asset('main/images/socialicons/icons8-instagram.svg') }}" alt="">
                    </div>
                    <label for="site_url">

                        اینستاگرام:


                    </label>
                    <?php
                    
                    if (isset($user->vendor->socialMedias->instagram)) {
                        $instagram = substr($user->vendor->socialMedias->instagram, 26);
                    } else {
                        $instagram = '';
                    }
                    
                    ?>

                    <input type="text" dir="ltr" class="form-control" name="instagram"
                        value="{{ getVendorLastSocialMediaDate($vid, 'instagram') }}" aria-describedby="basic-addon3">





                </div>


                <div class="form-group col-sm-12 col-md-3">
                    <img class="iconsocialhover" style="width:40px!important;"
                        src="{{ asset('main/images/socialicons/icons8-aparat.svg') }}" alt="">
                    <label for="site_url">

                        آپارات:


                    </label>




                    <?php
                    
                    if (isset($user->vendor->socialMedias->aparat)) {
                        $aparat = substr($user->vendor->socialMedias->aparat, 23);
                    } else {
                        $aparat = '';
                    }
                    
                    ?>
                    <input type="text" dir="ltr" class="form-control" name="aparat"
                        value="{{ getVendorLastSocialMediaDate($vid, 'aparat') }}" aria-describedby="basic-addon3">
                </div>

                <div class="form-group col-sm-12 col-md-3">

                    <img class="iconsocialhover" style="width:35px!important;margin-bottom:5px;"
                        src="{{ asset('main/images/socialicons/icons8-email-48.png') }}" alt="">
                    <label class="" for="site_url">
                        ایمیل:
                    </label>


                    <?php
                    
                    if (isset($user->vendor->socialMedias->email)) {
                        $email = $user->vendor->socialMedias->email;
                    } else {
                        $email = '';
                    }
                    
                    ?>



                    <input type="email" dir="ltr" class="form-control"style="" name="email"
                        value="{{ getVendorLastSocialMediaDate($vid, 'email') }}" aria-describedby="basic-addon3">











                </div>
                <div class="form-group col-sm-12 col-md-3 ">

                    <img class="iconsocialhover " style="width:40px;"
                        src="{{ asset('main/images/socialicons/icons8-whatsapp.svg') }}" alt="">


                    <?php
                    
                    ?>
                    <label for="site_url">

                        واتساپ:


                    </label>



                    <input type="text" dir="ltr" class="form-control" style="width: 100%;" name="whatsapp"
                        value="{{ getVendorLastSocialMediaDate($vid, 'whatsapp') }}" aria-describedby="basic-addon3">




                </div>
                <div class="form-group col-sm-12 col-md-3">

                    <img class="iconsocialhover d-inline-block " style="width:30px;margin-bottom:10px;"
                        src="{{ asset('images/main-logo.png') }}" alt="">


                    <?php
                    
                    if (isset($user->vendor->socialMedias->whatsapp)) {
                        $whatsapp = substr($user->vendor->socialMedias->whatsapp, 39);
                    } else {
                        $whatsapp = substr($user->vendor->phone_number, 1);
                    }
                    ?>
                    <label for="site_url" class="d-inline-block ">

                        پیام رسان بله:


                    </label>

                    <input type="text" dir="ltr" class="form-control" style="width: 100%;" name="bale"
                        value="{{ getVendorLastSocialMediaDate($vid, 'bale') }}" aria-describedby="basic-addon3">




                </div>
            </div>


            <input type="hidden" name="latlng" id="latlng">


        </div>

        @if ($user->vendor->status == 'no')
            <button class="btn btn-outline-primary mt-5" onclick="inputCats()" type="submit">
                تایید
            </button>
        @else
            <a href="{{ route('user.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            <button class="btn btn-outline-primary mt-5" onclick="inputCats()" type="submit">ویرایش</button>
        @endif

    </form>
    </div>

    </div>
@endsection


<!-- Modal logo -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> تغییر لوگوی فروشگاه</h5>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="col-md-4 text-center">
                        <div id="upload-demo-logo"></div>
                    </div>

                    <input type="file" accept=".png, .jpg, .jpeg" id="logo">

                </div>
                <div class="modal-footer">

                    <button class="btn btn-success btn-upload-image-logo" style="margin-top:2%"> تغییر لوگو
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var resize = $('#upload-demo-logo').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 400,
                height: 400,
                type: 'square' //square
            },
            boundary: {
                width: 500,
                height: 500
            }
        });


        // $('#logo').on('change', function() {
        // var reader = new FileReader();
        // reader.onload = function(e) {
        resize.croppie('bind', {
                url: {{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . $user->vendor->cover) }}
            }

        }
        }
        // reader.readAsDataURL(this.files[0]);
        // });


        $('.btn-upload-image-logo').on('click', function(ev) {
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport',
                quality: 1
            }).then(function(img) {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });


                var files = $('#logo')[0].files;
                var formData = new FormData();

                formData.append('avatar', img);

                $.ajax({
                    type: "POST",
                    // dataType: "json",
                    url: "{{ route('images.set_avatar') }}",
                    data: formData,
                    enctype: 'multipart/form-data',
                    async: false,
                    cache: false,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType

                    success: function(data) {

                        // console.log(data);
                        location.reload();

                    },
                    error: function(data) {

                        console.log(data);
                    }
                });
            });
        });
    </script>


</div>



</div>
