@extends('admin.layouts.admin')
<link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet" />


<script>
    $('.brandSelect').selectpicker({
        'title': 'انتخاب برند'
    });
</script>

@section('title')
    ایجاد اسلایدر
@endsection



@section('content')
    <h1>
        ایحاد اسلایدر جدید
    </h1>




    <span>

        <span class="text-danger">*</span>
        لطفا یکی از مورد زیر را انتخاب کنید
    </span>

    <form action="{{ route('admin.sliderss.store') }}" method="post" enctype="multipart/form-data">

        @csrf


        <div class="">

            <input type="radio" onchange="Showtype(1)" name="SliderType" value="a" id="a">
            <label for="a">مقاله</label>

        </div>

        <div class="">

            <input type="radio" name="SliderType"onchange="Showtype(2)" value="p" id="p">
            <label for="p">محصول</label>


        </div>

        <div class="">
            <input type="radio" name="SliderType" onchange="Showtype(3)" value="v" id="v">
            <label for="v">فروشگاه</label>

        </div>



        <div class="">
            <input type="radio" name="SliderType" value="O" id="o" onchange="Showtype(4)">
            <label for="o">لینک</label>
        </div>






        <div class=" ">


            <div class="" style="display: none;" id="articleBox">
                نام مقاله
                <select name="article_id" class="brandSelect  form-control " data-live-search="true" id="brandSelect">
                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}" class="form-control">{{ $article->title }}
                        </option>
                    @endforeach
                </select>


            </div>

            <div class="" style="display: none;" id="productBox">

                نام محصول

                <select name="product_id" class="brandSelect  form-control " data-live-search="true" id="brandSelect">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" class="form-control">{{ $product->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class=""style="display: none;" id="vendorBox">

                نام فروشگاه
                <select name="vendor_id" class="brandSelect  form-control " data-live-search="true" id="brandSelect">
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}" class="form-control">{{ $vendor->name }}
                        </option>
                    @endforeach
                </select>


            </div>

            <div class="" style="display: none;" id="otheLikBox">

                لینک مقصد

                <input type="text" name="link" class="form-control" id="">
            </div>


        </div>



        {{-- <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}"> --}}


        تاریخ شروع

        
        <input class="example1 " />
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


        <div class="">
            <label for="">انتخاب عکس</label>
            <input type="file" name="image" id="">
        </div>


        <input type="submit" value="ارسال فروشگاه" class="btn btn-primary">



        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>



    @endforeach
        @endif

        @if (Session::has('incorrect'))
                    <div class="alert alert-danger">
                        {{ Session::get('incorrect') }}
                    </div>
                @endif
        




    </form>


    <a class="btn btn-secondary" href="{{ route('admin.sliderss.index') }}">بازگشت</a>

@endsection



<script>
    function Showtype(type) {


        var a = $('#articleBox');

        var p = $('#productBox');

        var v = $('#vendorBox');

        var o = $('#otheLikBox');



        switch (type) {
            case 1:
                a.css('display', 'block');

                p.css('display', 'none');
                v.css('display', 'none');
                o.css('display', 'none');
                break;
            case 2:
                p.css('display', 'block');

                a.css('display', 'none');
                v.css('display', 'none');
                o.css('display', 'none');
                break;
            case 3:
                v.css('display', 'block');

                a.css('display', 'none');
                p.css('display', 'none');
                o.css('display', 'none');

                break;
            case 4:
                o.css('display', 'block');

                a.css('display', 'none');
                v.css('display', 'none');
                p.css('display', 'none');

                break;

            default:
                a.css('display', 'none');

                a.css('display', 'none');
                v.css('display', 'none');
                p.css('display', 'none');



                break;
        }



    }
</script>


@section('script2')
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
                    
                    
                    
                  var standard =  new Date(day).toISOString();
           
           
                    $('#fromDate').val(standard);
           
           
                }
            });

            $(".example2").pDatepicker({
                autoClose: true,
                onSelect: function(unix) {
                    // console.log('datepicker select : ' + unix);
                    var day = new persianDate(unix).toDate();
                    // console.log('day :' + day);
                    var standard =  new Date(day).toISOString();
           
           
           $('#fromDate').val(standard);
                }
            });









        });
    </script>
@endsection
