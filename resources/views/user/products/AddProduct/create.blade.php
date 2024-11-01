@extends('user.layouts.user')

@section('title')
    index products
@endsection

@section('content')


    @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif



    <a href="{{ route('user.upgrade') }}" class="btn btn-secondary">بازگشت</a>






    <form action="{{route('user.upgradeproduct.store')}}" method="post">

        @csrf


        <h3>
            ارسال محصول {{ $product->name }}به صفحه اول
        </h3>

        <input type="hidden" value="{{ $product->id }}" name="product_id">


        <div class="form-group">

            تاریخ شروع


            
        
            <input class="example1 " />
            <input type="hidden" name="from" id="fromDate">
    
            {{-- <input type="date" name="" id=""> --}}

        </div>
        <div class="form-group">

            <label for="1">یک ماهه</label>
            <input type="radio" name="time" id="1" value="1" checked>
        </div>
        <div class="form-group">

            <label for="3">سه ماهه</label>
            <input type="radio" name="time" id="1" value="3">
        </div>
        <div class="form-group">

            <label for="6">شش ماهه</label>
            <input type="radio" name="time" id="1" value="6">
        </div>
        <div class="form-group">

            <label for="12">یک ساله</label>
            <input type="radio" name="time" id="1" value="12">
        </div>
        <div class="form-group">

            <input type="submit" value="ارسال">
        </div>



    </form>
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
                    
                    
                    
                  var standard =  new Date(day).toISOString();
           
           

                  console.log(standard);

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