@extends('admin.layouts.admin')

@section('title')
    edit setting
@endsection


<style>
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

    input:checked+.round {
        background-color: rgb(85, 21, 138);
    }

    input:focus+.round {
        box-shadow: 0 0 1px rgb(255, 77, 211);
    }

    input:checked+ :before {
        transform: translateX(26px);
    }

    .round {
        border-radius: 34px;
    }

    .round:before {
        border-radius: 50%;
    }

    .set_title {
        padding: 5px;
        width: 20%;
    }
</style>

@section('content')
    @php
        $setting2 = App\Models\Admin\Setting::first();

    @endphp

    @if (Session::has('msg'))
        <div class="alert alert-info">
            {{ Session::get('msg') }}
        </div>
    @endif
    <!-- Content Row -->
    <div class="row">




        <form method="POST" id="settingForm" action="{{ route('admin.settindDetail.setting.update') }}"
            class="col-md-6 mb-4 p-4 bg-white">

            @csrf
            <div class="bg-info-subtle p-2 mb-3 rounded">
                <h3>تنظیمات اینستابرق</h3>

                <div class="row">





                    <div class=" col-6" style="display: flex;">
                        <div class=" col-8 set_title ">

                            <a href="{{ route('admin.sliderss.index') }}">

                                <strong style="font-size: 14px">اسلایدر ها</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="sliders" type="checkbox" @if ($setting->sliders) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>


                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">


                            <strong style="font-size: 14px;"> <a href="{{ route('admin.settindDetail.gifs') }}"> گیف ۱
                                </a></strong>


                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="gif1" type="checkbox" @if ($setting->gif1) checked @endif>
                                <span class="round"></span>
                            </label>


                        </div>
                    </div>


                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">


                            <strong style="font-size: 14px;"> <a
                                    href="{{ route('admin.settindDetail.gifs') }}">گیف۲</a></strong>


                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="gif2" type="checkbox" @if ($setting->gif2) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>


                    <div class="col-6" style="display: flex;">
                        <div class=" col-8 set_title">

                            <a href="{{ route('admin.stories.index') }}">

                                <strong style="font-size: 14px;">استوری ها</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="stories" type="checkbox" @if ($setting->stories) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a href="{{ route('admin.brands.index') }}">

                                <strong style="font-size: 14px;">برند ها</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="brands" type="checkbox" @if ($setting->brands) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <strong style="font-size: 14px;">شمارنده ها</strong>

                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="counters" type="checkbox" @if ($setting->counters) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">





                            <a href="{{ route('admin.settindDetail.EditHomeCounts') }}">
                                <strong style="font-size: 14px;">محصولات ها

                                </strong>
                            </a>





                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="products" type="checkbox" @if ($setting->products) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">



                            <a href="{{ route('admin.settindDetail.EditHomeCounts') }}">
                                <strong style="font-size: 14px;">فروشگاه ها
                                </strong>
                            </a>

                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="vendors" type="checkbox" @if ($setting->vendors) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">


                            <strong style="font-size: 14px;"> 1لینک های داخلی</strong>

                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="insid_links" type="checkbox" @if ($setting->insid_links) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>
                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">


                            <strong style="font-size: 14px;"> 2 لینک های داخلی </strong>

                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="links" type="checkbox" @if ($setting->links) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>
                    <div class="col-6 " style="display: flex;">
                        <div class="col-8 set_title  ">


                            <strong style="font-size: 14px;">مجله اینستابرق</strong>

                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="articles" type="checkbox" @if ($setting->articles) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>
                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a href="{{ route('admin.settindDetail.SiteAdds.edit') }}">

                                <strong style="font-size: 14px;"> بنر ها</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="articles" type="checkbox" @if ($setting->articles) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>





                </div>
            </div>
            <div class="bg-warning-subtle p-2 rounded">
                <h3> تنظیمات پنل کاربران
                </h3>
                <div class="row">



                    <hr>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a>

                                <strong style="font-size: 14px;"> تبلیغ فروشگاه</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="usersUpgradeVendor" type="checkbox"
                                    @if ($setting->usersUpgradeVendor) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6 " style="display: flex;">
                        <div class="col-8 set_title">

                            <a>

                                <strong style="font-size: 14px;"> ارسال اسلایدر</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="usersSendSlider" type="checkbox"
                                    @if ($setting->usersSendSlider) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a>

                                <strong style="font-size: 14px;"> ارسال استوری</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="usersSendStory" type="checkbox"
                                    @if ($setting->usersSendStory) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a>

                                <strong style="font-size: 14px;"> تبلیغ کالا </strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="usersUpgradeProduct" type="checkbox"
                                    @if ($setting->usersUpgradeProduct) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>
                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a>

                                <strong style="font-size: 14px;"> نردبان فروشگاه</strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="usersLaddelV" type="checkbox"
                                    @if ($setting->usersLaddelV) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>
                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a>

                                <strong style="font-size: 14px;"> نردبان محصول </strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="usersLaddelP" type="checkbox"
                                    @if ($setting->usersLaddelP) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a href="{{ route('admin.settindDetail.subtitle') }}">

                                <strong style="font-size: 14px;"> متن زیرنویس </strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="subtitle_status" type="checkbox"
                                    @if ($setting->subtitle_status) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>







                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a href="{{ route('admin.settindDetail.subtitle') }}">

                                <strong style="font-size: 14px;"> لینک آپارات محصول </strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="aparat_product" type="checkbox"
                                    @if ($setting->aparat_product) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>

                    <div class="col-6" style="display: flex;">
                        <div class="col-8 set_title">

                            <a href="{{ route('admin.settindDetail.subtitle') }}">

                                <strong style="font-size: 14px;"> لینک آپارات فروشگاه </strong>
                            </a>
                        </div>
                        <div class="">

                            <label class="switch">
                                <input name="aparat_vendor" type="checkbox"
                                    @if ($setting->aparat_vendor) checked @endif>
                                <span class="round"></span>
                            </label>

                        </div>
                    </div>








                </div>

            </div>
            <input type="submit" value="تایید" class="btn btn-success my-3 w-100 btn-block">






        </form>

        <div class="col-md-6  bg-white text-center" style="">

            <div class="row g-4 ">
                <a class="btn btn-outline-dark col-6 " href="{{ route('admin.settindDetail.SiteAdds.edit') }}">ویرایش تبلیغات
                    سایت</a>

                <a href="{{ route('admin.settindDetail.dargahSettingPage') }}" class="btn btn-outline-dark col-6 ">
                    تنظیمات
                    درگاه
                    پرداخت</a>

                <a href="{{ route('admin.settindDetail.picturesBookMarkets') }}"
                    class="btn btn-outline-dark col-6">کتابخانه
                    سایت</a>


                <a href="{{ route('admin.odderCodes.index') }}" class="btn btn-outline-dark col-6"> کد تخفیف ها </a>

                <a href="{{ route('admin.settindDetail.questions') }}" class="btn btn-outline-dark col-6">ویرایش سوالات
                    متداول
                </a>

                <a href="{{ route('admin.settindDetail.contact') }}" class="btn btn-outline-dark col-6">ویرایش تماس با
                    ما</a>

                <a href="{{ route('admin.settindDetail.laws') }}" class="btn btn-outline-dark col-6">ویرایش شرایظ و
                    قوانین</a>


                <a href="{{ route('admin.settindDetail.aboute') }}" class="btn btn-outline-dark col-6">ویرایش درباره
                    ما</a>


                <a href="{{ route('admin.settindDetail.ways') }}" class="btn btn-outline-dark col-6">ویرایش راه های
                    ارتباطی و
                    شبکه
                    های اجتماعی</a>


                <a href="{{ route('admin.settindDetail.footer') }}" class="btn btn-outline-dark col-6">ویرایش فوتر</a>




                <a style="" href="{{ route('admin.settindDetail.vendorPageGuid') }}"
                    class="btn btn-outline-dark col-6">
                    صفحه
                    ({{ $setting2->guidVTitle }}) </a>

                <a href="{{ route('admin.settindDetail.productPageGuid') }} " class="btn btn-outline-dark col-6"> صفحه
                    ({{ $setting2->guidPTitle }})</a>

                <a href="{{ route('admin.settindDetail.bugGiud') }} " class="btn btn-outline-dark col-6"> صفحه
                    ({{ $setting2->guidBuyTitle }})</a>


                <a href="{{ route('admin.settindDetail.Add') }} " class="btn btn-outline-dark col-6"> صفحه( تبلیغات )</a>
            </div>




        </div>
    </div>
@endsection
