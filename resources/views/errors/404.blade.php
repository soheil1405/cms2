<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 page</title>
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
    <style>
        /*======================
    404 page
=======================*/
        @font-face {
            font-family: dastnevis;
            src: url("https://instabargh.com/main/fonts/irdastnevis/IRDastNevis.eot") format("eot"),
                url("https://instabargh.com/main/fonts/irdastnevis/IRDastNevis.woff") format("woff"),
                url("https://instabargh.com/main/fonts/irdastnevis/IRDastNevis.woff2") format("woff2");
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'dastnevis';
        }

        a {
            text-decoration: none !important;
        }

        .page_404 {
            padding: 40px 0;
            background: #fff;

        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {

            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
            background-repeat: no-repeat
        }


        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
        }
    </style>
</head>

<body>

    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-12 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">404</h1>


                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                این صفحه وجود ندارد
                            </h3>

                            <p>برای برگشتن به سایت از دکمه زیر استفاده کنید !</p>

                            <a href="{{ route('home') }}" class=" btn btn-primary"> صفحه اصلی </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
