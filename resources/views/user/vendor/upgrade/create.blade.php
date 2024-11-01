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


        @if ($errors)
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

        @if (Session::has("spcisFullAdd"))
                <div class="alert alert-danger" >{{  Session::get("spcisFullAdd") }}</div>
        @endif


        <h2>
            ارسال فروشگاه به صفحه اول
        </h2>

        <form action="{{ route('user.ladderVendor') }}" method="post">


            @csrf
            <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">





            <button name="ladder" class="btn btn-sm btn-danger m-5" value="">

                نردبان فروشگاه

            </button>





        </form>

        <form action="{{ route('user.SpecialVendors.store') }}" method="post">

            @csrf





            <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">


            تاریخ شروع



            <input class="example1 w-100 p-1 form-control" />
            <input type="hidden" name="timeFrom" id="fromDate">


            <hr>
            <div class="">

                مدت زمان :

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
                </div>
            </div>


            <input type="submit" value="ارسال فروشگاه" class="btn btn-primary">
        </form>

    </div>

    <a href="{{ route('user.SpecialVendors.index') }}" class="btn btn-secondary">بازگشت</a>
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
