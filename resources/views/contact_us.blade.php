<?php

$_SESSION['page'] = 'contact_us';

?>





@extends('master')

@section('title', 'تماس با ما')

@section('description', 'اینستابرق - اولین و تنهاترین شبکه ی اجتماعی تخصصی بازار صنعت برق ، لوستر و روشنایی ایران | تماس
    با ما : ۰۹۳۶۲۴۵۴۶۳۵ - ۰۲۱۳۶۶۱۶۶۸۰ آدرس : تهران لاله زارنو کوچه امین زاده پلاک 20')

    @push('header_styles')
        @include('layouts.home.header.styles')
    @endpush


    @push('header_scripts')
        @include('layouts.home.header.scripts')

        <script>
            window.addEventListener('scroll', function() {
                if (window.pageYOffset) {
                    $('#toppp').css('display', 'none');
                } else {
                    jQuery('#toppp').css({
                        position: 'fixed',
                        width: 100 % ,
                        z - index: 1000,
                        top: '',
                        display: 'block'
                    });
                }

            })
        </script>
    @endpush


    @push('headers')
        @include('layouts.home.header.head')
    @endpush



    @push('contents')
        <div class="container  ">

            @if (Session::has("success"))
                <div class="alert alert-success">
                    {{ Session::get("success") }}
                </div>
            @endif

            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

            <form method="POST" action="{{route('Sendticket2')}}" class="row justify-content-center border-box-custome  m-3 ">
                @csrf
                <div class=" col-12 img-contact-us text-center">
                    <img src="{{ asset('images/13105774_5143151.png') }}" alt="">
                </div>


                <div class="col-3  mt-3 display-moblie ">
                    <div class=" text-center iransanslight change-size-elements">
                        <div class="background-title">
                            <h3 class=" iransansmedium mb-4 title-color">اطلاعات تماس</h3>
                        </div>
                        <div class="telinfo  secondborderboxinfo mt-3">
                            <div class="imgtel imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-1.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p> {{ $setting_detail->whatsapp }} </p>
                            </div>
                        </div>
                        <div class="telinfo  secondborderboxinfo mt-3">
                            <div class="imgtel imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-1744.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p>{{ $setting_detail->telephone }}</p>

                            </div>
                        </div>

                        <div class="telinfo   secondborderboxinfo mt-3">
                            <div class="imgcontact-size imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-1744.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p>{{ $setting_detail->telephone2 }}</p>
                            </div>
                        </div>
                        <div class="telinfo  secondborderboxinfo mt-3">
                            <div class="imgtel imgemail secondboxshadow">
                                <img src="{{ asset('images/Untitled-11.png') }}" alt="">
                            </div>
                            <div class="infotel infoemail mt-2 contact-style-info">

                                <p> {{ $setting_detail->fax }} </p>
                            </div>
                        </div>


                        <div class="Emailinfo secondborderboxinfo mt-3 ">
                            <div class="email-icon-size imgemail secondboxshadow ">
                                <img src="{{ asset('images/Untitled-17.png') }}" alt="">
                            </div>
                            <div class="infoemail mt-2 custome-margin ">

                                <p>info@instabargh.com</p>
                            </div>
                        </div>
                        <div class="showmap  mt-3">
                            <div class="imgemail secondboxshadow ">
                                <img src="{{ asset('images/Location-icon-design-on-transparent-background-PNG (1)12222.png') }}"
                                    alt="">
                            </div>
                            <div class="infoemail infoemail mt-2 contact-style-info ">

                                <p>آدرس ما :

                                    {{ $setting_detail->address }}

                                </p>
                            </div>
                            <div class=" change-size-elements">
                                <a target="_blank"
                                    href="https://maps.google.com/?q={{ $setting_detail->latitude }},{{ $setting_detail->longitude }}"
                                    role="button"
                                    class="d-block card-link btn btn-outline-primary btn-block footer_masiryabi mb-2">
                                    مسیریابی
                                </a>
                            </div>
                        </div>
                        <p id="ticketError" style=" display: none;">


                            <small id="ticketErrorText">
                            </small>

                        </p>






                    </div>

                </div>




                <div class="col-6 mt-3 display-moblie ">



                    <div class="text-center iransanslight">
                        <div class="background-title">
                            <h3 class="iransansmedium mb-4 title-color">ارسال تیکت</h3>

                        </div>
                        <div id="ticketSuccesss" style="display:none;" class="alert alert-success  iransanslight">


                            تیکت شما با موفقیت ارسال شد



                        </div>




                        <div class="col-12 text-center iransanslight">

                            <input type="text" placeholder="عنوان تیکت :" id="ticketSubject" name="subject" required
                                class="form-control m-1 ticketSubject">

                            @auth

                                <input type="hidden" name="username" class="ticketUsername"
                                    value="{{ Auth::user()->vendor->id }} ">
                                <input type="hidden" name="number" id="Tnumber" value="0{{ Auth::user()->vendor->number }}"
                                    class="ticketUsername_guest">


                                @if (Auth::user()->vendor->socialMedias)
                                    <input type="hidden" name="email" id="ticketEmail"
                                        value="{{ Auth::user()->vendor->socialMedias->email }}"
                                        class="form-control ticketEmail  m-1">
                                @endif

                                {{-- <input type="text" name="number" id="Tnumber2" class="form-control setlocat-textbox" placeholder="شماره تلفن شما : "> --}}

                            @endauth

                            @guest

                                <input type="hidden" name="username" value="guest" class="ticketUsername_guest">

                                <input type="email" placeholder="ایمیل شما :" required value="{{ old('email') }}" name="email" id="ticketEmail"
                                    class="form-control ticketEmail  m-1">
                                <input type="number" min="11" max="11" name="number" id="Tnumber2" class="form-control setlocat-textbox" required
                                    placeholder="شماره تلفن شما : ">

                            @endguest





                            <textarea name="text" cols="30" rows="10" id="ticketText" value="{{ old('text') }}" placeholder="متن تیکت :"
                                class="form-control ticketText"></textarea>


                            <p id="ticketError" style=" display: none;">

                                <small class="text-danger">

                                    *

                                </small>

                                <small id="ticketErrorText">
                                </small>

                            </p>


                        </div>

                        <div class="form-group mt-4 mb-4">
                            <div class="captcha">
                                <span>{!! Captcha::img('flat') !!}</span>
                                <button type="button" class="btn btn-danger" class="reload" onclick="reloadCaptcha()">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">

                                <input style="font-size:14px;" type="text" id="captchainput" value="{{ old('captcha') }}"
                                    placeholder="مقدار فرم اعتبار سنجی را وارد کنید" name="captcha"
                                    class="form-control required">
                                @error('captcha')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button  class="btn btn-primary m-3">ارسال فرم

                            </button>
                        </div>
                    </div>


                </div>


            </form>
        </div>
        @include('home.sections.mobile_buttom_menu')

    @endpush
