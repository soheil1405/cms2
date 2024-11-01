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



        <form class="row" style="height: 50%;" action="{{ route('admin.stories.update') }}" method="post"
            enctype="multipart/form-data">

            @csrf
            <div class="col-2">

                <input type="hidden" name="id" value="{{$story->id}}">
                <input type="submit" id="sendddd" value="ویرایش استوری " class="btn btn-primary">

                <a href="{{route('admin.stories.index')}}" class="btn btn-secondary">بازگشت</a>
                <p id="fileSizeError"class="text-danger" style="display: none;">فایل انتخابی نباید بیشتر از 10 مگابایت باشد</p>

            </div>



            <div class="col-10" id="storyPage"  style="margin:0 auto; background-color: {{$story->bgcolor}};">
                <div class=""
                    style="height:80vh; width:450px; margin:0 auto; justify-content: center; align-items: center;">


                    <div class="form-group">
                        <input type="text" name="text1" value="{{$story->text1}}" class="form-controller" id="">
                    </div>

                    <div class="form-group d-flex" style="flex-direction:column;">

                        <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $story->product->primary_image) }}"
                            style="width:300px; height:250px;" alt="" id="blah">

                        <input type="file" id="storyMedia" name="storyMedia" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                            id="" value="" >

                    </div>

                    <div class="form-group">
                        <input type="text" name="text2" class="form-controller" value="{{$story->text2}}" id="">
                    </div>


                    <div class="form-group">
                        <input type="color" id="bgcolor" name="bgcolor" onchange="changColor()" value="{{$story->bgcolor}}">
                    </div>

                </div>
            </div>











        </form>













    </div>




@endsection




<script>




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


                $('#fileSizeError').css('display' , 'block');

                from.css('display' , 'none');


            } else {



                from.removeAttr("disabled");
                
                from.css('display' , 'block');


                $('#fileSizeError').css('display' , 'none');
            }

        }


    }




    function changColor(){
        var color = $('#bgcolor').val();


        console.log(color);



        $('#storyPage').css('background-color' , color);

    }



</script>
