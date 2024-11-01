<?php


function myActiveSliders($vid){
        

    $now = Carbon::now();

    
    return Sliders::where('vendor_id', $vid)->latest()->whereNotNull('acceptedbyAdmin')-> where('from' , "<" , $now)->where('to' , '>=' , $now)->where('paymentStatus' , '!=' ,'inPaymentQueue' );
}


