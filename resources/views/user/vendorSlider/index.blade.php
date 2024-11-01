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





        @if (Session::has('isFull'))
            <div class="alert alert-danger">
                {{ Session::get('isFull') }}

            </div>
        @endif



        <form action="{{ route('user.sendVendorSlider') }}" method="post" enctype="multipart/form-data">

            @csrf


            <input type="hidden" name="vendorName" id="p_id" value="{{ Auth::user()->vendor->name }}">


            <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">



            تاریخ شروع اسلایدر

            <input class="example1 " />
            <input type="hidden" name="timeFrom" id="fromDate">
            {{-- <input type="date" name="timeFrom" id=""> --}}


            <hr>
            {{-- <div class="">
                جایگاه اسلایدر :
                <select name="position" id="position_number" onchange="Ajaxcheck()">


                    @for ($i = 1; $i < 13; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor

                </select>
            </div> --}}


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

            ابعاد اسلایدر باید 1300 * 350 باشد



            <div class="form-group mt-4 mb-4">
                <div class="captcha">
                    <span>{!! Captcha::img('flat') !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" onclick="reloadCaptcha()">
                        &#x21bb;
                    </button>
                </div>
            </div>


            <div class="col-12">
                <div class="form-group">

                    <input type="text" name="captcha" placeholder="مقدار بالا را اینجا وارد کنید"
                        class="form-control required">
                    @error('captcha')
                        <p class="text-danger"> فیلد فرم اعتبار سنجی به درستی وارد نشده است
                        </p>
                    @enderror


                    @if ($errors)
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <input type="submit" value="ثبت اسلایدر" class="btn btn-primary">
            <a href="{{ route('user.mysliders') }}" class="btn btn-secondary">بازگشت</a>

        </form>

    </div>
    <a class="btn btn-danger" href="#"> درخواست اسلایدر</a>


@endsection




@section('script')
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('main/datepicker/persiandate.js') }}"></script>
    <script src="{{ asset('main/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".example1").pDatepicker({
                autoClose: true,
                onSelect: function(unix) {
                    // console.log('datepicker select : ' + unix);
                    var day = new persianDate(unix).toDate();
                    // console.log('day :' + day);



                    var standard = new Date(day).toISOString();


                    $('#fromDate').val(standard);


                }
            });

            //     $(".example2").pDatepicker({
            //         autoClose: true,
            //         onSelect: function(unix) {
            //             // console.log('datepicker select : ' + unix);
            //             var day = new persianDate(unix).toDate();
            //             // console.log('day :' + day);
            //             var standard =  new Date(day).toISOString();


            //    $('#fromDate').val(standard);
            //         }
            //     });









        });
    </script>
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
