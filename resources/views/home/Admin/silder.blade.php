<style>
    .rt {
        border-radius: 15px !important;
    }

    .owl-nav {
        display: none !important;
    }

    .sidenav {
        
        display: flex;


        height: 100%;
        /* 100% Full-height */
        width: 0;
        /* 0 width - change this with JavaScript */
        position: fixed;
        /* Stay in place */
        z-index: 989898989898;
        /* Stay on top */
        top: 0;
        background-color: #111;
        /* Black*/
        overflow-x: hidden;
        /* Disable horizontal scroll */
        padding-top: 60px;
        /* Place content 60px from the top */
        transition: 0.5s;
        /* 0.5 second transition effect to slide in the sidenav */
    }

    /* The navigation menu links */
    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s
    }

    /* When you mouse over the navigation links, change their color */
    .sidenav a:hover,
    .offcanvas a:focus {
        color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
        transition: margin-left .5s;
        padding: 20px;
    }

    .sidenav {
        right: 0;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 11px;
        }
    }

    .sidenav {
        right: 0;
    }


    .switch {
       position: relative;
       display: inline-block;
       width: 60px;
       height: 34px;
    }
    .switch input {
       opacity: 0;
       width: 0;
       height: 0;
    }
    .round {
       position: absolute;
       cursor: pointer;
       top: 0;
       left: 0;
       right: 0;
       bottom: 0;
       background-color: #ccc;
       -webkit-transition: .4s;
       transition: .4s;
    }
    .round:before {
       position: absolute;
       content: "";
       height: 26px;
       width: 26px;
       left: 4px;
       bottom: 4px;
       background-color: white;
       -webkit-transition: .4s;
       transition: .4s;
    }
    input:checked + .round {
       background-color: rgb(85, 21, 138);
    }
    input:focus + .round {
       box-shadow: 0 0 1px rgb(255, 77, 211);
    }
    input:checked + :before {
       transform: translateX(26px);
    }
    .round {
       border-radius: 34px;
    }
    .round:before {
       border-radius: 50%;
    }
    .set_title{
        padding: 5px;
        width: 20%;
    }


    .notttt{
        filter: grayscale(100%);

    }
</style>

<?php $setting = App\Models\Admin\SiteSetting::first(); ?>

<?php $setting2 = App\Models\Admin\Setting::first(); ?>


<form method="POST" id="HomeEdit" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}" >

@csrf

    <div class="">

        <label class="switch">

            <input type="hidden" name="sl" value="1">

            <input name="sliders" type="checkbox"  id="sliderController"                    
            style="display: none;"
                onchange="$('#HomeEdit').submit();"
            
                @if($setting->sliders)
            
                checked
                
                @endif
                >
            <span class="round"></span>
            </label>
 
    </div>

</form>




<!-- <div id="mySidenav" class="sidenav">
    
    <div class=" "style="width:50%; border-left:1px solid #efefef;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <hr style="color: #818181 !important;">

    <a href="#">رزور شده ها</a>
    
    @foreach ($availableSliders as $slider)

    <a href="#">    جایگاه {{$slider->position}}    :
    </a>
    @if ($slider->product_id)
                                <div class="item "><a
                                        href="{{ route('products.show', ['vendor' => $slider->vendorName  , 'product' => $slider->product_slug]) }}">
                                        <img
                                            style="max-height: 50px"
                                            src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                            class="rt imgslider">
                                        
                                        
                                        </a></div>


                                            
                                            @elseif($slider->otherWayLinks)


                                            <div class="item"><a
                                        href="{{ $slider->otherWayLinks }}"><img
                                            style="max-height: 50px"
                                            src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                            class="rt imgslider"></a></div>
                     






                                            @else
                                <div class="item"><a
                                        href="{{ route('vendor.home', ['vendor' => $slider->vendorName]) }}"><img
                                            style="max-height: 350px"
                                            src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                            class="rt imgslider"></a></div>
                            @endif


    @endforeach

    </div>

    <div class="">
            <a href="#">اسلایدر های ادمین</a>


    </div>




</div>



<span onclick="openNav()" style="cursor: pointer; background: green; border: 1px solid black; padding: 5px;">ویرایش</span> -->



