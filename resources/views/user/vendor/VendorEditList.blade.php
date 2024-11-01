@extends('user.layouts.user')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
<link rel="stylesheet" href="{{ asset('Croppie-master/croppie.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

@section('title')
    ویرایش فروشگاه
@endsection


@section('script')
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('Croppie-master/croppie.min.js') }}"></script>



    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>


    <script>
        function showSocialInputs() {

            $('#divSocials').css('display', 'block');
        }




        function inputCats() {



            let cat_array = [];



            $('.categoryCheckBox:checked').each(function() {


                cat_array.push(this.value);

            });

            $('#hiddenCatInput').val(cat_array);





        };



        var map = L.map('map').setView([35.7219, 51.3347], 13);


        var marker = L.marker([35.7219, 51.3347]).addTo(map);


        marker.addTo(map);


        L.marker([35.7219, 51.3347]).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);



        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        var popup = L.popup()
            .setLatLng([35.7219, 51.3347])
            .setContent("I am a standalone popup.")
            .openOn(map);





        var lat = map.on('click', function(e) {

            popup
                .setLatLng(e.latlng)
                .setContent("موقعیت جدید شما : " + e.latlng.toString())
                .openOn(map);


            L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)


            $('#latlng').val(e.latlng.toString());


            //  return e.latlng.toString();

        });


        // console.log(lat);
    </script>
    <style>
        .editPhotoBtn {
            transition: all .1s;
        }

        .editPhotoBtn:hover {
            background-color: black;
            scale: 1.1;
        }


        #map {
            height: 270px;
            width: 500px;
        }
    </style>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
@endsection


