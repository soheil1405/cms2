@extends('user.layouts.user')

@section('title')
    index products
@endsection





@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <input type="text" class="form-control" id="codee" placeholder="کد تخفیف خود را وارد کنید">

                </div>

                <div class="errtxt text-danger">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                    <button type="button" onclick="submitOfferCode()" class="btn btn-primary">اعمال کد</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-5" style="margin: 100px auto; border:1px solid black; padding:20px; align-content: center;">

        @if (isset($order))
            نوع سفارش : {{ $order->orderType }}

            <hr>

            ایتم : {{ $order->typeId }}

            <hr>
            توضیحات : {{ $order->description }}

            <hr>

            <div class="row">
                <div class="">

                    قیمت نهایی : <label for="" id="totalAmountt">{{ $order->totalAmount }}</label>

                    ریال

                </div>
                <div @if ($order->amountAfterOffer)
                    
                    @else
                style="display: none;" @endif
                    id="shownewAmount" class="text-danger">
                    قیمت بعد از اعمال کد تخفیف

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>


                    <label for="" id="newAmount">

                        {{ $order->amountAfterOffer }}

                    </label>
                    ریال


                </div>


            </div>

            @if( $order->orderType != "increaseCredit")

            <!-- Button trigger modal -->
            <button  @if ($order->amountAfterOffer) @disabled(true) @endif type="button" style="float: left;" id="codeModal" class="btn btn-primary" data-toggle="modal"
                data-target="#exampleModal">
                کد تخفیف دارید ؟
            </button>

            @endif



            <hr>
        @endif



        <a class="btn btn-success" href="{{ $link }}">ورود به درگاه پرداخت</a>
        
        @if( $order->orderType != "increaseCredit")

        <form action="{{ route('user.payFromCredit') }}" method="post">
            @csrf


            <input type="hidden" id="id" name="orderId" value="{{ $order->id }}">

            <input type="hidden" name="type" id="orderType" value="{{ $order->orderType }}">

            <input type="hidden" name="typeId" value="{{ $order->typeId }}">

            <input type="hidden" name="linkBack" value="{{ $order->linkBack }}">

            <input type="hidden" name="payType" value="2">

            <input type="submit" value="پرداخت از طریق کیف پول" class="btn btn-warning">


        </form>

        @endif

    </div>



    @if ($order->linkBack)
        {{-- <a  class="btn btn-secondary" href="{{route($order->linkBack)}}">انصراف</a> --}}
    @else
        <a class="btn btn-secondary" href="{{ route('user.dashboard') }}">انصراف</a>
    @endif
@endsection
<script>
    function submitOfferCode() {



        var code = $('#codee').val();

        var orderId = $('#id').val();

        console.log(orderId);

        if (code == "") {

            $('.errtxt').text('مقدار کد تخفیف به درستی وارد نشده');

        } else {
            $('.errtxt').text('');

            formData = {
                code: code,
                orderId: orderId
            };



            $.ajax({
                type: 'POST',
                url: '/vendor-dashboard/OfferCodeValidate',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data) {

                    $('#newAmount').text(data.newPrice);


                    $('#exampleModal').modal('hide');
                    $('#shownewAmount').css('display', 'block');
                    $("#codeModal").prop("disabled", true);

                    location.reload();


                },
                error: function(data) {

                    $('.errtxt').text(data.responseJSON);

                    console.log(data);
                }
            });


        }



    }

</script>

<script>
    function reloadCaptcha() {
        console.log('asdasd');
        $.ajax({
            type: 'POST',
            url: '/reloadCaptch',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data) {
                $(".captcha span").html(data.captcha);
            },
            error: function(data) {
                console.log(dara);
            }
        });
    }
</script>