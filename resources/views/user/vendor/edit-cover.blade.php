{{-- <!-- Modal cover -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">تغییر کاور فروشگاه</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
        </div>
        <div class="modal-body">
            <div  class="">
                <div class="col-md-4 text-center">
                    <div class="col-12" id="upload-demo-cover"></div>
                </div>

                    <input type="file" id="cover">  

                    </div>
        <div class="modal-footer">

          <button class="btn btn-success btn-upload-cover" style="margin-top:2%"> تغییر کاوز
        </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>

    </div>        </div>
      </div>
    </div>

    <script type="text/javascript">
        var resize = $('#upload-demo-cover').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 1600,
                height: 800,
                type: 'square' //square
            },
            boundary: {
                width: 300,
                height: 300
            }
        });
    
    
        $('#cover').on('change', function() {
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
    
    
        $('.btn-upload-cover').on('click', function(ev) {
            console.log( $('#upload-demo-cover'));

            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(img) {
    
    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
    
    
                var files = $('#cover')[0].files;
                var formData = new FormData();
    
                
                formData.append('cover', img);
    
                
                $.ajax({
                    type: "POST",
                    // dataType: "json",
                    url: "{{ route('update-cover') }}",
                    data: formData,
                    enctype: 'multipart/form-data',
                    async: false,
                    cache: false,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
    
                    success: function(data) {
    
                        console.log(data);
    
    


                    },
                    error: function(data) {
    
                        console.log(data);
                    }
                });
            });
        });
    </script>
    
  </div> --}}

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



        var map = L.map('map').setView([{{ $user->vendor->lat }}, {{ $user->vendor->lng }}], 13);


        var marker = L.marker([{{ $user->vendor->lat }}, {{ $user->vendor->lng }}]).addTo(map);


        marker.addTo(map);


        L.marker([{{ $user->vendor->lat }}, {{ $user->vendor->lng }}]).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);



        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        var popup = L.popup()
            .setLatLng([{{ $user->vendor->lat }}, {{ $user->vendor->lng }}])
            .setContent("I am a standalone popup.")
            .openOn(map);





        var lat = map.on('click', function(e) {

            popup
                .setLatLng(e.latlng)
                .setContent("موقعیت جدید شما : " + e.latlng.toString())
                .openOn(map);


            L.marker([{{ $user->vendor->lat }}, {{ $user->vendor->lng }}]).addTo(map)


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
            height: 400px;
            width: 500px;
        }
    </style>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
@endsection


@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">

            <div class="col-xl-12 col-md-12 mb-4 bg-white">
                <div class="mb-4 text-center text-md-right">
                    <h5 class="font-weight-bold">ویرایش کاور فروشگاه : {{ $user->vendor->name }}</h5>
                </div>


                @include('user.sections.errors')

                {{-- Show Primary Image --}}
                <div class="row">


                    <div class="col-12 col-md-12 mb-5">
                        <h5>کاور : </h5>
                    </div>
                    <div class="col-12 mb-5">
                        <div class="card" style="overflow: hidden !important;">
                            <img class="card-img-top" style="width: 100% ;   max-height: 50vh;"
                                src="{{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . $user->vendor->cover) }}"
                                alt="{{ $user->vendor->name }}">
                            <label data-toggle="modal" data-target="#exampleModal" class="editPhotoBtn"
                                style="position: absolute; padding-top: 10px; background-color: rgba(32, 32, 32, 0.308);  cursor:pointer; font-size:50px;">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    style=" paddin-left:20px;  color:white; justify-content: center; align-items:center; text-align: center;"
                                    width="100" height="100" fill="currentColor" class="bi bi-pen" viewBox="0 0 50 50">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg>

                            </label>

                        </div>
                    </div>

                </div>
            </div>

            <a class="btn btn-primary"
                href="{{ route('user.vendor.images.edit', ['vendor' => Auth::user()->vendor->name]) }}">تایید</a>
            <hr>
        </div>

    </div>
@endsection



<!-- Modal logo -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> تغییر کاور فروشگاه</h5>
        </div>
        <div class="modal-body">
            <div class="">
                <div class="col-md-4 text-center">
                    <div id="upload-demo-cover"></div>
                </div>

                <input type="file" id="cover">

            </div>
            <div class="modal-footer">

                <button class="btn btn-success btn-upload-image-cover" style="margin-top:2%"> تغییر کاور
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>

            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    var resize = $('#upload-demo-cover').croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: 600,
            height: 400,
            type: 'square' //square
        },
        boundary: {
            width: 600,
            height: 600
        }
    });


    $('#cover').on('change', function() {
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


    $('.btn-upload-image-cover').on('click', function(ev) {

        console.log('asdasd');

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


            var files = $('#cover')[0].files;
            var formData = new FormData();

            formData.append('cover', img);

            $.ajax({
                type: "POST",
                // dataType: "json",
                url: "{{ route('update-cover') }}",
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
