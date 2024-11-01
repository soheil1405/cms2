@extends('admin.layouts.admin')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

@section('title')
    edit categories
@endsection

@section('script')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script>
    var map = L.map('map').setView([{{ $setting_detail->latitude }}, {{ $setting_detail->longitude }}], 15 );


    var marker = L.marker([{{ $setting_detail->latitude }}, {{ $setting_detail->longitude }}]).addTo(map);


    marker.addTo(map);


    L.marker([{{ $setting_detail->latitude }}, {{ $setting_detail->longitude }}]).addTo(map)
        .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        .openPopup();


    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);



    marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
    var popup = L.popup()
        .setLatLng([{{ $setting_detail->latitude }}, {{ $setting_detail->longitude }}])
        .setContent("I am a standalone popup.")
        .openOn(map);





        $('#longitude').val( {{  $setting_detail->longitude }} );
        $('#latitude').val({{$setting_detail->latitude  }});

    var lat = map.on('click', function(e) {


        
        
        L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)


        $('#longitude').val(e.latlng.lng);
        $('#latitude').val(e.latlng.lat);


        //  return e.latlng.toString();

    });
    </script>
@endsection

<style>
    #map {
        height: 400px;
        width: 500px;
    }
</style>

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش راه های ارتباطی و شبکه‌های اجتماعی : </h5>
            </div>
            <hr>

            @include('admin.sections.errors')



            <form class="col-12" style="display: flex; flex-direction: columnl;" method="POST"
                action="{{ route('admin.settindDetail.ways.update') }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row col-3">


                    <div class="col-12">
                        <label for="">واتساپ</label>
                        <input type="number" name="whatsapp" required value="{{ $setting_detail->whatsapp}}" class="form-control" id="">
                    </div>


                    <div class="col-12">
                        <label for="">ایمیل</label>
                        <input type="email" name="email" required class="form-control" id="" value="{{ $setting_detail->email}}">
                    </div>


                    <div class="col-12">
                        <label for="">تلگرام</label>
                        <input type="text" name="telegram"  required class="form-control" value="{{ $setting_detail->telegram}}" id="">
                    </div>

                    <div class="col-12">
                        <label for="">اینستاگرام</label>
                        <input type="text" name="instagram" required class="form-control" id="" value="{{ $setting_detail->instagram}}">
                    </div>



                    <div class="col-12">
                        <label for="">آپارات</label>
                        <input type="text" name="aparat" required class="form-control" id="" value="{{ $setting_detail->aparat}}"> 
                    </div>

                    <div class="col-12">
                        <label for="">روبیکا</label>
                        <input type="text" name="rubika" required class="form-control" id="" value="{{ $setting_detail->rubika}}">
                    </div>






                    <div class="col-12">
                        <label for="">فیسبوک</label>
                        <input type="text" name="facebook" class="form-control" id="" required value="{{ $setting_detail->facebook}}">
                    </div>

                </div>
                <div class="form-row col-3">

                    <div class="col-12">
                        <label for="">تلغن 1</label>
                        <input type="number" name="telephone" class="form-control" id=""required value="{{ $setting_detail->telephone   }}">
                    </div>

                    <div class="col-12">
                        <label for="">تلغن 2</label>
                        <input type="number" name="telephone2" class="form-control" id="" required value="{{ $setting_detail->telephone2}}" >
                    </div>

                    <div class="col-12">
                        <label for="">فکس</label>
                        <input type="number" name="fax" class="form-control" id="" required value="{{ $setting_detail->fax}}">
                    </div>
                    <div class="col-12 ">
                        <label for="">آدرس</label>
                        <textarea name="address" id="content" class="form-control" required rows="6"
                            style="max-height: 150px;min-height: 150px; max-width: ;300px;"> {!! $setting_detail->address !!} </textarea>
                    </div>




                </div>
                <div class="form-row col-3">
                    <div id="map"></div>

                    <input type="hidden" name="ways" value="yesss">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="latitude" id="latitude">

                    <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>


                </div>

            </form>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>




            <div class="form-group col-md-3">
                <div class="custom-file">
                    <form action="{{ route('admin.articleImages.store') }}" id="ArticleImagesForm" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input style="display: none;" onchange="submitArticleImagesForm()" type="file" name="images"
                            id="images">
                    </form>


                </div>
            </div>



        </div>

    </div>
@endsection

<script src={{ asset('ckeditor/ckeditor.js') }}></script>



<script type="text/javascript">
    function submitArticleImagesForm() {
        document.getElementById("ArticleImagesForm").submit();
    }


    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>




<script type="text/javascript">
    CKEDITOR.replace('content', {
        language: 'fa'
    });

    function copyUrl(id) {

        var cuurect_id = id;

        console.log(cuurect_id);
        document.getElementById(`id(${cuurect_id})`).style.display = "block";

        setTimeout(() => {
            document.getElementById(`id(${cuurect_id})`).style.display = "none";

        }, "10000")
    }
</script>
