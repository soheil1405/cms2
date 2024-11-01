@extends('admin.layouts.admin')
<link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet" />


<script>
    $('.brandSelect').selectpicker({
        'title': 'انتخاب برند'
    });

    


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

@section('title')
    ایجاد استوری
@endsection



@section('content')
    <h1>
        ایحاد استوری جدید
    </h1>

   
    
  
    
    
    
        
  <style>
.selectpicker option
{
        border: none;
        background-color: white;
        outline: none;
        -webkit-appearance: none;
        -moz-appearance : none;
        color: #14B1B2;
        font-weight: bold;
        font-size: 30px;
        margin: 0;
        padding-left: 0;
        margin-top: -20px;
        background: none;
    }
select.selectpicker
{
        border: none;
        background-color: white;
        outline: none;
        -webkit-appearance: none;
        -moz-appearance : none;
        color: #14B1B2;
        font-weight: bold;
        font-size: 30px;
        margin: 0;
        padding-left: 0;
        margin-top: -20px;
        background: none;
    }</style>





    <form action="{{ route('admin.stories.store') }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="col-12 m-3 p-3 d-flex">




            <input type="hidden" name="creator" value="admin">


            <div class="m-1">

                <input type="radio" name="storyType"onchange="Showtype(2)" value="p" id="p" checked>
                <label for="p">محصول</label>


            </div>

            <div class="m-1">
                <input type="radio" name="storyType" onchange="Showtype(3)" value="v" id="v">
                <label for="v">فروشگاه</label>

            </div>
            <div class="m-1">

                <input type="radio" onchange="Showtype(1)" name="storyType" value="a" id="a">
                <label for="a">مقاله</label>

            </div>
        </div>


        {{-- 
        <div class="">
            <input type="radio" name="SliderType" value="O" id="o" onchange="Showtype(4)">
            <label for="o">لینک</label>
        </div> --}}






        <div class=" ">


            <div class="" style="display: none;" id="articleBox">
                نام مقاله

                
                    <select class="selectpicker des col-12"  id="brandSelect"  name="article_id" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
    
                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}" class="form-control">{{ $article->title }}
                        </option>
                    @endforeach
                </select>


            </div>

            <div class="" id="productBox">

                نام محصول

                <select  class="selectpicker des col-12"  id="brandSelect"  name="product_id" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" class="form-control">{{ $product->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class=""style="display: none;" id="vendorBox">

                نام فروشگاه
                <select name="vendor_id"  class="selectpicker des col-12"  id="brandSelect"   data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}" class="form-control">{{ $vendor->title }}
                        </option>
                    @endforeach
                </select>


            </div>

            {{-- <div class="" style="display: none;" id="otheLikBox">


                لینک مقصد

                <input type="text" name="link" class="form-control" id="">
            </div> --}}


        </div>



        <div class="form-group">
            <label for="">متن 1</label>
            <input type="text" name="text1"  id="" class="form-control">

            <label for="">متن 2</label>
            <input type="text" name="text2"  id="" class="form-control">

        </div>



        <input type="color" name="bgcolor" id="">






        {{-- 
        <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">


        تاریخ شروع

        <input type="date" name="timeFrom" id="">


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
 --}}

        <input type="submit" value="ارسال استوری" class="btn btn-primary m-2">





    </form>


    <a class="btn btn-secondary m-2" href="{{ route('admin.stories.index') }}">بازگشت</a>
    @if ($errors)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if (Session::has('customError'))
        <div class="alert alert-danger">
            {{ Session::get('customError') }}
        </div>
    @endif


    @if (Session::has('incorrect'))
        <div class="alert alert-danger">
            {{ Session::get('incorrect') }}
        </div>
    @endif
@endsection
