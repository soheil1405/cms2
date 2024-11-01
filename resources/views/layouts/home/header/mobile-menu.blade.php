<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>


{{-- @include('layouts.home.header.scripts'); --}}
{{--  --}}


<div class="col-12 bg-white ">

    <div class="offcanvas offcanvas-end" style="--bs-offcanvas-zindex:2000;--bs-offcanvas-width:90%;" tabindex="-1"
        id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                منو
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="border-0 mobile-menu-navbar m-0 mt-2">

                <a class="menu-top" href="{{ url('/') }}">


                    صفحه اصلی

                </a>


                <a class="menu-top" href="{{ route('products.index') }}">
                    محصولات
                </a>


                <a class="menu-top" href="{{ route('Vendors.list') }}">
                    فروشگاه
                </a>


                <a class="menu-top" href="{{ route('brands.homeIndex') }}">
                    برندها
                </a>




                <a class="menu-top" href="{{ route('favorite.index') }}">
                    علاقه مندی ها
                </a>



                <a class="menu-top" href="https://instabargh.com/#bloggg">
                    مجله اینستابرق
                </a>


                <a class="menu-top" href="{{ route('home.contact_us') }}">
                    تماس با ما
                </a>

                @foreach (\App\Models\Category::lvl_one()->get() as $key => $category)
                    <div class="mobile-menu-dropdown" tabindex="0">
                        <div class="mobile-dropbtn">
                            <a href="#" onclick="return false;">
                                <img class="" src="{{ url(env('CATEGORY_ICON_UPLOAD_PATH') . $category->icon) }}">
                                <span class="text-center">
                                    {{ $category->name }}
                                    <i class="fa fa-caret-down"></i>
                                </span>
                            </a>
                        </div>
                        <div class="mobile-dropdown-content" tabindex="0">
                            <div class="menu-row">
                                <div class="row g-0">
                                    <div class="col-12">
                                        <div class="menu-items">
                                            <div class="category-item" tabindex="0">



                                                @foreach ($category->childrens as $lvl_two)
                                                    @if (count($lvl_two->childrens) > 0)
                                                        <div class="mobile-menu-dropdown" tabindex="0">
                                                            <div class="mobile-dropbtn">
                                                                <a href="#" onclick="return false;">

                                                                    <span class="text-center">
                                                                        {{ $lvl_two->name }}
                                                                        <i class="fa fa-caret-down"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div class="mobile-dropdown-content" tabindex="0">
                                                                <div class="menu-row">
                                                                    <div class="row g-0">
                                                                        <div class="col-12">
                                                                            <div class="menu-items">
                                                                                <div class="category-item"
                                                                                    tabindex="0">



                                                                                    @foreach ($lvl_two->childrens as $lvl_three)
                                                                                        <div
                                                                                            class="category-title[{{ $lvl_three->id }}]">

                                                                                            <a
                                                                                                href="{{ route('categories.show', ['category' => $lvl_three->slug]) }}">{{ $lvl_three->name }}</a>

                                                                                        </div>
                                                                                    @endforeach


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="category-title[{{ $lvl_two->id }}]">

                                                            <a
                                                                href="{{ route('categories.show', ['category' => $lvl_two->slug]) }}">{{ $lvl_two->name }}</a>

                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </nav>

        </div>
    </div>
    <nav class="mobile-menu    ">

        {{-- <div class="d-flex flex-row align-content-center justify-content-between align-items-center">
        <a class="btn  text-bg-light p-1" data-bs-toggle="offcanvas" href="#offcanvasExample"
                role="button" aria-controls="offcanvasExample">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                  </svg>
                
                  
                </a>
                
        <div>
            <a href="{{ route('home') }}"><img src="{{ url('main/logo.png') }}" class="logo"></a>
        </div>
        <div class="mobile-menu-profile">
            <div style="">
                

                
                <a >

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                        class="bi bi-heart" viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                    </svg> 
                </a>

                <a href="{{ route('user.dashboard') }}" class="b">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg>


                    </a>
                
            </div>
        </div>
    </div> --}}

        <div class="container  ">


            @include('layouts.home.header.mobilesearch')

        </div>
        <div id="searchResult2" 
            style="   "
            class="col-12 mobile-header-search">

        </div>
    </nav>
</div>