<!--شروع باکس جستو جوی زیر هدر-->
<aside class="bg-text rt ">
    <div class="main1 ">
        <div class=" topslider index-text rt">
            <section class="boxs right">

                <!--شروع جدیدترین پوسته های وردپرس-->

                @if ($site_setting->gif1 || $site_setting->gif2)
                    <aside class="col-sm-9
                    
            
                    @if(!$site_setting->sliders)

                    notttt

                    @endif

                    
            
                    
                    
                    
                    ">
                    @else
                        <aside class="col-sm-12
                        
                        
                                    
                    @if(!$site_setting->sliders)

                    notttt

                    @endif
                        
                        ">
                @endif

                <div class="entery rt">

                    <div class="owl-carousel alone-slider offer rt">

                        {{-- <div class="item"><a href="main/product.html"><img src="{{ asset('main/images/slides/1.jpg') }}"
                                    class="rt imgslider "></a></div>
                        <div class="item"><a href="main/product.html"><img
                                    src="{{ asset('main/images/slides/2.jpg') }}" class="rt imgslider"></a></div>
                        <div class="item"><a href="main/product.html"><img
                                    src="{{ asset('main/images/slides/3.jpg') }}" class="rt imgslider"></a></div>
                        <div class="item"><a href="main/product.html"><img
                                    src="{{ asset('main/images/slides/4.jpg') }}" class="rt imgslider"></a></div>
                        <div class="item"><a href="main/product.html"><img
                                    src="{{ asset('main/images/slides/5.jpg') }}" class="rt imgslider"></a></div>



 --}}


                        @foreach ($availableSliders as $slider)
                        @if ($slider->product_id)
                                <div class="item "><a
                                        href="{{ route('products.show', ['vendor' => $slider->vendorName  , 'product' => $slider->product_slug]) }}"><img
                                            style="max-height: 350px"
                                            src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                            class="rt imgslider"></a></div>


                                            
                                            @elseif($slider->otherWayLinks)


                                            <div class="item"><a
                                        href="{{ $slider->otherWayLinks }}"><img
                                            style="max-height: 350px"
                                            src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                            class="rt imgslider"></a></div>
                     






                                            @else
                                <div class="item"><a
                                        href="{{ route('vendor.home', ['vendor' => $slider->vendorName]) }}"><img
                                            style="max-height: 350px"
                                            src="{{ url(env('SLIDERS_IMAGE_DIRECTORY') . $slider->image) }}"
                                            class="rt imgslider"></a></div>
                            @endif

                        @endforeach





                    </div>
                </div>
</aside>




<!--پایان جدیدترین پوسته های وردپرس-->

<!--شروع جدیدترین افزونه ها و ماژول ها-->
<aside class="col-sm-3 float-md-end">

    <div class="entery rt">
        {{-- @if ($site_setting->gif1)
            <div class="boximage br25 wr-item"><a target="_blank" href="main/product.html"><img class="br25"
                        src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting->gif1) }}"></a></div>
        @endif
        @if ($site_setting->gif2)
            <div class="boximage br25 wr-item"><a target="_blank" href="main/product.html"><img class="br25"
                        src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting->gif2) }}"></a></div>
        @endif --}}


        
        <form id="gif1form" action="{{route('admin.settindDetail.updateGif1')}}" method="post" enctype="multipart/form-data">
                            
            @csrf
            <input type="file" name="gif1" onchange="$('#gif1form').submit();" >

        </form>


        <form method="POST" id="HomeEditG1" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}" >

            @csrf
            
                <div class="">
            
                    <label class="switch">
            
                        <input type="hidden" name="g1" value="1">
            
                        <input name="HomeG1" type="checkbox"  id="sliderController"                    
                        style="display: none;"
                            onchange="$('#HomeEditG1').submit();"
                        
                            @if($setting->gif1)
                        
                            checked
                            
                            @endif
                            >
                        <span class="round"></span>
                        </label>
             
                </div>
            
            </form>
            
            
        
            <div class="boximage br25 wr-item
            @if(!$site_setting->gif1)

            notttt

            @endif

            
    
            
            
            
            
            
            
            "><a target="_blank" href="main/product.html"><img class="br25"
                     
                src="{{ url(env('HOME_GIFS_DIRECTORY').$setting2->gif1) }}"></a></div>
        
                <div class="boximage br25 wr-item
                
                @if(!$site_setting->gif2)

                notttt
    
                @endif
    
                
                
                
                
                "><a target="_blank" href="main/product.html"><img class="br25"
                        src="{{ url(env('HOME_GIFS_DIRECTORY').$setting2->gif2) }}"
                
                        ></a></div>
        
                        <form method="POST" id="HomeEditG2" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}" >

                            @csrf
                            
                                <div class="">
                            
                                    <label class="switch">
                            
                                        <input type="hidden" name="g2" value="1">
                            
                                        <input name="HomeG2" type="checkbox"  id="sliderController"                    
                                        style="display: none;"
                                            onchange="$('#HomeEditG2').submit();"
                                        
                                            @if($setting->gif2)
                                        
                                            checked
                                            
                                            @endif
                                            >
                                        <span class="round"></span>
                                        </label>
                             
                                </div>
                            
                            </form>

                            <form id="gif12form" action="{{route('admin.settindDetail.updateGif2')}}" method="post" enctype="multipart/form-data">
                            
                                @csrf
                                <input type="file" name="gif2" onchange="$('#gif12form').submit();" >

                            </form>

            
            

    </div>
</aside>
</div>
</div>
</aside>
</section>

<script type="text/javascript">
    /* Simple appearence with animation AN-1*/
    function openNav() {
        document.getElementById("mySidenav").style.width = "500px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    /* Simple appearence with animation AN-1*/
</script>
