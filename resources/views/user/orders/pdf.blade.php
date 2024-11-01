@extends('user.layouts.user')

@section('title')
    index products
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<meta charset="utf-8">
<style>




    body{
        direction: rtl !important;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
    }
</style>


@section('content')
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> --}}




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




            <a href="{{ route('user.orders.index', ['id' => $order->id]) }}" class="btn btn-success">بازگشت</a>

            {{-- <h6 class="btn btn-info" onclick="downloadPDF()" >دانلود رسید</h6> --}}


        </div>


    </div>
    <script>
        function downloadPDF() {
            window.jsPDF = window.jspdf.jsPDF;
            // 
            var doc = new jsPDF();
            doc.text(20, 20, 'رسید');
            doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');
            // Add new page
            doc.addPage();
            doc.text(20, 20, 'Visit CodexWorld.com');
            // Save the PDF
            doc.save('document.pdf');
        }
    </script>
@endsection
