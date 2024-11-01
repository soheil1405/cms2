<div class="border col-12 card productCard p-1 Product-card-styled">
    <a href="{{ route('products.show', ['product' => $product->slug]) }}" class="  productImgDiv card-img">
        <img loading="lazy" alt="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}" class="card-img-car productImg"
            alt="{{ $product->name }}">


    </a>
    <div class="card-text-container card-sett">



        <h2 class="product_name " class="">
            <a class="iransanslight" href="{{ route('products.show', ['product' => $product->slug]) }}">

                {{ $product->name }}

            </a>

        </h2>

        <div class="mt-3">
            <p class="product_p" style="font-size: 14px;">


                <small class=" pCatName">
                    <span class="text-black">دسته : </span>

                    {{ $product->category->name }}

                </small>

            </p>


            <p class="product_p " style="font-size: 14px;">

                <a href="{{ route('showByBrand', ['brand' => $product->brand->slug]) }}" class=" productBrandName">
                    <span class="text-black">برند : </span>
                    {{ $product->brand->name }}

                </a>

            </p>
        </div>

        <div class="btLikeDiv pt-0">

            @auth
                <small class="dissliked" href="#" title="افزودن به علاقه مندی ها"
                    onclick="addToFAvorite('p' , {{ $product->id }} ); " data-bs-toggle="tooltip" data-bs-placement="right"
                    title="افزدون به علاقه مندی ها" @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) >= 1) style="display:none ;" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                        fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                    </svg>

                </small>


                <small @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) < 1) style="display:none" @endif class="liked" href="#"
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



                @if ($counter)
                    <a class="liked" href="#" title="حذف از علاقه مندی ها"
                        onclick="removeFromFavorite('p',{{ $product->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                            fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                        </svg>
                    </a>
                @else
                    <a class="dissliked" onclick="addToFAvorite('p' , {{ $product->id }})"
                        title="افزودن به علاقه مندی ها">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="color:#000; "
                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>

                    </a>
                @endif



            @endguest




            <small onclick="copyToClipboardProductFromAll( '{{ $product->vendor->name }}' , '{{ $product->slug }}' )"
                title="اشتراک گذاری" data-bs-toggle="tooltip" data-bs-placement="bottom" title="به اشتراک گذاری">
                <img width="20" height="20" style="width: 20px; height: 20px;"
                    src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                    alt="external-send-email-flatart-icons-outline-flatarticons" />
            </small>

            <small onclick="addTocomp({{ $product->id }}); "  title="مقایسه " data-bs-toggle="tooltip"
                data-bs-placement="bottom" title="مقایسه ">
                <img src="{{ asset('main/tool/8373506.png') }}" style="width: 20px;height:20px;" width="20"
                    height="20" alt="">
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
    <div class="btn btn-primary productShowVendor">
        <a style="color:white;font-size:15px;" href="{{ route('products.show', ['product' => $product->slug]) }}">
            مشاهده فروشگاه
        </a>
    </div>
</div>
