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
        <div class="alert alert-danger" id="dangerSlider" style="display: none;">
            sdasdas
        </div>


        <div class="alert alert-success" id="SuccessSlider" style="display: none;">


            تبریک جایگاه مورد نظر در دسترس می باشد


        </div> --}}


        @if ($errors)
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

















        <form action="{{ route('user.sendVendorSlider') }}" method="post" enctype="multipart/form-data">

            @csrf


            <input type="hidden" name="vendorName" id="p_id" value="{{ Auth::user()->vendor->name }}">


            <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
            {{-- <div class="">
                جایگاه اسلایدر :
                <select name="position" id="position_number" onchange="Ajaxcheck()">


                    @for ($i = 1; $i < 13; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor

                </select>
            </div> --}}

            تاریخ شروع اسلایدر

            <input type="date" name="timeFrom" id="">


<hr>
            <div class="">

                مدت زمان ارسال اسلایدر :

                <div class="">

                    <label for="time1">1 ماه</label>
                    <input type="radio" name="time" id="time1" value="1" checked>

                </div>

                <div class="">

                    <label for="time2">3 ماه</label>
                    <input type="radio" name="time" id="time2"value="3">

                </div>
                <div class="">

                    <label for="time3">6 ماه</label>
                    <input type="radio" name="time" id="time3" value="6">

                </div>
                <div class="">

                    <label for="time4">1 سال</label>
                    <input type="radio" name="time" id="time4" value="12">

                </div>


            </div>



            تصویر اسلایدر:
            <input type="file" name="image">


            <input type="submit" value="ثبت اسلایدر" class="btn btn-primary">
        </form>

    </div>

    <form action="{{ route('user.ladderVendor') }}" method="post">


        @csrf
        <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">





        <button name="ladder" class="btn btn-sm btn-danger m-5" value="">

            نردبان فروشگاه

        </button>



        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">بازگشت</a>


    </form>

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
</script>
