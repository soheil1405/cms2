@extends('user.layouts.user')

@section('title')
    index products
@endsection

<style>
    .blur {
        background-color: rgba(0, 0, 0, 0.9);
        border-radius: 5px;
        font-family: sans-serif;
        text-align: center;
        -webkit-backdrop-filter: blur(25px);
        backdrop-filter: blur(25px);
        width: 80%;
        height: 80%;
        right: 13%;
        position: fixed;

        justify-content: center;
        color: #ffff;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        top: 10%;

    }


    .blur ul li span {
        color: red;
    }

    li {
        list-style-type: none;
    }

    .desc {
        padding: 30px;
        list-style-type: none;
    }

    .twice_ul {
        padding: 30px;
    }

    .desc {
        width: 100%;
        text-align: right;
    }

    .blur btn {
        width: 50px;
    }


    .Slider {}
</style>


@section('content')

    <div class="col-12 " style="display: flex ; flex-direction: column;">


        <div class="" style="height:10%;">
            <div class="alert alert-danger" id="dangerSlider" style="display: none;">
                sdasdas
            </div>


            <div class="alert alert-success" id="SuccessSlider" style="display: none;">


                تبریک جایگاه مورد نظر در دسترس می باشد


            </div>


            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
        </div>
        @endif


        @if (Session::has('fileSizeError'))
            <div class="alert alert-success">
                {{ Session::get('fileSizeError') }}
            </div>
        @endif











        <div class="col-12" style="height:10%; ">
            <form action="{{ route('user.products.ladder') }}" method="post">


                @csrf
                <input type="hidden" name="product" value="{{ $product->id }}">





                <button name="ladder" class="btn btn-sm btn-danger m-5" value="">

                    نردبان محصول

                </button>



                <a href="{{ route('user.upgrade') }}" class="btn btn-secondary">بازگشت</a>


            </form>

        </div>

        <form class="container shadow-lg rounded p-4 text-center" style="" action="{{ route('user.story.store') }}"
            method="post" enctype="multipart/form-data">

            @csrf




            <div class="row" id="storyPage" style="margin:0 auto;">
                <div class="col-md-6 mx-auto" style=" justify-content: center; align-items: center;">


                    <div class="form-group">
                        <small>متن بالای استوری</small>

                        <input type="text" name="text1" class="form-controller" id="">
                    </div>

                    <div class="form-group d-flex" style="flex-direction:column;">

                        <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                            class="img-fluid mx-auto" style="max-height: 300px;" alt="" id="blah">
                        {{-- 
                        <input type="file" id="storyMedia" name="storyMedia" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                            id="" value="" > --}}

                    </div>

                    <div class="form-group">

                        <small>متن پایین استوری</small>
                        <input type="text" name="text2" class="form-controller" id="">
                    </div>


                    <div class="form-group">
                        {{-- <input type="color" id="bgcolor" name="bgcolor" onchange="changColor()" value="#e66465"> --}}
                    </div>

                </div>
            </div>

            <div class="row">

                <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="col-md-6 mx-auto ">

                    <div class="form-group mt-4 mb-4  col-12">
                        <div class="captcha">
                            <span>{!! Captcha::img('flat') !!}</span>
                            <button type="button" class="btn btn-danger" class="reload" onclick="reloadCaptcha()">
                                &#x21bb;
                            </button>
                        </div>
                    </div>


                    <div class=" ">
                        <div class="form-group">

                            <input type="text" name="captcha" placeholder="مقدار بالا را اینجا وارد کنید"
                                class="form-control required">
                            @error('captcha')
                                <p class="text-danger"> فیلد فرم اعتبار سنجی به درستی وارد نشده است
                                </p>
                            @enderror
                        </div>
                    </div>


                    <button type="submit" id="sendddd"  class="btn btn-primary btn-block">ارسال استوری </button>

                </div>

                {{-- <p id="fileSizeError"class="text-danger" style="display: none;">فایل انتخابی نباید بیشتر از 10 مگابایت باشد</p> --}}

            </div>









        </form>













    </div>




@endsection



<script>
    function Ajaxcheck() {



        var selelced = $('#position_number').val();


        formData = {

            position_number: selelced

        };


        $.ajax({

            type: "POST",
            url: "/AjaxcheckSlider",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                $('#SuccessSlider').css('display', 'block');

                $('#dangerSlider').css('display', 'none');
            },
            error: function(data) {


                $('#dangerSlider').css('display', 'block');





                $('#SuccessSlider').css('display', 'none');
            }

        });



    }




    function validatebeforeUpload() {

        // (Can't use `typeof FileReader === "function"` because apparently it
        // comes back as "object" on some browsers. So just see if it's there
        // at all.)
        if (!window.FileReader) { // This is VERY unlikely, browser support is near-universal
            console.log("The file API isn't supported on this browser yet.");
            return;
        }

        var input = document.getElementById('storyMedia');

        console.log(input);

        if (!input.files) { // This is VERY unlikely, browser support is near-universal
            console.error("This browser doesn't seem to support the `files` property of file inputs.");
        } else if (!input.files[0]) {
            addPara("Please select a file before clicking 'Load'");
        } else {

            var file = input.files[0];
            var from = $('#sendddd');


            if (file.size > 10000000) {


                // //add disabled
                // from.attr('disabled', 'disabled');


                $('#fileSizeError').css('display', 'block');

                from.css('display', 'none');


            } else {



                from.removeAttr("disabled");

                from.css('display', 'block');


                $('#fileSizeError').css('display', 'none');
            }

        }


    }




    function changColor() {
        var color = $('#bgcolor').val();


        console.log(color);



        $('#storyPage').css('background-color', color);

    }
</script>
