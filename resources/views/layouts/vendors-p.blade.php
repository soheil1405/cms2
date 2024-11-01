@foreach ($items as $item)
    @if ($type == 'relationable')
        <div class=""
            style="cursor: pointer;border-radius: 15px;margin-bottom:3%;padding-right:10px;width:90%;height:170px;background-color: rgb(240, 237, 237); box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;">


            <div style="width: 100% !important; align-items: center;  display:flex;  justify-content: space-between;"
                class="vendorBox">

                <div class="">

                    <a
                    @if ($item->vendors->hasActiveStory($item->vendors->id) == 1) 
                    
                    
                    @if (seenedBeforStory($item->vendors->id))
                    {{--  @dd("asdasdasd")  --}}
                        style="border:1px solid black !important;"
                    @else

                    style="border:1px solid red "
                  
                    @endif
                    
                    href='{{ route('products.show', ['vendor' => $item->vendors->name, 'product' => $product->slug , 'urlback'=>url()->full() ,'fId' => $item->vendors->id , 'lastOne'=>$item->vendors->id] ) }}' @endif>
            
                    <img style=" margin:5px 5px 0px 5px; border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; max-width:100px; height: 100px;"
                        class="vendorBoxItem"
                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->vendors->avatar) }}"
                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->vendors->name) }}"
                        alt="" />
                
                    </a>
                    
                    <div class="vendorBoxItem   ">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700	"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>


                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700	"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>


                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700	"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700	"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700	"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>





                    </div>

                </div>





                <div style=" height: 100%; " class="">
                    <div style="width: 100%; height: 120px; display: flex;" class="">


                        <a style="width:15%; color:black; font-size:20px;"
                            href="{{ route('vendor.home', ['vendor' => $item->vendors->name]) }}"
                            class="vendorBoxItem ">
                            {{ $item->vendors->name }}
                        </a>

                        <div style="width:80%; margin:10px auto; display: flex;" class="">
                            <span id="phoneSvg({{ $item->vendors->id }})"
                                onclick=" $(this).css('display' , 'none');        $(this).next().css('display' , 'block')"
                                ; "
                                                            
                                                            
                                                            href=" #"
                        style="  height: 50px;   cursor: pointer;background-color: #0d6efd;padding: 8px 19px;border-radius: 7px; color: #fff;"
                        class="vendorBoxItem">
                        <span style="padding-left: 10px; ">مشاهده
                            شماره</span>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d=" M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547
                                2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745
                                0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846
                                1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0
                                1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                            </svg>
                            </span>

                            <div id="phoneVendor({{ $item->vendors->id }})" style="display: none; "
                                class="vendorBoxItem ">



                                شماره تلغن :
                                <div class="d-flex ">

                                    <a class="vendorVember"
                                        href="tel:{{ $item->vendors->number }}">{{ $item->vendors->number }}</a>
                                    - <a class="vendorVember"
                                        href="tel:{{ $item->vendors->phone_number }}">{{ $item->vendors->phone_number }}</a>

                                    - <a class="vendorVember"
                                        href="tel:{{ $item->vendors->phone_number2 }}">{{ $item->vendors->phone_number2 }}</a>

                                </div>


                            </div>



                            <span id="AddressSvg"
                                onclick=" $(this).css('display' , 'none');      $(this).next().css('display' , 'block')"
                                style="  height: 50px;  cursor: pointer;background-color: #0d6efd; padding: 8px 19px;border-radius: 7px; color: #fff;"
                                class="vendorBoxItem">
                                <span class="" style="   padding-left: 10px;">مشاهده
                                    آدرس</span>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z" />
                                    <path fill-rule="evenodd"
                                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                                </svg>
                            </span>



                            <div id="Address({{ $item->vendors->id }})" style=" display:none; "
                                class="vendorBoxItem vazirFont">



                                <small class="">آدرس :</small>
                                <div class="d-flex  vazirFont">

                                    {{ $item->vendors->address }}

                                </div>


                            </div>




                        </div>
                        <div style="padding:25px; display: flex;">

                            @auth
                                <a class="vendordissliked" href="#"
                                    onclick="addToFAvorite('v' , {{ $item->vendors->id }} ) ; window.location.reload();"
                                    @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->vendors->id)->get()) >= 1) style="display:none" @endif>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>

                                </a>


                                <a @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->vendors->id)->get()) < 1) style="display:none" @endif class="vendorliked"
                                    href="#"
                                    onclick="removeFromFavorite('v',{{ $item->vendors->id }}); window.location.reload();
                                                                                        ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="red"
                                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </a>

                                <a onclick="copyToClipboardVendorFromAll('{{ $item->vendors->name }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        style="color:blue;" fill="currentColor" class="bi bi-share-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z" />
                                    </svg>
                                </a>

                            @endauth
                        </div>
                    </div>
                    <div style=" display: flex; width: 100%; height: 40px;" class="vendorBoxItem">



                        <p class="  vendorBoxItem"> دسته بندی فعالیت :
                        </p>


                        <?php
                        
                        $data = str_replace('-', ' ', strval($item->vendors->category_activity));
                        
                        $d = explode('-', $item->vendors->category_activity);
                        
                        ?>
                        @foreach ($d as $ddd)
                            <?php $category = \App\Models\Category::find($ddd); ?>

                            @if ($category)
                                <a class=" vazirFont vendorBoxItem"
                                    style=" font-size: 15px; background-color: rgb(189, 186, 186); color:black; border-radius: 5px; "
                                    href="{{ route('categories.show', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            @endif
                        @endforeach




                    </div>
                </div>


                <div class="provider">


                </div>

                <div id="Address" style="floa" class="vendorBoxItem">
                    <a class="btn btn-outline-primary my-3" style="border:1px solid blue; border-radius:10%;"
                        href="{{ route('vendor.home', ['vendor' => $item->vendors->name]) }}"> مشاهده
                        فروشگاه</a>

                    @auth

                        @if (loginedUserFollwingVendorStatus($item->vendor->id))
                            <form action="{{ route('user.follow.follow') }}" method="post" class="text-center">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->vendors->id }}">


                                <button type="submit" class="btn btn-outline-primary">دنبال کردن </button>

                            </form>
                        @elseif(loginedUserFollwingVendorStatus($item->vendor->id) == 1)
                            <form action="{{ route('user.follow.follow') }}" method="post" class="text-center">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->vendor->id }}">


                                <button type="submit" class="btn btn-outline-primary"> دنبال کردن متقابل </button>

                            </form>
                        @else
                            <form action="{{ route('user.follow.unfollw') }}" method="post" class="text-center">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->vendors->id }}">
                                <button type="submit" class="btn  btn-primary  ">

                                    دنبال نکردن
                                </button>

                            </form>
                        @endif


                    @endauth


                </div>

            </div>


        </div>
    @else
        <div class=" VEndorItemMain bg-white"
            style="    cursor: pointer;
    border-radius: 15px;
    margin-bottom: 3%;
   
    width: 100%;
    background-color: rgb(240, 237, 237);

    /* box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset; */">

            {{-- @if ($item->pin_number > 0)
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-pin-angle-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z" />
                </svg>
            @endif --}}

            <div class="vendorBox ">


                <div class="">
                    
                    <a
                    @if ($item->hasActiveStory($item->id) == 1) href='{{ route('products.show', ['product' => $product->slug , 'urlback'=>url()->full() ,'fId' => $item->id , 'lastOne'=>$item->id] ) }}'
                    
                    @endif>
            
                    
                    <img  class="

                    
                    @if ($item->hasActiveStory($item->id) == 1 && seenedBeforStory($item->id))
                            
                            
                    @elseif($item->hasActiveStory($item->id) == 1 && !seenedBeforStory($item->id))
                        singlePageStory    
                    @endif
                
            vendorBoxProfile hoverbtn"src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->avatar) }}"
                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->name) }}" alt="" 
                        
                        
                    
                        
                        />
                    
                    </a>
                        <div class="vendorBoxItem   ">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        
                        
                        
                        @if ($item->rate_Ave >= '5') fill="#FFD700"

                    @else


                    fill="#949191" @endif
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>


                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            @if ($item->rate_Ave >= '4') fill="#FFD700"

                    @else


                    fill="#949191" @endif
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>


                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            @if ($item->rate_Ave >= '3') fill="#FFD700"

                    @else


                    fill="#949191" @endif
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            @if ($item->rate_Ave >= '2') fill="#FFD700"

                    @else


                    fill="#949191" @endif
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            @if ($item->rate_Ave >= '1') fill="#FFD700"

                    @else


                    fill="#949191" @endif
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>





                    </div>

                </div>






                <a href="{{ route('vendor.home', ['vendor' => $item->name]) }}"
                    class="vendorBoxItem vendorMame dastnevis col-5 " style="font-size: 28px;">
                    {{ $item->title }}
                </a>


                <div id="Address" class="vendorBoxItem gotoVEndorLink">




                </div>

            </div>
            <div style=" " class=" ">
                <div class="vendorDetail">


                    {{-- like share  --}}
                    {{-- <div class="row store-icons d-sm-none">

                    @auth
                        <a class="vendordissliked mt-2 " href="#"
                            onclick="addToFAvorite('v' , {{ $item->id }} ) ; window.location.reload();"
                            @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get(),
    ) >= 1) style="display:none" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                        </a>


                        <a @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get(),
    ) < 1) style="display:none" @endif class="vendorliked mt-2"
                            href="#"
                            onclick="removeFromFavorite('v',{{ $item->id }}); window.location.reload(); ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red"
                                class="bi bi-heart-fill " viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </a>



                    @endauth



                    @guest


                        <?php
                        $counter = null;
                        
                        if (Session::has('favorite_v')) {
                            $Pfavorited = Session::get('favorite_v');
                            foreach ($Pfavorited as $itemm) {
                                if ($itemm['id'] == $item->id) {
                                    $counter = true;
                                }
                            }
                        }
                        
                        ?>



















                        @if ($counter)
                            <a class="vendorliked" href="#"
                                onclick="removeFromFavorite('v',{{ $item->id }}); window.location.reload(); ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red"
                                    class="bi bi-heart-fill " viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                </svg>
                            </a>
                        @else
                            <a class="vendordissliked" href="#"
                                onclick="addToFAvorite('v' , {{ $item->id }} )">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                </svg>

                            </a>
                        @endif



                    @endguest



                    <a onclick="copyToClipboardVendorFromAll('{{ $item->name }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-share-fill" viewBox="0 0 16 16" style="color:blue;">
                            <path
                                d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z" />
                        </svg>
                    </a>

                </div> --}}
                    <div class="mt-4 vendorDetail numandAdd d-flex justify-content-evenly" style="">

                        <div class="phonenumber-button">
                            <span id="phoneSvg({{ $item->id }})" class=" vendorBoxItem btn btn-outline-primary"
                                onclick=" $(this).css('display' , 'none');        $(this).next().css('display' , 'block')"
                                ; href="#" class="vendorBoxItem vendorBox showNumBt  ">
                                <span class="iransansmedium">مشاهده
                                    شماره</span>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                            </span>

                            <div id="phoneVendor({{ $item->id }})" style="display: none; "
                                class="iransansmedium ">



                                شماره تلفن :

                                <a class="vendorVember iransansmedium"
                                    href="tel:{{ $item->phone_number }}">{{ $item->phone_number }}</a>



                            </div>


                        </div>
                        <div>
                            @auth

                                @if (Auth::user()->vendor->id != $item->id)
                                    
                                @if (loginedUserFollwingVendorStatus($item->id) == 0)
                                    <form action="{{ route('user.follow.follow') }}" method="post" class="text-center">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">


                                        <button type="submit" class="btn btn-outline-primary" style="margin:8px;">دنبال
                                            کردن </button>

                                    </form>
                                @elseif(loginedUserFollwingVendorStatus($item->id) == 1)
                                    <form action="{{ route('user.follow.follow') }}" method="post" class="text-center">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">


                                        <button type="submit" class="btn btn-outline-primary" style="margin:8px;"> دنبال
                                            کردن متقابل </button>

                                    </form>
                                @else
                                    <form action="{{ route('user.follow.unfollw') }}" method="post"
                                        class="text-center">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn  btn-primary  " style="margin:8px;">

                                            دنبال نکردن
                                        </button>

                                    </form>
                                @endif
                                
                                @endif
                            @endauth
                        </div>


                        <div class="address-button">

                            <span id="AddressSvg "
                                onclick=" $(this).css('display' , 'none');      $(this).next().css('display' , 'block')"
                                class="showNumBt vendorBoxItem btn btn-outline-primary">
                                <span class="iransansmedium ">مشاهده
                                    آدرس</span>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z" />
                                    <path fill-rule="evenodd"
                                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                                </svg>
                            </span>



                            <div id="Address({{ $item->id }})" style=" display:none; "
                                class="vendorBoxItem iransansmedium">



                                <small class="iransansmedium">آدرس :</small>

                                {{ $item->address }}



                            </div>

                        </div>

                        {{-- like share  --}}
                        {{-- <div class="row store-icons  d-none d-md-block">

                        @auth
                            <a class="vendordissliked mt-2 heart-icon-style" href="#"
                                onclick="addToFAvorite('v' , {{ $item->id }} ) ; window.location.reload();"
                                @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get(),
    ) >= 1) style="display:none" @endif>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                </svg>

                            </a>


                            <a @if (count(
        App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get(),
    ) < 1) style="display:none" @endif class="vendorliked mt-2"
                                href="#"
                                onclick="removeFromFavorite('v',{{ $item->id }}); window.location.reload(); ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red"
                                    class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                </svg>
                            </a>



                        @endauth



                        @guest


                            <?php
                            $counter = null;
                            
                            if (Session::has('favorite_v')) {
                                $Pfavorited = Session::get('favorite_v');
                                foreach ($Pfavorited as $itemm) {
                                    if ($itemm['id'] == $item->id) {
                                        $counter = true;
                                    }
                                }
                            }
                            
                            ?>



















                            @if ($counter)
                                <a class="vendorliked" href="#"
                                    onclick="removeFromFavorite('v',{{ $item->id }}); window.location.reload(); ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red"
                                        class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </a>
                            @else
                                <a class="vendordissliked" href="#"
                                    onclick="addToFAvorite('v' , {{ $item->id }} )">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>

                                </a>
                            @endif



                        @endguest



                        <a onclick="copyToClipboardVendorFromAll('{{ $item->name }}')">
                           
                            <img width="30" height="30" src="{{ asset('main/tool/duuydusaduas-min.png') }}"
                                alt="external-send-email-flatart-icons-outline-flatarticons" />
                        </a>

                    </div> --}}

                    </div>

                </div>

            </div>

            <div class="text-center">
                <a class="btn btn-primary btnGotoVendorPage w-75  "
                    href="{{ route('vendor.home', ['vendor' => $item->name]) }}">
                    مشاهده
                    فروشگاه</a>
            </div>
        </div>
    @endif
@endforeach
