

@php
    
    $settings = App\Models\Admin\Setting::select('sitAllVisitCount', 'allproductsVisitCount', 'allVendorsVisitCount', 'allBrandsVisitCount')->first();
    
@endphp

<div class=" homecounter  brd25   justify-content-space-arround mt-5">
    <div class="text-center">
        <h2 class="" style="font-family:'dastnevis' !important;">
            اینستابرق
        </h2>
       
        <h2 class="animate__pulse animate__animated animate__infinite" style="font-family:'dastnevis' !important;">
            تنوع در خرید، تحول در فرو ش
        </h2>
    </div>
    <hr>
    <section class="d-flex " style="justify-content: space-around;">
        <div class=" counterHome ">
            <img class="img-fluid icon-count" src="{{ asset('/images/home/12.png') }}" alt="">
            <h6 class="mt10">{{ $Vendors_count }}</h6>
            <h5 class="fontcounter iransansmedium">فروشگاه ها</h5>
        </div>
        <div class=" counterHomewhite  ">
            <img class="img-fluid icon-count" src="{{ asset('/images/home/123.png') }}" alt="">

            <h6 class="mt10">{{ $Products_count }}</h6>
            <h5 class="fontcounter iransansmedium">کالا ها</h5>
        </div>
        <div class=" counterHome ">
            <img class="img-fluid icon-count" src="{{ asset('/images/home/1234.png') }}" alt="">

            <h6 class="mt10">{{ $Articles_count }}</h6>
            <h5 class="fontcounter iransansmedium">مقالات</h5>
        </div>
        <div class=" counterHomewhite ">
            <img class="img-fluid icon-count" src="{{ asset('/images/home/12345.png') }}" alt="">

            <h6 class="mt10">{{ $settings->sitAllVisitCount +  $settings->allproductsVisitCount + $settings->allVendorsVisitCount + $settings->allBrandsVisitCount  }}</h6>
            <h5 class="fontcounter iransansmedium">بازدید ها</h5>
        </div>
    </section>

</div>
