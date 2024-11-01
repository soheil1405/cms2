@extends('vendors.layouts.master')

@section('title', $vendor->title)


@push('header_styles')
    @include('layouts.home.header.styles')
    <style>
        #map1 {
            height: 400px;
            width: 500px;
        }
    </style>
@endpush


@push('header_scripts')
    @include('layouts.home.header.scripts')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
@endpush


@push('headers')
    @include('layouts.home.header.head')
@endpush




@push('contents')
    <div style="margin-top:20px !important;" class="container-fluid bg-white">
        <div class="row">
            <div class="col-12">
                <img src="{{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . $vendor->cover) }}"
                    style="border-radius: 25px 25px 0 0;max-height: 50vh" class="img-fluid w-100" alt="Responsive image">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-12 p-3">
                <div class="row">
                    <div class="col-12 shadow m-1 round-25">
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <figure class="figure">
                                    <img src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $vendor->avatar) }}"
                                        class="figure-img img-thumbnail rounded-circle" style="width: 100px;height: 100px;">
                                    <figcaption class="figure-caption text-center">
                                        {{ $vendor->title }}
                                    </figcaption>
                                </figure>

                            </div>

                            <div class="col-md-6">
                                <div class="p-3 mb-5 bg-white rounded text-center">
                                    <button type="button" class="btn btn-outline-primary">
                                        دنبال کردن
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="row row-cols-1 row-cols-md-2 pb-3">
                                    <div class="col-12">

                                        <div class="card round-25">
                                            <div class="card-body">
                                                <h5 class="card-title">آدرس :</h5>
                                                <p class="card-text">
                                                    {{ $vendor->address }}
                                                </p>
                                        </div>
                                    </div>
                                    <div class="card round-25">
                                        <div class="card-body">
                                            <h5 class="card-title">توضیحات :</h5>
                                            <p class="card-text">
                                                {{ $vendor->description }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card round-25">
                                        <div class="card-body">
                                            <h5 class="card-title">آدرس وبسایت :</h5>
                                            <div class="text-start">
                                                <a href="https://www.{{ $vendor->site_url }}" role="button" target="_blank"
                                                    class="card-link btn btn-outline-primary">
                                                    {{ $vendor->site_url }}
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card round-25">
                                        <div class="card-body">
                                            <h5 class="card-title">شماره تلفن :</h5>
                                            <p class="card-text text-start">
                                                {{ $vendor->phone_number }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card round-25">
                                        <div class="card-body ">
                                            <h5 class="card-title">محصولات این فروشگاه :</h5>
                                            <div class="text-start">
                                                <a href="{{ route('vendor.products.list', ['vendor' => $vendor->name]) }}"
                                                    role="button" class="card-link btn btn-outline-primary">
                                                    نمایش محصولات فروشگاه
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    @if ($vendor->socialMedias)
                                        <div class="card round-25">
                                            <div class="card-body">
                                                <h5 class="card-title"> شبکه های اجتماعی : </h5>
                                                <div class="text-start">

                                                    @if ($vendor->socialMedias->email != null)
                                                        <span>




                                                            {{ $vendor->socialMedias->email }}


                                                            <small><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-envelope-open-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8.941.435a2 2 0 0 0-1.882 0l-6 3.2A2 2 0 0 0 0 5.4v.314l6.709 3.932L8 8.928l1.291.718L16 5.714V5.4a2 2 0 0 0-1.059-1.765l-6-3.2ZM16 6.873l-5.693 3.337L16 13.372v-6.5Zm-.059 7.611L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516ZM0 13.373l5.693-3.163L0 6.873v6.5Z" />
                                                                </svg></small>

                                                        </span>
                                                    @endif
                                                    @if ($vendor->socialMedias->aparat != null)
                                                        <a target="_blank" href="{{ $vendor->socialMedias->aparat }}"
                                                            role="button" class="card-link btn btn-outline-primary">
                                                            aparat
                                                        </a>
                                                    @endif
                                                    @if ($vendor->socialMedias->webdite != null)
                                                        <span>




                                                            website :
                                                            {{ $vendor->socialMedias->website }}



                                                        </span>
                                                    @endif


                                                    @if ($vendor->socialMedias->whatsapp != null)
                                                        <a target="_blank" href="{{ $vendor->socialMedias->whatsapp }}"
                                                            role="button" class="card-link btn btn-outline-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-whatsapp"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                                            </svg> </a>
                                                    @endif


                                                    @if ($vendor->socialMedias->telegram != null)
                                                        <a target="_blank" href="{{ $vendor->socialMedias->telegram }}"
                                                            role="button" class="card-link btn btn-outline-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-telegram"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                                                            </svg> </a>
                                                    @endif

                                                    @if ($vendor->socialMedias->instagram != null)
                                                        <a target="_blank" href="{{ $vendor->socialMedias->instagram }}"
                                                            role="button" class="card-link btn btn-outline-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-instagram" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                            </svg> </a>
                                                    @endif


                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="map1"></div>

        <a href="https://maps.google.com/?q= <?php echo $vendor->lat . ',' .  $vendor->lng ?>" role="button"
            class="card-link btn btn-outline-primary">
            مسیریابی
        </a>


    </div>

    <div class="row">
        <div class="col-12">
            <div class="shadow p-3 rounded-pill">
                <h2 class="text-center">
                    محصولات
                </h2>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="products owl-carousel w-100">

                @foreach ($vendor->products as $product)
                    <div class="card w-100 m-auto h-100" style="">
                        <img src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text p-2">
                                {{ $product->description }}
                            </p>
                            <a style="font-size:22px"
                                href="{{ route('products.show', ['product' => $product->slug, 'vendor' => $vendor->name]) }}"
                                class="btn btn-primary w-100">
                                مشاهده
                            </a>
                        </div>
                        <div class="card-footer text-start">
                            <h3 class="text-muted">

                                <?php if($product->price) { ?>
                                <p style="width: 100%; text-align:start !important;">
                                    قیمت
                                    <small style="width: 100%; text-align:start !important;"
                                        class="text-center texr-danger">


                                        {{ $product->price->price }}


                                    </small>
                                    تومان
                                </p>
                                <?php }else{ ?>
                                <p style="width: 100%; text-align:start !important;">
                                    قیمت : -
                                </p>
                                <?php } ?>

                            </h3>
                        </div>
                    </div>
                @endforeach

            </div>

            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
    </div>
@endpush


@push('footer_scripts')
    @include('layouts.home.footer.script')

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
@endpush

@push('footer_scripts')
    <script>
        var map = L.map('map', {
            attributionControl: false
        }).setView([34.08, 49.69], 11);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© {{ env('APP_NAME') }}',


        }).addTo(map);
        var marker = L.marker([34.08, 49.69]).addTo(map);
        L.control.attribution({
            position: 'topright'
        }).addTo(map);

        /* map.on('move',function(e){
            marker.setLatLng(L.latLng(map.getCenter()));
        }); */
    </script>
@endpush


@push('footer_scripts')
    <script>
        $(document).ready(function() {
            $('.products').owlCarousel({

                items: 4,
                loop: false,
                margin: 10,
                rewind: true,
                rtl: true,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplayHoverPause: true,
                dots: false,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: 1,
                        margin: 40,
                    },
                    440: {
                        items: 2,
                        margin: 5,
                    },
                    // breakpoint from 480 up
                    768: {
                        items: 2,
                    },
                    // breakpoint from 768 up
                    900: {
                        items: 4,
                    }
                }

            });

        });










        var map = L.map('map1').setView([{{ $vendor->lat }}, {{ $vendor->lng }}], 13);


        var marker = L.marker([{{ $vendor->lat }}, {{ $vendor->lng }}]).addTo(map);


        marker.addTo(map);


        L.marker([{{ $vendor->lat }}, {{ $vendor->lng }}]).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);



        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        var popup = L.popup()
            .setLatLng([{{ $vendor->lat }}, {{ $vendor->lng }}])
            .setContent("I am a standalone popup.")
            .openOn(map);
    </script>
@endpush
