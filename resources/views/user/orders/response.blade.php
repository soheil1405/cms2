@extends('user.layouts.user')

@section('title')
    index products
@endsection





@section('content')
    <!-- Content Row -->
    <div class="row">









        @if ($order->idpayStatus == '10')
            <div class="alert alert-success">

                پرداخت با موفقیت انجام شد

                {{ $do }}

                شماره پیگیری : {{ $order->id }}
            </div>
        @else
            <div class="alert alert-danger">


                {{ $order->persianStatus }}
               شماره پیگیری : {{ $order->id }}
        
            </div>
        @endif










    </div>
@endsection