@section('content')








    <form action="{{ route('user.vendor.images.set_avatar', ['vendor' => $user->vendor]) }}" id="avatarForm" method="post"
        enctype="multipart/form-data">

        @csrf



        <input type="file" onchange="$('#avatarForm').submit()" name="avatar" id="avatar_img" style="display: none;">


    </form>

    <form id="coverForm" action="{{ route('update-cover', ['vendor' => $user->vendor]) }} )}}" method="post"
        enctype="multipart/form-data">

        @csrf
        <input type="file" onchange="$('#coverForm').submit()" name="cover" id="cover_img" style="display: none;">


    </form>


    <form action="{{ route('delete-cover') }}" method="post" id="deleteCover">
        @csrf
        <input type="hidden" name="vId" value="{{ $user->vendor->id }}">
    </form>

    <form action="" method="post" id="deleteLogo">
        <input type="hidden" name="vId" value="{{ $user->vendor->id }}">
    </form>
    <div class="container-fluid">
        <div class="d-xs-block d-md-none ">
            @if (\App\Models\Admin\SiteSetting::first()->paymentStatus)
                <div
                    @if (Auth::user()->CREDIT < 10000) class="alert alert-danger "
    
         @else
         class="alert alert-info " @endif>
                    {{-- @dd(Auth::user()->CREDIT); --}}
                    موجودی حساب شما : {{ Auth::user()->CREDIT }} تومان

                    <a class="btn btn-success" href="{{ route('user.orders.index') }}"> افزایش حساب +</a>

                </div>
            @endif
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">



        <div class="col-xl-2 col-md-2 mb-4 bg-white">

            <h5>لوگو : </h5>






            <div class="card" style="border:none;">
                <img class="card-img-top" style="width: 150px; height:150px; border:2px solid gray; border-radius:50px; "
                    src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $user->vendor->avatar) }}"
                    alt="{{ $user->vendor->name }}">

                <label class="editPhotoBtn"
                    style="position: absolute;  border-radius: 50%;  background-color: rgba(32, 32, 32, 0.308);  cursor:pointer;"
                    for="avatar_img">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        style="   color:white; justify-content: center; align-items:center; text-align: center;margin:50px;"
                        width="40" height="40" fill="currentColor" class="bi bi-pen" viewBox="0 0 20 20">
                        <path
                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                    </svg>

                </label>
            </div>


            <small>لوگوی فروشگاه خود را از اینجا تغییر دهید</small>
        </div>

        <div class="col-xl-10 col-md-10 mb-4 bg-white">


            {{-- @include('user.sections.errors') --}}

            {{-- Show Primary Image --}}
            <div class="row">


                <div class="col-12 col-md-12">
                    <h5 class="mt-1">کاور : </h5>
                </div>



                <div class="col-12">
                    @if ($user->vendor->cover != 'default-cover.jpg')
                        <div class="card" style="overflow: hidden !important;">

                            <img class="card-img-top" style="width: 100%;   max-height: 25vh;"
                                src="{{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . $user->vendor->cover) }}"
                                alt="{{ $user->vendor->name }}">

                            <div class=""
                                style="position: absolute; padding-top: 10px; background-color: rgba(32, 32, 32, 0.308);  cursor:pointer; font-size:50px;">

                                <label class="editPhotoBtn" onclick="$('#deleteCover').submit();"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="red"
                                        class="bi bi-trash" viewBox="0 0 50 50">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </label>

                                <label class="editPhotoBtn" for="cover_img">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        style=" paddin-left:20px;  color:white; justify-content: center; align-items:center; text-align: center;"
                                        width="100" height="100" fill="currentColor" class="bi bi-pen"
                                        viewBox="0 0 50 50">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="card" style="overflow: hidden !important;">

                            <div class="card-img-top" style="width: 100%; height: 25vh; border: 2px dashed black; "
                                src="" alt="">
                            </div>


                            <div class=""
                                style="position: absolute;  background-color: rgba(32, 32, 32, 0.308);  cursor:pointer;margin-right: 50%; margin-top: 10%;">

                                <label class="editPhotoBtn" style="" for="cover_img">


                                    <small> کاور فروشگاه خود را از اینجا تغییر دهید</small>


                                </label>
                            </div>


                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <hr>


    <div class="mb-4 text-center text-md-right">
        @if ($user->vendor->status == 'no')
            <h5 class="font-weight-bold">
                تکمیل اطلاعات فروشگاه
            </h5>
        @endif
    </div>
    <hr>

    {{-- @include('user.sections.errors') --}}


    <form action="{{ route('user.vendor.update', ['vendor' => $user->vendor->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" id="hiddenCatInput" name="Category">

        <div class="form-row">
            <div class="form-group col-sm-12 col-md-2">
                <label for="name">نام فروشگاه</label>
                <input class="form-control" id="name" name="name" type="text"
                    value="{{ old('name', $user->vendor->title) }}">
            </div>

            <div class="form-group col-md-2">

                <label for="cellphone">
                    شماره واتساپ
                </label>
                <input class="form-control" id="cellphone" name="cellphone" type="text"
                    value="{{ old('cellphone', $user->vendor->phone_number) }}">


            </div>

            <div class="form-group col-sm-12 col-md-2">
                <label for="phone">تلفن ثابت</label>
                <input class="form-control" id="phone" name="phone" type="text"
                    value="{{ old('phone', $user->vendor->number) }}">
            </div>
            <div class="form-group col-sm-12 col-md-2">
                <label for="phone_number2"> تلفن ثابت2</label>
                <input class="form-control" id="phone_number2" name="phone_number2" type="text"
                    value="{{ old('phone_number2', $user->vendor->phone_number2) }}">
            </div>

            <div class="form-group col-sm-12 col-md-2">
                <label for="address">آدرس</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ $user->vendor->address }}">

            </div>





            <div class="form-group col-xs-12 col-md-6">
                <label for="description">
                    شرح فعالیت
                </label>
                <textarea class="form-control" id="description" style="height: 270px;" name="description">{{ $user->vendor->description }}</textarea>
            </div>
            <hr>



            <div class="form-group col-xs-12 col-md-6" style="margin-top: 10px">

                لوکیشن

                <div class="col-12" id="map"></div>

            </div>






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
            <div class="col-12 d-md-flex">
                @foreach (\App\Models\Category::lvl_one()->orderBy('created_at')->get() as $key => $category)
                    <div>

                        <label class="form-check-label " for="category_{{ $key }}"
                            style="margin: 0 5px 0 15px;">
                            {{ $category->name }}

                        </label>
                        <input <?php
                        
                        $data = str_replace('-', ' ', strval($user->vendor->category_activity));
                        
                        $d = explode('-', $user->vendor->category_activity);
                        ?>
                            @foreach ($d as $ddd) 

                            @if ($ddd == $category->id)

                                checked

                            @endif @endforeach
                            class="form-check-input m-0 p-2 categoryCheckBox" type="checkbox" onchange="inputCats()"
                            style="position: inherit; margin-left:0" value="{{ $category->id }}"
                            id="category_{{ $key }}">
                    </div>
                @endforeach

            </div>
            <hr>





            <div class="form-row" id="divSocials" style=" margin:5%;">

                <div class="col-3">
                    <label class="col-12" for="site_url">
                        وبسایت
                    </label>


                    <div class="col-12 d-flex">
                        <input type="text" dir="ltr" class="form-control"style="width:50% !important;"
                            name="site_url" value="{{ old('site_url', $user->vendor->site_url) }}"
                            aria-describedby="basic-addon3">


                        <div style="width: 12%;" class="input-group-prepend">

                            <img class="iconsocialhover"
                                src="{{ asset('main/images/socialicons/icons8-internet-16.png') }}" alt="">
                        </div>
                    </div>

                </div>

                <div class="col-3">
                    <label class="col-12" for="site_url">
                        تلگرام

                        <small>
                            (بدون @)
                        </small>
                    </label>
                    <div class="col-12 d-flex">
                        <?php $telegram = $user->vendor->socialMedias ? substr($user->vendor->socialMedias->telegram, 20) : ' '; ?>
                        <input type="text" dir="ltr" class="form-control"style="width:50% !important;"
                            name="telegram" value="{{ old('site_url', $telegram) }}" aria-describedby="basic-addon3">


                        <div class="input-group-prepend">
                            <img class="iconsocialhover"
                                src="{{ asset('main/images/socialicons/icons8-telegram-app.svg') }}" alt="">
                        </div>

                    </div>


                </div>

                <div class="col-3">
                    <label class="col-12" for="site_url">

                        روبیکا


                    </label>
                    <div class="col-12 d-flex">
                        <?php $robika = $user->vendor->socialMedias ? $user->vendor->socialMedias->robika : ' '; ?>
                        <input type="text" dir="ltr" class="form-control"style="width:50% !important;"
                            name="rubika" value="{{ old('site_url', $robika) }}" aria-describedby="basic-addon3">





                    </div>


                </div>

                <div class="col-3">
                    <label class="col-6 " for="site_url">

                        واتساپ

                        <small>
                            ( بدون صفر اولیه)
                        </small>
                    </label>

                    <div class="col-6">
                        <?php
                        
                        if (isset($user->vendor->socialMedias->whatsapp)) {
                            $whatsapp = substr($user->vendor->socialMedias->whatsapp, 39);
                        } else {
                            $whatsapp = substr($user->vendor->phone_number, 1);
                        }
                        ?>


                        <input type="text" dir="ltr" class="form-control"style="width:50% !important;"
                            name="whatsapp" value="{{ old('site_url', $whatsapp) }}" aria-describedby="basic-addon3">

                        <img class="iconsocialhover" src="{{ asset('main/images/socialicons/icons8-whatsapp.svg') }}"
                            alt="">
                    </div>

                </div>

                <div class="col-3">



                    <div class="col-12 d-flex">


                        <?php
                        
                        if (isset($user->vendor->socialMedias->instagram)) {
                            $instagram = substr($user->vendor->socialMedias->instagram, 26);
                        } else {
                            $instagram = '';
                        }
                        
                        ?>

                        <input type="text" dir="ltr" class="form-control"style="width:50% !important;"
                            name="instagram" value="{{ old('site_url', $instagram) }}" aria-describedby="basic-addon3">


                        <div class="input-group-prepend">
                            <img class="iconsocialhover"
                                src="{{ asset('main/images/socialicons/icons8-instagram.svg') }}" alt="">
                        </div>

                    </div>
                </div>


                <div class="col-3">



                    <div class="col-12 d-flex">
                        <?php
                        
                        if (isset($user->vendor->socialMedias->aparat)) {
                            $aparat = substr($user->vendor->socialMedias->aparat, 23);
                        } else {
                            $aparat = '';
                        }
                        
                        ?>
                        <input type="text" dir="ltr" class="form-control"style="width:50% !important;"
                            name="aparat" value="{{ old('site_url', $aparat) }}" aria-describedby="basic-addon3">


                        <div class="input-group-prepend">
                            <img class="iconsocialhover" src="{{ asset('main/images/socialicons/icons8-aparat.svg') }}"
                                alt="">

                        </div>

                    </div>
                </div>




                <label class="" for="site_url">
                    ایمیل
                </label>


                <?php
                
                if (isset($user->vendor->socialMedias->email)) {
                    $email = $user->vendor->socialMedias->email;
                } else {
                    $email = '';
                }
                
                ?>



                <div class="
                    ">
                    <div class="col-12 d-flex">
                        <input type="email" dir="ltr" class="form-control"style="" name="email"
                            value="{{ old('site_url', $email) }}" aria-describedby="basic-addon3">


                        <small>
                            <img class="iconsocialhover" src="{{ asset('main/images/socialicons/icons8-email-48.png') }}"
                                alt="">
                        </small>

                    </div>



                </div>


            </div>







            <input type="hidden" name="latlng" id="latlng">


        </div>

        @if ($user->vendor->status == 'no')
            <button class="btn btn-outline-primary mt-5" type="submit">
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
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                    <input type="file" id="logo">

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


        $('#logo').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                resize.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


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
