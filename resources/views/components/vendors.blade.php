<div class="VEndorItem VEndorItemMain bg-white p-md-2 p-2 ">

    <div class="row mt-md-2 mt-3">


        <div class="col-md-4 col-7 pt-md-2"> <a href="{{ route('vendor.home', ['vendor' => $item->name]) }}"
                class=" h2  dastnevis text-dark">
                {{ $item->title }}
            </a></div>


        <div class="col-md-4 col-3 text-md-center pt-md-3">
            <div class="vendorBoxItem m-0  " title="امتیازدهی به فروشگاه">

                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                    @if ($item->rate_Ave >= '5') fill="#FFD700"

                     @else


                 fill="#949191" @endif
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>


                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                    @if ($item->rate_Ave >= '4') fill="#FFD700"

                    @else


                 fill="#949191" @endif
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>


                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                    @if ($item->rate_Ave >= '3') fill="#FFD700"

                    @else


                  fill="#949191" @endif
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                    @if ($item->rate_Ave >= '2') fill="#FFD700"

                 @else


                  fill="#949191" @endif
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                    @if ($item->rate_Ave >= '1') fill="#FFD700"

                  @else


                   fill="#949191" @endif
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>





            </div>
        </div>

        @if ($item->pin_number > 0)
            <div class="col-md-4 col-2 pt-md-2 text-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-pin-angle-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z" />
                </svg>
            </div>
        @endif


    </div>

    <div class="row mt-3">


        <div class="col-md-2 col-4 text-center">

            <a
                @if ($item->hasActiveStory($item->id) == 1) href='{{ route('vendor.home', ['vendor' => $item->name, 'urlback'=>url()->full() ,'fId' => $item->id , 'lastOne'=>$item->id] ) }}' @endif>
                <img @if ($item->hasActiveStory($item->id) == 1) style="border:2px solid Red; @endif



                @if (seenedBeforStory($item->id))
                
                
                        background:none;
                        border:1px solid #000;
                        
                        @endif
                        "


                    class="
                vendorBoxProfile hoverbtn"
                    src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->avatar) }}"
                    data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $item->name) }}"
                    alt="" /></a>



            {{-- like share icons  --}}

            <div class=" store-icons  d-flex justify-content-evenly">

                @auth
                    <span class="vendordissliked
                    
                    
                    addToFAvorite_{{ $item->id }} 
                    p-0 heart-icon-style"  title="افزودن به علاقه مندی ها"
                        onclick="addToFAvorite('v' , {{ $item->id }} ) ; "
                        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get()) >= 1) style="display:none" @endif>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-heart heart-style" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>

                    </span>


                    <span @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get()) < 1) style="display:none" @endif class="vendorliked  
                        removeFromFavorite{{ $item->id }}
                        
                        
                        p-0" 
                        title="حذف از علاقه مندی ها"
                        onclick="removeFromFavorite('v',{{ $item->id }});  "
                        
                        

                        >
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red"
                            class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                        </svg>
                    </span>



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





                        <span
                        

                    @if (!$counter)
                            style="display: none"
                    @endif
                        class="            removeFromFavorite{{ $item->id }}  p-0" title="حذف از علاقه مندی ها"
                            onclick="removeFromFavorite('v',{{ $item->id }});  ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red"
                                class="bi bi-heart-fill heart-style" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </span>
                        
                        <span 
                        
                        @if ($counter)
                            style="display: none;"
                        @endif
                        class=" addToFAvorite_{{ $item->id }}  p-0"  title="افزودن به علاقه مندی ها"
                            onclick="addToFAvorite('v' , {{ $item->id }} )">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                        </span>



                @endguest



                <a onclick="copyToClipboardVendorFromAll('{{ $item->name }}')" class="p-0 row align-items-center"
                    title="اشتراک گذاری">
                    <img width="22" height="22" src="{{ asset('main/tool/duuydusaduas-min.png') }}"
                        alt="external-send-email-flatart-icons-outline-flatarticons" />
                </a>


            </div>

        </div>


        <div class="col-md-1 d-md-block d-none"></div>


        <div class="col-md-9 col-8 ">
            <div class="p-md-1 p-3">
                {!! strip_tags(Illuminate\Support\Str::limit($item->description, 75)) !!}
            </div>
            <div class="">



                <div class="row store-icons d-none">

                    @auth
                        <a class="vendordissliked mt-2 " href="#"
                            onclick="addToFAvorite('v' , {{ $item->id }} ) ; "
                            @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get()) >= 1) style="display:none" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-heart heart-style" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                        </a>


                        <a @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('vendor_iddd', $item->id)->get()) < 1) style="display:none" @endif class="vendorliked mt-2"
                            href="#"
                            onclick="removeFromFavorite('v',{{ $item->id }});  ">
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
                                onclick="removeFromFavorite('v',{{ $item->id }});  ">
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

                </div>

                <div class="mt-md-2 vendorDetail  d-md-flex justify-content-evenly mt-md-1 mt-3" style="">

                    <div class="phonenumber-button m-1">
                        <span id="phoneSvg({{ $item->id }})" class="  btn-sm btn btn-outline-primary"
                            onclick=" $(this).css('display' , 'none');        $(this).next().css('display' , 'block')"
                            ; href="#" class=" vendorBox showNumBt  ">
                            <span class="iransansmedium">مشاهده
                                شماره</span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                            </svg>
                        </span>

                        <div id="phoneVendor({{ $item->id }})" style="display: none;font-size:12px; "
                            class="iransansmedium ">



                            شماره تلفن :

                            <a class="vendorVember iransansmedium"
                                href="tel:{{ $item->phone_number }}">{{ $item->phone_number }}</a>



                        </div>


                    </div>

                    <div class="address-button m-1">

                        <span id="AddressSvg "
                            onclick=" $(this).css('display' , 'none');      $(this).next().css('display' , 'block')"
                            class="showNumBt  btn btn-sm btn-outline-primary">
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



                        <div id="Address({{$item->id}})" style=" display:none;font-size:12px; "
                            class=" iransansmedium">



                            <small class="iransansmedium">آدرس :</small>

                            {{ $item->address }}



                        </div>

                    </div>
                    <div class="m-1">
                        @auth

                        @if (Auth::user()->vendor->id != $item->id)
                                    
                        
                                    <div
                                    
                                    onclick="follow({{$item->id}})"
                                        @if (loginedUserFollwingVendorStatus($item->id) != 0) style="display : none" @endif


                                        id="followBt_{{ $item->id }}"
                                       
                                    
                                    class="btn btn-outline-primary">
                                        دنبال کردن 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                            </svg>
                                        </span>
                                        
                                    </div>    
                                    
                                    
                            <span
                            
                            


                            onclick="unfollow({{ $item->id }})"
                            @if (loginedUserFollwingVendorStatus($item->id) < 1) style="display : none" @endif

                            id="unfollowBt_{{ $item->id }}"
                           
                        
                            
                            class="btn btn-sm  btn-primary  " >

                                دنبال نکردن
                            
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-dash" viewBox="0 0 16 16">
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                      </svg>
                                </span>
                            </span>
                            
                            @endif
                            @endauth
                    </div>



                </div>

            </div>

            <div class=" bottum row mt-3 d-none d-md-flex">



                <div class="col-3 row align-items-center px-0">
                    <p class="   p-0 pt-1 mb-0 iransansmedium">
                        دسته بندی فعالیت :
                    </p>
                </div>

                <div class="col-9 ">
                    <div class="mt-1 owl-carousel category-carousel owl-theme" {{-- style=" overflow: auto;
                         white-space: nowrap; width: 400px;" --}}>

                        <?php
                        
                        $data = str_replace('-', ' ', strval($item->category_activity));
                        
                        $d = explode('-', $item->category_activity);
                        
                        ?>
                        @foreach ($d as $ddd)
                            <?php $category = \App\Models\Category::find($ddd); ?>

                            @if ($category)
                                <a class="iransanslight bg-primary-subtle  px-3  "
                                    style=" font-size: 12px; ; color:black; border-radius: 12px;width:100%;
                                "
                                    href="{{ route('categories.show', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>




            </div>
        </div>



        {{-- <div id="Address" class="vendorBoxItem gotoVEndorLink">

            <a class="btn btn-primary btnGotoVendorPage w-100 "
                href="{{ route('vendor.home', ['vendor' => $item->name]) }}">
                مشاهده
                فروشگاه</a>


        </div> --}}

    </div>


</div>
