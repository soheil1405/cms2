<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <style>
        body {
            font-family: 'vazir';
            direction: rtl;
        }
    </style>





    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />




    <div class="col-4 m-auto p-4" id="partToprint" dir="rtl">

        <div style="margin: 100px auto; border:1px solid black; padding:20px; align-content: center;">
            <div class= "  m-auto justify-content-center col-6">

                
                    <img style="margin:10px auto; width:80px;" src="{{ url('main/logo2.png') }}">
                    {{ env('APP_NAME') }}
     
                </div>


            <hr>






            شناسه پرداخت : {{ $typeId }}

            <hr>
            توضیحات : {{ $description }}

            <hr>
            قیمت نهایی : {{ $totalAmount }}

            ریال
            <br>


            <hr>



            @if ($idpayResult)
                <div class="p-3">

                    <span style="float:right;">تاریخ</span>



                    <span
                        style="float:left;">{{ \Morilog\Jalali\Jalalian::forge(Carbon\Carbon::createFromTimestamp($idpayResult['date'])->toDateTimeString()) }}</span>
                </div>


                <hr>


                <div class="p-3">


                    <span style="float:right">شماره کارت</span>


                    <span style="float:left">{{ $idpayResult['payment']['card_no'] }}</span>

                </div>
                <hr>
            @endif




        </div>


    </div>
    
    
    
    
    <h6 class="btn btn-success" onclick="window.print();"> چاپ رسید </h4>
        <a href="{{ route('user.orders.show', ['id' => $id]) }}" class="btn btn-success">بازگشت</a>


</body>

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

</html>
