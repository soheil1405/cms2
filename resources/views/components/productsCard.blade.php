<div class="p-2 col-md-4 col-sm-4 col-lg-3  col-6" style=" ">

    <div class=" border col-12 p-1 card productCard Product-card-style">
        <a href="{{ route('products.show', [ 'product' => $product->slug]) }}"
            class="  productImgDiv card-img " style="position: relative;">

            <div class="  productImgDiv card-img">

                <img src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image()) }}" class="card-img-top"
                    alt="{{ $product->name }}" style="border-top-left-radius: 15px;border-top-right-radius:15px;">

            </div>
            <div class="" style="position: absolute; top:5px ; left:5px;">
                @if ($product->pin_number > 0  && productPageDoesentSort() )
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                            fill="currentColor" class="bi bi-pin-angle-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z" />
                        </svg>
                @elseif($product->VendorPinNumber > 0)
                    @if (\Request::route()->getName() == 'vendor.home' || \Request::route()->getName() == 'products.show')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                            fill="currentColor" class="bi bi-pin-angle-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z" />
                        </svg>
                    @endif
                @endif
            </div>
        </a>
        <div class="card-text-container" style="float: right; padding:0 !important;">



            <h2 class="product_name row align-items-center">
                <a class="" style=""
                    href="{{ route('products.show', [ 'product' => $product->slug]) }}">

                    {{ $product->name }}
                </a>

            </h2>
            {{--  --}}

            <div class="">


                <div class="mt-2">
                    <p class="product_p m-0" style="font-size: 14px;">


                        <small class=" pCatName">
                            <span class="text-black">دسته : </span>

                            <a href="{{ route('categories.show', ['category' => $product->category->slug]) }}">


                            {{ $product->category->name }}

                            </a>

                        </small>

                    </p>


                    <p class="product_p product_p_brand m-0" style="font-size: 14px;">

                        <a href="{{ route('showByBrand', ['brand' => $product->brand->slug]) }}"
                            class=" productBrandName">
                            <span class="text-black">برند : </span>

                            <a href="{{ route('showByBrand', ['brand' => $product->brand->slug]) }}">


                                {{ $product->brand->name }}
                            </a>

                        </a>

                    </p>


                </div>
                <div class="btLikeDiv">

                    @auth


                    <small  href="#"  title="افزودن به علاقه مندی ها"
                            onclick="addToFAvorite('p' , {{ $product->id }} ); " data-bs-toggle="tooltip"
                            data-bs-placement="right" title="افزدون به علاقه مندی ها"
                            @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) >= 1) style="display:none ;" @endif
                            
                            class="dissliked  addToFAvorite_{{ $product->id }}"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                                fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                        </small>


                        <small @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) < 1) style="display:none" @endif class="liked removeFromFavorite{{ $product->id }}" href="#"
                            title="حذف از علاقه مندی ها" onclick="removeFromFavorite('p',{{ $product->id }}); ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                                style="color:#000; " class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </small>

                    @endauth

                    @guest

                        <?php
                        $counter = null;
                        
                        if (Session::has('favorite_p')) {
                            $Pfavorited = Session::get('favorite_p');
                            foreach ($Pfavorited as $item) {
                                if ($item['id'] == $product->id) {
                                    $counter = true;
                                }
                            }
                        }
                        
                        ?>



                        <a @if ($counter) style="display:block;" @else style="display:none;" @endif
                            class="liked removeFromFavorite{{ $product->id }}" href="#" title="حذف از علاقه مندی ها"
                            onclick="removeFromFavorite('p',{{ $product->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                                fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </a>
                        <a @if ($counter) style="display:none;"@else style="display:block;" @endif
                            class="dissliked addToFAvorite_{{ $product->id }}"
                            onclick="addToFAvorite('p' , {{ $product->id }})" title="افزودن به علاقه مندی ها">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                                fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                        </a>

                        


                    @endguest




                    <small class="share-button"
                        onclick="copyToClipboardProductFromAll( '{{ $product->vendor->name }}' , '{{ $product->slug }}' )"
                        title="اشتراک گذاری" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="به اشتراک گذاری">
                        <img width="20" height="20"
                            src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                            alt="external-send-email-flatart-icons-outline-flatarticons" />
                    </small>

                    <small class="compare-button" onclick="
                   
                      addTocomp({{ $product->id }});
                      $('.compCounter').css('display' , 'block !important')
                      " 
                        title="مقایسه " data-bs-toggle="tooltip" data-bs-placement="bottom" title="مقایسه ">
                        <img src="{{ asset('main/tool/8373506.png') }}" style="width: 20px;height:20px;" width="20" height="20"
                            alt="">
                    </small>
                </div>

                <p class="productgheymat ">
                    قیمت
                    <?php if($product->product_price !=null ) { ?>

                    <small class=" productgheymat" class="text-center texr-danger">
                        {{ $product->product_price }}
                    </small>
                    تومان
                    <?php } ?>

                </p>

            </div>







        </div>


        {{--  --}}
        <div class="btn btn-primary productShowVendor">
            <a style="color:white;" class="btn-primary-custom-font"
                href="{{ route('products.show', [ 'product' => $product->slug]) }}">
                @if (isset($linkTxt))
                    {{ $linkTxt }}
                @else
                    {{ ProductCardlinkName() }}
                @endif
            </a>
        </div>
    </div>
</div>
