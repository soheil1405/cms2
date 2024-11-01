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

<div class="col-12">

{{-- 
    <div class="alert alert-success" id="SuccessSlider" style="display: none;">


        تبریک جایگاه مورد نظر در دسترس می باشد


    </div>

    <div class="alert alert-danger" id="ErrorSlider" style="display: none;">



        جایگاه مورد توسط فروشگاه دیگری خریداری شده است

    </div> --}}

<a href="{{route('user.upgrade')}}" class="btn btn-secondary">بازگشت</a>

    <form action="{{route('user.editVendorSlider')}}" method="post" enctype="multipart/form-data">

        @csrf



        <input type="hidden" name="slider_id" value="{{$vendorSlider->id}}">


        <input type="hidden" name="vendorName" id="p_id" value="{{Auth::user()->vendor->name}}">
        
        <input type="hidden" name="vendor_id" value="{{Auth::user()->vendor->id}}">

        {{-- <div class="">
            جایگاه اسلایدر :
            <select name="position" id="position_number" onchange="Ajaxcheck()">


                @for ($i = 1; $i < 13; $i++)
                    <option value="{{ $i }}"  
                    
                    @if($vendorSlider->position == $i)


                    checked
                    
                    @endif
                    
                    
                    >{{ $i }}</option>
                @endfor

            </select>
        </div> --}}





        
        <img
        src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $vendorSlider->image) }}" 
        style="width:300px; height:210px;" id="blah"
        alt="">

        تصویر اسلایدر:
        <input type="file" name="image"  
        
        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
        
        >


              <div class="form-group mt-4 mb-4">
                <div class="captcha">
                    <span>{!! Captcha::img('flat') !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" onclick="reloadCaptcha()">
                        &#x21bb;
                    </button>
                </div>
            </div>
  
  
    <div class="form-group mb-4">

        <input type="text" name="captcha" id="">

    </div>



    @if(Session::has('capchaError'))

    {{ Session::get('capchaError') }}

    @endif



    <input type="submit" value="ویرایش اسلایدر" class="btn btn-primary"> 
</form>






    @if($errors)
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif





    <a href="{{route('user.upgrade')}}" class="btn btn-secondary">بازگشت</a>

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
               
                $('#SuccessSlider').css('display' , 'block');

                $('#ErrorSlider').css('display' , 'none');
            },
            error: function(data) {

                
                $('#ErrorSlider').css('display' , 'block');





                $('#SuccessSlider').css('display' , 'none');
            }

        });



    }
    
    function reloadCaptcha(){
        console.log('asdasd');
        $.ajax({
            type: 'POST',
            url: '/reloadCaptch',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (data) {
                $(".captcha span").html(data.captcha);
            }, error: function(data){
                console.log(data.responseJSON.message);
            }
        });
    }
</script>