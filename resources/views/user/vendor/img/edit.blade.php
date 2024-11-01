@extends('user.layouts.user')

@section('title')
    ویرایش تصاویر فروشگاه
@endsection

@section('script')
    <script>
        // Show File Name
        $('#avatar_img').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#cover_img').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

    </script>
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-5 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش تصاویر فروشگاه : {{ $vendor->name }}</h5>
            </div>
            <hr>

            @include('user.sections.errors')

            {{-- Show Primary Image --}}
            <div class="row">
                <div class="col-12 col-md-12 mb-5">
                    <h5>کاور : </h5>
                </div>
                <div class="col-12 col-md-3 mb-5">
                    <div class="card">
                        <img class="card-img-top"
                            src="{{ url(env('VENDOR_IMAGES_UPLOAD_PATH') . $vendor->cover) }}"
                            alt="{{ $vendor->name }}">
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-12 col-md-12 mb-5">
                    <h5>آواتار : </h5>
                </div>
                <div class="col-12 col-md-3 mb-5">
                    <div class="card">
                        <img class="card-img-top"
                            src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $vendor->avatar) }}"
                            alt="{{ $vendor->name }}">
                    </div>
                </div>
            </div>

            <hr>

            <form action="{{ route('user.vendor.images.set_avatar', ['vendor' => $vendor->name]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-4">
                        
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" id="avatar_img">
                            <label class="custom-file-label" for="primary_image"> انتخاب آواتار </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <button class="btn btn-outline-primary" type="submit">ویرایش آواتار</button>
                    </div>
                </div>

            </form>

            <form action="{{ route('user.vendor.images.set_cover', ['vendor' => $vendor->name]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="custom-file">
                            <input type="file" name="cover" class="custom-file-input" id="cover_img">
                            <label class="custom-file-label" for="primary_image"> انتخاب کاور </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <button class="btn btn-outline-primary" type="submit">ویرایش کاور</button>
                    </div>
                </div>

                
            </form>
        </div>

    </div>

@endsection
