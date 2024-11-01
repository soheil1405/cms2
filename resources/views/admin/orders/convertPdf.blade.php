
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />




<div class="row" dir="rtl">
    <div class="col-3" style="margin: 100px auto; border:1px solid black; padding:20px; align-content: center;">


        شناسه پرداخت : {{ $order->typeId }}

        <hr>
        توضیحات : {{ $order->description }}

        <hr>
        قیمت نهایی : {{ $order->totalAmount }}

        ریال
        <br>


        <hr>



        @if ($idpayResult)
            <div class="p-2">

                <span style="float:right;">تاریخ</span>



                <span
                    style="float:left;">{{ \Morilog\Jalali\Jalalian::forge(Carbon\Carbon::createFromTimestamp($idpayResult['date'])->toDateTimeString()) }}</span>
            </div>


            <hr>


            <div class="p-2">


                <span style="float:right">شماره کارت</span>


                <span style="float:left">{{ $idpayResult['payment']['card_no'] }}</span>

            </div>
            <hr>
        @endif
        <a href="{{ route('user.orders.pdf', ['id' => $order->id]) }}" class="btn btn-success">دانلود pdf</a>



    </div>


</div>