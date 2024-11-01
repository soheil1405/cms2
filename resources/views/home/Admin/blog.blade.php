

<?php $setting2 = App\Models\Admin\Setting::first(); ?>



<h2 style="margin: 50px !important; font-family:'dastnevis' !important;"  id="bloggg" class="text-center">مجله اینستابرق</h2>

<form method="POST" id="HomeEditBlgg" action="{{ route('admin.settindDetail.TurnOnOffFromHome') }}" >

    @csrf
    
        <div class="">
    
            <label class="switch">
    
                <input type="hidden" name="blgg" value="1">
    
                <input name="articles" type="checkbox"  id="sliderController"                    
                style="display: none;"
                    onchange="$('#HomeEditBlgg').submit();"
                
                    @if ($site_setting->articles)
                
                    checked
                    
                    @endif
                    >
                <span class="round"></span>
                </label>
     
        </div>
    
    </form>





<div   class="container


@if(!$setting->articles)

notttt

@endif





">
    <div class="row">
        <div class="col-6 mt-3">
            <a href="">
                <img src="{{ url(env('HOME_LINKS_BLOG_IMAGES').$setting2->blogPic_news) }}" alt="" class="brd25 img-fluid">
            </a>
            //////////////////////////////
                        
                        <form id="blogPic_newsForm" action="{{route('admin.settindDetail.blogPic_news')}}" method="post" enctype="multipart/form-data">
                            
                            @csrf
                            <input type="file" name="file" onchange="$('#blogPic_newsForm').submit();" >

                        </form>

        </div>
        <div class="col-6 mt-3">
            <a href="">
                <img src="{{ url(env('HOME_LINKS_BLOG_IMAGES').$setting2->blogPic_share) }}" alt="" class="brd25 img-fluid">
            </a>
            //////////////////////////////
                        
                        <form id="blogPic_shareForm" action="{{route('admin.settindDetail.blogPic_share')}}" method="post" enctype="multipart/form-data">
                            
                            @csrf
                            <input type="file" name="file" onchange="$('#blogPic_shareForm').submit();" >

                        </form>

        </div>
        <div class="col-6">
            <a href="{{ route('home.HomeArticles') }}">
                
                <img src="{{ url(env('HOME_LINKS_BLOG_IMAGES').$setting2->blogPic_Articles) }}" alt="" class="brd25 img-fluid">
            </a>
            //////////////////////////////
                        
                        <form id="blogPic_ArticlesForm" action="{{route('admin.settindDetail.blogPic_Articles')}}" method="post" enctype="multipart/form-data">
                            
                            @csrf
                            <input type="file" name="file" onchange="$('#blogPic_ArticlesForm').submit();" >

                        </form>

        </div>
        <div class="col-6 ">
            <a href="">
                
                <img src="{{ url(env('HOME_LINKS_BLOG_IMAGES').$setting2->blogPic_guids) }}" alt="" class="brd25 img-fluid">
            </a>
            //////////////////////////////
                        
                        <form id="blogPic_guidsForm" action="{{route('admin.settindDetail.blogPic_guids')}}" method="post" enctype="multipart/form-data">
                            
                            @csrf
                            <input type="file" name="file" onchange="$('#blogPic_guidsForm').submit();" >

                        </form>

        </div>
    </div>
</div>
