<?php $setting = App\Models\Admin\Setting::first(); ?>










<div class="container  mt-desktop-home-slider55 ">


    <div class="slider-container">
        <span class="arrow-left"></span>
        <span class="arrow-right"></span>
        <div class="slider" id="slider">
            {{-- <div class="slide prev-2">
            <img src="{{asset('main/images/slides/1.jpg')}}" class="img-fluid-height" alt="">
           </div> --}}

            {{-- @dd($availableSliders); --}}
            {{-- @dd($availableSliders) --}}

            @foreach ($availableSliders as $key => $slider)
                @if ($slider->product_id)
                    <div class="slide {{ SliderClass(count($availableSliders), $key) }}">
                        <a
                            href="{{ route('products.show', ['vendor' => $slider->vendorName, 'product' => $slider->product_slug]) }}"><img
                                loading="lazy" src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                class="rt imgslider "style="height:350px;"></a>
                    </div>
                @elseif($slider->otherWayLinks)
                    <div class="slide {{ SliderClass(count($availableSliders), $key) }}">

                        <a href="{{ $slider->otherWayLinks }}"><img loading="lazy"
                                src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                alt="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}" class="rt imgslider "
                                style="height:350px;"></a>
                    </div>
                @elseif($slider->article_id)
                    <div class="slide {{ SliderClass(count($availableSliders), $key) }}">

                        <a href="{{ route('home.HomeArticle.show', ['article' => $slider->article->slug]) }}"><img
                                loading="lazy" src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                alt="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}" class="rt imgslider "
                                style="height:350px;"></a>
                    </div>
                @else
                    <div class="slide {{ SliderClass(count($availableSliders), $key) }}">


                        <a href="{{ route('vendor.home', ['vendor' => $slider->vendor->name]) }}"><img loading="lazy"
                                style="max-height: 350px"
                                src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                alt="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                class="rt imgslider"></a>
                    </div>
                @endif
            @endforeach

            {{-- 
        <div class="slide prev-2">
       <img src="{{asset('main/images/slides/1.jpg')}}" class="img-fluid-height" alt="">
      </div>
      <div class="slide prev-1">
        <img src="{{asset('main/images/slides/2.jpg')}}" class="img-fluid-height" alt="">

      </div>
      <div class="slide active">
        <img src="{{asset('main/images/slides/3.jpg')}}" class="img-fluid-height" alt="">

      </div>
      <div class="slide next-1">
        <img src="{{asset('main/images/slides/4.jpg')}}" class="img-fluid-height" alt="">

      </div>
      <div class="slide next-2">
        <img src="{{asset('main/images/slides/5.jpg')}}" class="img-fluid-height" alt="">

      </div> --}}

        </div>
        {{-- <span></span> --}}
        {{-- <div class="dots">

            <span></span>
            <span></span>
            <span class="active"></span>
            <span></span>
            <span></span>

        </div> --}}
    </div>
</div>
</div>











































{{-- اسلایدر 3تایی افکت دار  --}}



{{-- 
<div class="container p-0">
    
<div class="slider">
    <div class="wrapper">
        <div style="background-image: url('main/images/slides/1.jpg')" class="item item1 active-3d-slider">
            <div class="item__info">
         
            </div>
        </div>
        <div style="background-image: url('main/images/slides/2.jpg') " class="item item2">
            <div class="item__info">
     
            </div>
        </div>
        <div style="background-image: url('main/images/slides/3.jpg')" class="item item3">
            <div class="item__info">
            </div>
        </div>
     
    </div>

    <div class="arrow arrow-next"></div>
    <div class="arrow arrow-prev"></div>
</div>
</div> --}}

























{{-- اسلایدر قدیم  --}}



{{-- <div class="container">
    <!--شروع باکس جستو جوی زیر هدر-->
    <aside class="bg-text rt ">
        <div class="main1 ">
            <div class=" topslider index-text rt">
                <section class="boxs right">






                    <div class="entery rt">

                        @if (isset($home))


                            <div class="owl-carousel alone-slider offe0r rt">

                                <div class="item"><a href="main/product.html"><img
                                            alt="{{ asset('main/images/slides/4.jpg') }}"
                                            src="{{ asset('main/images/slides/1.jpg') }}" class="rt imgslider "></a>
                                </div>
                                <div class="item"><a href="main/product.html"><img
                                            src="{{ asset('main/images/slides/2.jpg') }}"
                                            alt="{{ asset('main/images/slides/4.jpg') }}" class="rt imgslider"></a>
                                </div>
                                <div class="item"><a href="main/product.html"><img
                                            src="{{ asset('main/images/slides/3.jpg') }}"
                                            alt="{{ asset('main/images/slides/4.jpg') }}" class="rt imgslider"></a>
                                </div>
                                <div class="item"><a href="main/product.html"><img
                                            src="{{ asset('main/images/slides/4.jpg') }}"
                                            alt="{{ asset('main/images/slides/4.jpg') }}" class="rt imgslider"></a>
                                </div>
                                <div class="item"><a href="main/product.html"><img
                                            src="{{ asset('main/images/slides/5.jpg') }}"
                                            alt="{{ asset('main/images/slides/4.jpg') }}" class="rt imgslider"></a>
                                </div>






                                @foreach ($availableSliders as $slider)
                                    @if ($slider->product_id)
                                        <div class="item "><a
                                                href="{{ route('products.show', ['vendor' => $slider->vendorName, 'product' => $slider->product_slug]) }}"><img
                                                    loading="lazy"
                                                    src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                                    class="rt imgslider "style="height:350px;"></a></div>
                                    @elseif($slider->otherWayLinks)
                                        <div class="item"><a href="{{ $slider->otherWayLinks }}"><img loading="lazy"
                                                    src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                                    alt="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                                    class="rt imgslider " style="height:350px;"></a></div>
                                    @else
                                        <div class="item"><a
                                                href="{{ route('vendor.home', ['vendor' => $slider->vendor->name]) }}"><img
                                                    loading="lazy" style="max-height: 350px"
                                                    src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                                    alt="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                                    class="rt imgslider"></a></div>
                                    @endif
                                @endforeach





                            </div>
                        @elseif(isset($product))
                            <div class="owl-carousel alone-slider offe0r rt">

                                @foreach ($product->Allimages as $item)
                                    <div class="item"><a href="main/product.html"><img
                                                alt="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->image) }}"
                                                src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->image) }}"
                                                class="rt imgslider "></a></div>
                                @endforeach


                            </div>

                        @endif
                    </div>


                </section>





            </div>



        </div>
    </aside>
</div> --}}




{{-- دو اسلایدر کوچک --}}

{{-- <div class="entery rt">
                        @if ($site_setting->gif1)
                            <div class="boximage br25 wr-item minislider"><a target="_blank"
                                    href="{{ $setting->gif1Link }}"><img loading="lazy" class="br25"
                                        src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting->gif1) }}"></a></div>
                        @endif
                        @if ($site_setting->gif2)
                            <div class="boximage br25 wr-item minislider mb-0" style=""><a target="_blank"
                                    href="{{ $setting->gif2Link }}"><img class="br25" loading="lazy"
                                        src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting->gif2) }}"></a></div>
                        @endif
                    </div> --}}
