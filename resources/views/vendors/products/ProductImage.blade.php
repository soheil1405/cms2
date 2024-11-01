{{-- <div id="carouselExampleIndicators" class="carousel slide carousel-fade ">
    <div class="carousel-indicators">


        {{ count($product->Allimages) }}

        @for ($i = 0; $i < count($product->Allimages); $i++)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                @if ($i == 0) class="active" @endif aria-current="true"
                aria-label="Slide {{ $i }}"></button>
        @endfor


    </div>
    <div class="carousel-inner">



        @for ($i = 0; $i < count($product->Allimages); $i++)
            <div
                class="carousel-item
            
            
            @if ($i == 0) active @endif
            
            ">
            
            </div>
        @endfor
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> --}}


{{-- 
<div class="owl-carousel owl-theme product-image-owl-carousel">
    @for ($i = 0; $i < count($product->Allimages); $i++)
    
    <div class="item">
        <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->Allimages[$i]->image) }}"
        class="d-block w-100" alt="">
    </div>
    @endfor
    
</div> --}}

{{-- 
@dd($product->Allimages) --}}
<div class="owl-carousel   product-image-owl-carousel">
    @foreach ($product->avtiveImages as $key => $img)
        <div {{-- onclick="showImage(`{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $img->image) }}`)" --}} class="item div-img-product  imgimgimg">


            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $img->image) }}"
                class="mx-auto img-for-product " alt="">
        </div>
    @endforeach

</div>




{{-- @push('footer_scripts')

@endpush --}}
