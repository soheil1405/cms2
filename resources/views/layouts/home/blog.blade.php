<div class="text-center standardtop">
    <h2 style=" font-family:'dastnevis' !important;" class="text-center my-4" id="bloggg" class=" text-center">مجله
        اینستابرق</h2>
</div>
<div class="container mb-3 ">
    <div class="row gy-3 instabargh-blog">
        <div class="col-12 col-md-6 ">
            <a href="{{ route('home.NewsLinks.index') }}">
                <img loading="lazy" src="{{ url(env('HOME_LINKS_BLOG_IMAGES') . $setting2->blogPic_news) }}"
                    alt="" class="brd25 img-fluid show-custome-left-items">
            </a>
        </div>
        <div class="col-12 col-md-6 ">
            <a href="{{ route('home.userArticles.homeIndex') }}">
                <img loading="lazy" src="{{ url(env('HOME_LINKS_BLOG_IMAGES') . $setting2->blogPic_share) }}"
                    alt="" class="brd25 img-fluid show-custome-right-items">
            </a>
        </div>
        <div class="col-12 col-md-6 ">
            <a href="{{ route('home.HomeArticles') }}">

                <img loading="lazy" src="{{ url(env('HOME_LINKS_BLOG_IMAGES') . $setting2->blogPic_Articles) }}"
                    alt="" class="brd25 img-fluid show-custome-left-items">
            </a>
        </div>
        <div class="col-12 col-md-6 ">
            <a href="{{ route('home.BuyProductGuid.homeIndex') }}">

                <img loading="lazy" src="{{ url(env('HOME_LINKS_BLOG_IMAGES') . $setting2->blogPic_guids) }}"
                    alt="" class="brd25 img-fluid show-custome-right-items">
            </a>
        </div>
    </div>
</div>
