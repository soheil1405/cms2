@push('header_styles')
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
            margin: 10px;
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
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewIcons = document.querySelectorAll('.preview-icon');
        const previewImage = document.getElementById('preview-image');

        const hidePreviewButton = document.getElementById('hide-preview-button');

        previewIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                previewImage.src = src;
                previewImage.style.display = 'block';
                hidePreviewButton.style.display = "block";
            });
        });

        hidePreviewButton.addEventListener('click', function() {
            previewImage.style.display = 'none';
            hidePreviewButton.style.display = "none";

        });
    });
</script>
<div id="open-modal" class="modal-window p-3 shadow border">
    <div class="text-right"><a href="#" title="Close" class="btn btn-danger ">بستن</a></div>
    <h2 class="text-center text-black fw-bold">انتخاب تصاویر</h2>

    <hr>
    <div class="container">
        <div class="upload__box row scroll-bar border  p-1">

            <div class=" position-relative col-md-3 order-md-2 col-12">
                <img id="preview-image" class="preview-image " alt="Preview">
                <span id="hide-preview-button" class="btn btn-danger position-absolute"
                    style="top: 2px;right:13px;display:none;">✖</span>
            </div>

            <div class="col-md-9 order-md-1 col-12 upload__btn-box  mx-auto text-center mt-4"
                style="overflow-y: scroll;max-height:550px;direction:ltr;">
                <div class="row">

                    @foreach (Auth::user()->vendor->images as $image)
                        <div class="col-md-2 col-6 p-2">
                            <div class="image-container bg-white  rounded p-0">
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
                                    class="image-checkbox position-absolute" style="top:2px; right:2px;" type="checkbox"
                                    name="lastImages[]" id="{{ $image->image }}">
                                <span class="preview-icon btn btn-info w-100" style="font-size: 12px;"
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
                                    class="image-checkbox position-absolute" style="top:2px; right:2px;" type="checkbox"
                                    name="lastImages[]" id="{{ Auth::user()->vendor->cover }}">
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
