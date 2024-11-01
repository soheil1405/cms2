@extends('user.layouts.user')

@section('title')
    create vendor
@endsection

@push('header_styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
@endpush

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد فروشگاه</h5>
            </div>
            <hr>

            @include('user.sections.errors')

            <form action="{{ route('user.vendor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <label for="title">
                            عنوان
                        </label>
                        <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}">
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <label for="phone">تلفن ثابت</label>
                        <input class="form-control" id="phone" name="phone" type="text" value="{{ old('phone') }}">
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <label for="cellphone">
                            شماره همراه
                        </label>
                        <input class="form-control" id="cellphone" name="cellphone" type="text" value="{{ old('cellphone') }}">
                    </div>

                    <label for="site_url">
                        آدرس وبسایت
                    </label>
                    <div class="input-group mb-3 flex-row-reverse">
                        <div class="input-group-prepend">
                            <span class="input-group-text" dir="ltr" id="basic-addon3">https://www. </span>
                        </div>
                        <input type="text" dir="ltr" class="form-control" id="site_url" name="site_url" value="{{ old('site_url') }}" aria-describedby="basic-addon3"> 
                    </div>

                    <div class="form-group col-md-12">
                        <label for="address">آدرس</label>
                        <textarea class="form-control" id="address"
                            name="address">{{ old('address') }}</textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ old('description') }}</textarea>
                    </div>

                    {{-- cover Image Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>کاور : </p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="cover"> انتخاب تصویر اصلی </label>
                        <div class="custom-file">
                            <input type="file" name="cover" class="custom-file-input" id="cover">
                            <label class="custom-file-label" for="cover"> انتخاب فایل </label>
                        </div>
                    </div>

                    {{-- avatar Image Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>آواتار : </p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="avatar"> انتخاب تصویر آواتار </label>
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" id="avatar">
                            <label class="custom-file-label" for="avatar"> انتخاب فایل </label>
                        </div>
                    </div>

                    <input type="text" name="langitude" id="langitude" hidden>
                    <input type="text" name="langitude" id="longitude" hidden>
                    <input type="text" name="langitude" id="zoom" hidden>

                    <div class="col-12 p-3">
                        <div class="shadow d-flex h-100 round-25">
                            <div id="map" class="d-flex h-100 w-100" style="height: 45vw !important;"></div>
                        </div>
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('user.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection

@push('footer_scripts')
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
@endpush

@push('footer_scripts')
    <script>
        var map = L.map('map',{attributionControl: false}).setView([34.08861780023631, 49.69376838686618], 11);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© {{env("APP_NAME")}}',

        }).addTo(map);
        L.control.attribution({position: 'topright'}).addTo(map);

        var marker = L.marker([34.08861780023631, 49.69376838686618]).addTo(map);

        map.on("move", function(e){
            L.clearLayers();
            new L.Marker([map.getCenter().lat, map.getCenter().lng]).addTo(map);
        });
    </script>
@endpush