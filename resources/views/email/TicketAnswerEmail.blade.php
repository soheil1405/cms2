@extends('email.layouts.master')

@section('title', 'mail')

@push('header_styles')
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
@endpush

@push('header_styles')
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS -->
    <meta name="format-detection" content="address=no"> <!-- disable auto address linking in iOS -->
    <meta name="format-detection" content="email=no"> <!-- disable auto email linking in iOS -->
    <meta name="author" content="Simple-Pleb.com">

    <style type="text/css">
        /*Basics*/
        body {
            margin: 0px !important;
            padding: 0px !important;
            display: block !important;
            min-width: 100% !important;
            width: 100% !important;
            -webkit-text-size-adjust: none;
        }

        table {
            border-spacing: 0;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        table td {
            border-collapse: collapse;
            mso-line-height-rule: exactly;
        }

        td img {
            -ms-interpolation-mode: bicubic;
            width: auto;
            max-width: auto;
            height: auto;
            margin: auto;
            display: block !important;
            border: 0px;
        }

        td p {
            margin: 0;
            padding: 0;
        }

        td div {
            margin: 0;
            padding: 0;
        }

        td a {
            text-decoration: none;
            color: inherit;
        }

        /*Outlook*/
        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: inherit;
        }

        .ReadMsgBody {
            width: 100%;
            background-color: #ffffff;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /*Gmail blue links*/
        u+#body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }

        /*Buttons fix*/
        .undoreset a,
        .undoreset a:hover {
            text-decoration: none !important;
        }

        .yshortcuts a {
            border-bottom: none !important;
        }

        .ios-footer a {
            color: #aaaaaa !important;
            text-decoration: none;
        }

        /*Responsive*/
        @media screen and (max-width: 799px) {
            table.row {
                width: 100% !important;
                max-width: 100% !important;
            }

            td.row {
                width: 100% !important;
                max-width: 100% !important;
            }

            .img-responsive img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin: auto;
            }

            .center-float {
                float: none !important;
                margin: auto !important;
            }

            .center-text {
                text-align: center !important;
            }

            .container-padding {
                width: 100% !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .container-padding10 {
                width: 100% !important;
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            .hide-mobile {
                display: none !important;
            }

            .menu-container {
                text-align: center !important;
            }

            .autoheight {
                height: auto !important;
            }

            .m-padding-10 {
                margin: 10px 0 !important;
            }

            .m-padding-15 {
                margin: 15px 0 !important;
            }

            .m-padding-20 {
                margin: 20px 0 !important;
            }

            .m-padding-30 {
                margin: 30px 0 !important;
            }

            .m-padding-40 {
                margin: 40px 0 !important;
            }

            .m-padding-50 {
                margin: 50px 0 !important;
            }

            .m-padding-60 {
                margin: 60px 0 !important;
            }

            .m-padding-top10 {
                margin: 30px 0 0 0 !important;
            }

            .m-padding-top15 {
                margin: 15px 0 0 0 !important;
            }

            .m-padding-top20 {
                margin: 20px 0 0 0 !important;
            }

            .m-padding-top30 {
                margin: 30px 0 0 0 !important;
            }

            .m-padding-top40 {
                margin: 40px 0 0 0 !important;
            }

            .m-padding-top50 {
                margin: 50px 0 0 0 !important;
            }

            .m-padding-top60 {
                margin: 60px 0 0 0 !important;
            }

            .m-height10 {
                font-size: 10px !important;
                line-height: 10px !important;
                height: 10px !important;
            }

            .m-height15 {
                font-size: 15px !important;
                line-height: 15px !important;
                height: 15px !important;
            }

            .m-height20 {
                font-size: 20px !important;
                line-height: 20px !important;
                height: 20px !important;
            }

            .m-height25 {
                font-size: 25px !important;
                line-height: 25px !important;
                height: 25px !important;
            }

            .m-height30 {
                font-size: 30px !important;
                line-height: 30px !important;
                height: 30px !important;
            }

            .rwd-on-mobile {
                display: inline-block !important;
                padding: 5px;
            }

            .center-on-mobile {
                text-align: center !important;
            }
        }
    </style>
@endpush

@push('contents')


    @if ($details['username'] == 'guest')
        <div class="col-12">

            <div class="col-12">

                {{ $details['ticketSubject'] }}

                <br>

                <small>
                    {{ $details['ticketMassage'] }}
                </small>
            </div>

            <hr>
            <div class="col-12">

                
                <strong>
                    <p>

                        {{ $details['massage'] }}

                    </p>
                </strong>
            </div>

            تیم پشتیبانی اینستابرق

            <hr>

            <a href="https://instabargh.com/">instabargh.com</a>

        </div>
    @else
        <div class="">
            کاربر گرامی
            {{ $details['username'] }}
            تیکت ارسالی شما در سایت اینستابرق توسط تیم پشتیبانی سایت اینستابرق پاسخ داده شد
            <hr>
            وارد پنل کاربری خود شوید و پاسخ تیکیت خود را ببینید ...
            <hr>
            تیم پشتیبانی اینستابرق

            <hr>

            <a href="https://instabargh.com/vendor-dashboard/tickets"> instabargh.com/tickets </a>

        </div>
    @endif


@endpush
