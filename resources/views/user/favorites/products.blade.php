@extends('user.layouts.user')

@section('title')
    index products
@endsection



<style>
    .instarang {
        background: radial-gradient(ellipse at 70% 70%, #ee583f 8%, #d92d77 42%, #bd3381 58%);
    }

    .favoriteLink {
        color: #ffff !important;
        border-radius: 10px;
        width: 20%;
        height: 100%;
        padding: 10px;

        text-decoration: none;
    }
</style>

@section('content')
    @include('user.favorites.topMenu')



    <div class="col-12   text-center " style="overflow: hidden;">

        
        <h1>
            محصولات مورد علاقه من
        </h1>
    </div>



        {{-- @foreach ($products as $p) --}}
            {{-- @if ($p->product) --}}


            @include('layouts.products' , ['item'=>$products , 'type'=>'favorite'])

                {{-- <div class="  col-lg-3 col-sm-6 card productCard " style="float: right;background-clip: padding-box !important;
                border: 10px solid transparent !important;padding-left: 0px !important;padding-right: 0px !important;">
                    <div class="">
                        <img src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $p->product->primary_image) }}" id="product_img"
                            class="card-img-top" class="productImg"
                            style="padding:0 !important; margin:0 !important; width:100%;object-fit: cover;
                        border: none; "
                            alt="{{ $p->products->name }}">


                    </div>
                    <div class="card-text-container" style="float: right; padding:0 !important;">



                        <h2 class="product_name "
                            style="width: 100%; text-align: center; margin: 0 !important; border-bottom: 1px solid #efefef;
                    line-height: 61px;"
                            class="">
                            {{ $p->products->name }}

                        </h2>


                        <div style="display: flex; justify-content: space-between; padding-left:10px;" class="">

                            <div class="">
                                <p class="product_p"
                                    style="    width: 100%;
                                text-align: start !important;
                                padding-right: 7px;
                                color: #878080;">

                                    <small class="normalFont" style="width: 100%; text-align:start !important;">

                                        {{ $p->products->category->name }}

                                    </small>

                                </p>


                                <p class="product_p"
                                    style="    width: 100%;
                            text-align: start !important;
                            padding-right: 7px;
                            color: #878080;">

                                    <small class="normalFont" style="width: 100%; text-align:start !important;">

                                        {{ $p->products->brand->name }}

                                    </small>

                                </p>


                            </div>
                            <div style="display: flex; height:80px; flex-direction: column" class="">

                                @auth
                                    <small class="dissliked py-1" href="#"
                                        onclick="addToFAvorite('p' , {{ $p->products->id }} ); window.location.reload();"
                                        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $p->products->id)->get()) >= 1) style="display:none ;" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                        </svg>

                                    </small>


                                    <small class="py-1" @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $p->products->id)->get()) < 1) style="display:none" @endif class="liked"
                                        href="#"
                                        onclick="removeFromFavorite('p',{{ $p->products->id }}); window.location.reload();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                            class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </small>

                                @endauth

                                <small class="py-1" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z" />
                                    </svg>
                                </small>

                                <small class="py-1" onclick="addTocomp({{ $p->products->id }})  window.location.reload();"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
                                    </svg>
                                </small>
                            </div>


                        </div>


                            


                        <?php if($p->products->product_price !=null ) { ?>
                        <p style="width: 100%; text-align:center !important;">
                            قیمت
                            <small class="normalFont" style="width: 100%; text-align:start !important;"
                                class="text-center texr-danger">
                                {{ $p->products->product_price }}
                            </small>
                            تومان
                        </p>
                        <?php }else{ ?>
                        <p style="width: 100%; text-align:center !important;">

                            <small class="normalFont" style="width: 100%; text-align:start !important;"
                                class="text-center texr-danger">
                                --
                            </small>

                        </p>


                        <?php } ?>

                    </div>
                    <a href="{{ route('products.show', ['vendor' => $p->products->vendor->name, 'product' => $p->products->slug]) }}"
                        style="width: 100%; text-align:center !important; background-color: #070bf5; color:white;"
                        class="btn">
                        <span style="margin-top: 0 !important;">
                            مشاهده فروشگاه
                        </span>
                    </a>
                </div> --}}
            {{-- @endif
        @endforeach --}}
  
@endsection
