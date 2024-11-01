<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>اینستابرق</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="shortcut icon" href="{{ url('main/logo.png') }}">
    <link rel="stylesheet" href="{{ url('main/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('main/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ url('main/css/tabsstyle.css') }}">

    <link rel="stylesheet" href="{{ url('main/css/owl.carousel.min.css') }}">

    <script type="text/javascript" src="{{ url('main/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ url('main/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('main/js/owl.autoplay.js') }}"></script>

    <style>
        .normalFont {

            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        
    </style>

 
</head>


<!--شروع هدر-->
<header>

    <!--شروع ناوبار-->
    <nav class="rt">
        <div class="main">
            <span class="show-menu right rt-14" id="hiden-menu"
                onclick="document.getElementById('menu-side').style.display='block';document.getElementById('show-menu').style.display='block';document.getElementById('hiden-menu').style.display='none';"><i
                    class="fa fa-align-center right"></i> منوی سایت</span>
            <span class="show-menu right rt-14" id="show-menu"
                onclick="document.getElementById('menu-side').style.display='none';document.getElementById('show-menu').style.display='none';document.getElementById('hiden-menu').style.display='block';"><i
                    class="fa fa-close right"></i> منوی سایت</span>
            {{-- <ul class="right rt-13" id="menu-side">
                <li class="right"><a href="" class="start">شروع کنید</a>
                    <ul class="right rt-13">
                        <li class="rt"><a href="how-to-buy.html"><i class="fa fa-circle"></i> خریدار هستید؟</a></li>
                        <li class="rt"><a href="how-to-sell.html"><i class="fa fa-circle"></i> فروشنده هستید؟</a>
                        </li>
                        <li class="rt"><a href="affiliate.html"><i class="fa fa-circle"></i> بازاریاب هستید؟</a>
                        </li>
                    </ul>
                </li>
                <li class="right"><a href="about.html">درباره ما</a></li>
                <li class="right suber"><a href="" class="subewr"> قوانین مارکت<i
                            class="fa fa-angle-down"></i></a>
                    <ul class="right rt-13">
                        <li class="rt"><a href="user-guide.html"><i class="fa fa-circle"></i> قوانین خرید محصول</a>
                        </li>
                        <li class="rt"><a href="user-guide.html"><i class="fa fa-circle"></i> قوانین بازاریابی</a>
                        </li>
                        <li class="rt"><a href="license.html"><i class="fa fa-circle"></i> مجوزهای انتشار</a></li>
                    </ul>
                </li>

                <li class="right"><a href="faq.html">سوالات متداول</a></li>
                <li class="right"><a href="blog.html">وبلاگ</a></li>
                <li class="right"><a href="logo.html">لوگو</a></li>
                <li class="right"><a href="affiliate.html">بازاریابی</a></li>
                <li class="right"><a href="contact.html">تماس با ما</a></li>

                <li class="right suber"><a href="index.html" class="subewr">صفحات <i class="fa fa-angle-down"></i></a>
                    <ul class="right rt-13">
                        <li class="rt"><a href="payment.html"><i class="fa fa-circle"></i> پرداخت آنلاین</a></li>
                        <li class="rt"><a href="changelog.html"><i class="fa fa-circle"></i> پیشرفت ها</a></li>
                        <li class="rt"><a href="basket-1.html"><i class="fa fa-circle"></i> سبد خرید</a></li>
                        <li class="rt"><a href="page.html"><i class="fa fa-circle"></i> برگه خالی</a></li>
                        <li class="rt"><a href="my-account.html"><i class="fa fa-circle"></i> حساب کاربری</a></li>
                        <li class="rt"><a href="404.html"><i class="fa fa-circle"></i> صفحه 404</a></li>
                        <li class="rt"><a href="tab.html"><i class="fa fa-circle"></i> صفحه تب دار</a></li>
                        <li class="rt"><a href="my-account.html"><i class="fa fa-circle"></i> حساب کاربری</a></li>
                        <li class="rt"><a href="commnet.html"><i class="fa fa-circle"></i> صفحه دیدگاه ها</a></li>
                    </ul>

                <li class="right suber"><a href="index.html" class="subewr">زیرمنو <i class="fa fa-angle-down"></i></a>
                    <ul class="right rt-13">
                        <li class="rt"><a href="#"><i class="fa fa-circle"></i> عنوان زیر منو یک</a></li>
                        <li class="rt"><a href="#"><i class="fa fa-circle"></i> عنوان زیر منو دو</a></li>
                        <li class="rt"><a href="#"><i class="fa fa-circle"></i> عنوان زیر منو سه</a></li>
                        <li class="rt"><a href="#"><i class="fa fa-circle"></i> عنوان زیر منو چهار</a></li>
                        <li class="rt"><a href="#"><i class="fa fa-circle"></i> عنوان زیر منو پنج</a></li>
                    </ul>

                <li class="right"><a href="panel.html">پنل کاربری</a></li>

            </ul> --}}
            {{-- <div class="panel-link h-c-panel left rt-13" style="display:none">
                <div class="h-panel right">
                    <div class="right brief"><i class="fa fa-user"></i> <span>حمید جلیلیان</span> <i
                            class="fa fa-money"></i> <b>1400</b> تومان</div>
                    <div class="h-panel-links rt rt-12">
                        <a href="#" class="right">پیشخوان <i class="fa fa-desktop left"></i></a>
                        <a href="#" class="right">پروفایل کاربری <i class="fa fa-id-card-o left"></i></a>
                        <a href="#" class="right">دانلود ها <i class="fa fa-download left"></i></a>
                        <a href="#" class="right">بازاریابی <i class="fa fa-users left"></i></a>
                        <a href="#" class="right">علاقه مندی ها <i class="fa fa-heart left"></i></a>
                        <a href="#" class="right">تنظیمات کاربری <i class="fa fa-cogs left"></i></a>
                        <a href="#" class="right">شرح عملکرد <i class="fa fa-file-text-o left"></i></a>
                        <a href="#" class="right">تسویه حساب <i class="fa fa-money left"></i></a>
                        <a href="#" class="right">ارسال محصول <i class="fa fa-send-o left"></i></a>
                        <a href="#" class="right">درخواست پشتیبانی <i class="fa fa-support left"></i></a>
                    </div>
                </div>
                <a href="#" class="right sing-out"><i class="fa fa-power-off"></i> خروج </a>
            </div> --}}

            <div class="panel-link left rt-13">
                <a href="https://webresan.com/new/" class="mon left"><i class="fa fa-money"></i> کسب درآمد</a>
                <a href="https://webresan.com/new/my-account/" class="log left"><i class="fa fa-sign-in"></i> ورود
                    مشتریان</a>
                <a href="https://webresan.com/new/register/" class="reg left"><i class="fa fa-user-plus"></i> ثبت
                    نام</a>
            </div>

        </div>
    </nav>
    <div class="main">

        <!--شروع لوگو سایت-->
        <a href="index.html"><img src="main/logo.png" class="right logo"></a>
        <!--پایان لوگو سایت-->

        <!--شروع ایکون های دسترسی سریع-->
        <form action="category.html">
            <div class="search rt-center">
                <input class="right rt-16" name="s" placeholder="نام قالب، موضوع یا عبارت دلخواه"
                    autocomplete="off" data-baseurl="/" type="text">
                <button class="left rt-18"></button>
            </div>
            <div class="example rt-13"></div>
        </form>
        <br>
        <!--پایان ایکون های دسترسی سریع-->
        <div class="main">
            <div class="right category instarang">

                <span class="show-cat1 right rt-14" id="hiden-cat1"
                    onclick="document.getElementById('category-side1').style.display='block';document.getElementById('show-cat1').style.display='block';document.getElementById('hiden-cat1').style.display='none';"><i
                        class="fa fa-list-ul right"></i> مشاهده دسته بندی</span>
                <span class="show-cat1 right rt-14" id="show-cat1"
                    onclick="document.getElementById('category-side1').style.display='none';document.getElementById('show-cat1').style.display='none';document.getElementById('hiden-cat1').style.display='block';"><i
                        class="fa fa-close right"></i> بستن دسته بندی</span>
                <ul class="right rt-category" id="category-side1">
                    <li class="link right"><a href="#" class="right rt-13 name navclass">صفحه اصلی</a>
                    <li class="link-big right"><a href="#" class="right rt-13 name navclass">محصولات</a>
                    <li class="link right"><a href="category.html" class="right rt-13 name navclass">فروشگاه</a>
                    <li class="link right"><a href="category.html" class="right rt-13 name navclass">برندها</a>
                    <li class="link right"><a href="category.html" class="right rt-13 name navclass">مجله اینستابرق</a>
                    <li class="link right"><a href="category.html" class="right rt-13 name navclass">سوالات متداول</a>
                    <li class="link right"><a href="#" class="right rt-13 name navclass">شرایط و قوانین</a>
                    <li class="link right"><a href="#" class="right rt-13 name navclass">درباره ما</a>
                    <li class="link right"><a href="#" class="right rt-13 name navclass">تماس باما</a>
                </ul>

                <!--شروع قیمت-->
                <span class="left shoping"><i class="fa fa-shopping-cart"></i>
                    <div>۰</div> تومان
                </span>
                <!--پایان قیمت-->

            </div>
        </div>
    </div>
    <!--پایان دسته بندی-->
    <!--پایان ناوبار-->



    <br><br>
    <!--شروع دسته بندی-->
    <div class="main">
        <div class="right category">
            <span class="show-cat right rt-14" id="hiden-cat"
                onclick="document.getElementById('category-side').style.display='block';document.getElementById('show-cat').style.display='block';document.getElementById('hiden-cat').style.display='none';"><i
                    class="fa fa-list-ul right"></i> مشاهده دسته بندی</span>
            <span class="show-cat right rt-14" id="show-cat"
                onclick="document.getElementById('category-side').style.display='none';document.getElementById('show-cat').style.display='none';document.getElementById('hiden-cat').style.display='block';"><i
                    class="fa fa-close right"></i> بستن دسته بندی</span>
            <ul class="right rt-category" id="category-side">




                <li class="link-big ">
                    <div class="h-icons right"><a href="#" class="right rt-13 name "><img
                                class="d-block w-100" src="main/cable-mn.png" height="100%"><span class="rt-14">
                                سیم و کابل وتجهیزات<i class="fa fa-caret-down"></i></span></a><span
                            class="left rt-13 open">باز کردن</span></div>
                    {{-- شروع زیر منو --}}
                    <ul class="big rt rt-13">

                        <div class="widgets right">
                            <a href="category.html" class="right">
                                <h6 class="right rt-18">سیم</h6><span class="rt rt-13">پرفروشترین محصولات سه ماه
                                    اخیر</span>
                            </a>
                            <a href="category.html" class="right">
                                <h6 class="right rt-18">اتصالات سیم و کابل</h6><span class="rt rt-13">محصولات با
                                    امکانات و طراحی بی‌نظیر</span>
                            </a>
                            <a href="category.html" class="right">
                                <h6 class="right rt-18"> داکت برق و متعلقات</h6><span class="rt rt-13">محصولات ویژه یک
                                    سال اخیر</span>
                            </a>
                            <a href="category.html" class="right">
                                <h6 class="right rt-18">سرکابل و مفصل</h6><span class="rt rt-13">پرفروشترین‌های ۲ سال
                                    اخیر</span>
                            </a>
                            <a href="category.html" class="right">
                                <h6 class="right rt-18">سینی و نردبان کامل</h6><span class="rt rt-13">پرفروشترین‌های ۲
                                    سال اخیر</span>
                            </a>
                            <a href="category.html" class="right">
                                <h6 class="right rt-18">کابل</h6><span class="rt rt-13">پرفروشترین‌های ۲ سال
                                    اخیر</span>
                            </a>
                            <a href="category.html" class="right">
                                <h6 class="right rt-18">لوله برق و متعلقات</h6><span class="rt rt-13">پرفروشترین‌های ۲
                                    سال اخیر</span>
                            </a>
                        </div>
                    </ul>

        </div>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        <li class="right"><a href="category.html"><i class="fa fa-angle-left"></i> زیر مجموعه دسته بندی</a></li>
        </li>
        {{-- پایان زیرمنو --}}

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/lustre-min.png" height="100%"><span class="rt-14">لوستر وآباژور<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>
        </li>

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/lamp-min.png" height="100%"><span class="rt-14">تحهیزات روشنایی<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>

        </li>

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/highlight1-min.png" height="100%"><span class="rt-14">لوازم الکتریکی<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>

        </li>

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/contactor-min.png" height="100%"><span class="rt-14">برق صنعتی<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>

        </li>

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/penommatic1-min.png" height="100%"><span class="rt-14">هیدرولیک وپنوماتیک<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>

        </li>

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/cctv-min.png" height="100%"><span class="rt-14">نظارتی و حفاظتی<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>

        </li>

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/network-min.png" height="100%"><span class="rt-14">شبکه و مخابرات<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>

        </li>

        <li class="link-big ">
            <div class="h-icons right"><a href="#" class="right rt-13 name "><img class="d-block w-100"
                        src="main/hihjpower-min.png" height="100%"><span class="rt-14">فشار قوی ومتوسط<i
                            class="fa fa-caret-down"></i></span></a><span class="left rt-13 open">باز کردن</span>
            </div>

        </li>



        </ul>

    </div>
    <!--پایان دسته بندی-->

    </div>

</header>


@yield('content')
