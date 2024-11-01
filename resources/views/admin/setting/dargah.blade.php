@extends('admin.layouts.admin')

@section('title')
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    ایا از ثبت اطلاعات اطمینان دارید؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
                    <button type="button" onclick="$('#form').submit()" class="btn btn-primary">بله</button>
                </div>
            </div>
        </div>
    </div>


    <h1>
        تنظیمات درگاه پرداخت
    </h1>



    <form action="{{ route('admin.settindDetail.dargahUpdate') }}" id="form" method="post">

        @csrf

        <div class="col-12">

            <a href="{{ route('admin.settindDetail.index') }}" class="btn btn-secondary" style="float: left;">بازگشت</a>
            <!-- Button trigger modal -->
            <button style="float:left;" type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#exampleModal">
                تایید
            </button>
        </div>



        <div class="col-12" style="display: flex;">

            @if (Session::has('amountErr'))
                <div class="alert alert-danger">
                    {{ Session::get('amountErr') }}

                    ، باید یا 0 و یا بزرگتر از 1000 باشند.
                </div>
            @endif
            <div class="col-8 set_title">


                <h4> <a href="">وضعیت کلی درگاه پرداخت</a></h4>


            </div>
            <div class="">

                <label class="switch">
                    <input name="paymentStatus" type="checkbox" @if ($setting->paymentStatus) checked @endif>
                    <span class="round"></span>
                </label>

            </div>
        </div>

        <hr style="color:red;">

        سایر موارد

        <hr>

        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">


                <h4> <a href="">درگاه پرداخت برای استوری ها</a></h4>


            </div>
            <div class="">

                <label class="switch">
                    <input name="storyPayStatus" type="checkbox" @if ($setting->storyPayStatus) checked @endif>
                    <span class="round"></span>
                </label>

            </div>
        </div>
        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">




                <input name="storyPay" type="text" class="form-control" value="{{ $setting->storyPay }}">

            </div>



        </div>



        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">

                <h4> <a href="">درگاه پرداخت برای اسلایدر ها</a></h4>


            </div>
            <div class="">

                <label class="switch">
                    <input name="SliderPayStatus" type="checkbox" @if ($setting->SliderPayStatus) checked @endif>
                    <span class="round"></span>
                </label>

            </div>
        </div>

        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">





                <div class="row">

                    <div class="form-group">

                        یک ماهه
                        <input name="SliderPay" type="text" class="form-control" value="{{ $setting->SliderPay }}">

                    </div>
                    <div class="form-group">

                        سه ماهه
                        <input name="SliderPayThree" type="text" class="form-control"
                            value="{{ $setting->SliderPayThree }}">

                    </div>
                    <div class="form-group">

                        شش ماهه
                        <input name="SliderPaySix" type="text" class="form-control" value="{{ $setting->SliderPaySix }}">

                    </div>
                    <div class="form-group">

                        یکساله
                        <input name="SliderPayYear" type="text" class="form-control"
                            value="{{ $setting->SliderPayYear }}">

                    </div>

                </div>

            </div>
        </div>


        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">



                <h4> <a href="">درگاه پرداخت برای ارسال فروشگاه به صفحه اول</a></h4>


            </div>
            <div class="">

                <label class="switch">
                    <input name="SpcVPayStatus" type="checkbox" @if ($setting->SpcVPayStatus) checked @endif>
                    <span class="round"></span>
                </label>

            </div>
        </div>

        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">






                <div class="row">

                    <div class="form-group">

                        یک ماهه
                        <input name="SpcVPay" type="text" class="form-control" value="{{ $setting->SpcVPay }}">

                    </div>
                    <div class="form-group">

                        سه ماهه
                        <input name="SpcVPayThree" type="text" class="form-control"
                            value="{{ $setting->SpcVPayThree }}">

                    </div>
                    <div class="form-group">

                        شش ماهه
                        <input name="SpcVPaySix" type="text" class="form-control"
                            value="{{ $setting->SpcVPaySix }}">

                    </div>
                    <div class="form-group">

                        یکساله
                        <input name="SpcVPayYear" type="text" class="form-control"
                            value="{{ $setting->SpcVPayYear }}">

                    </div>

                </div>


            </div>
        </div>

        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">


                <h4> <a href="">درگاه پرداخت برای ارسال محصول به صفحه اول</a></h4>


            </div>
            <div class="">

                <label class="switch">
                    <input name="SpcPPayStatus" type="checkbox" @if ($setting->SpcPPayStatus) checked @endif>
                    <span class="round"></span>
                </label>

            </div>
        </div>

        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">







                <div class="row">

                    <div class="form-group">

                        یک ماهه
                        <input name="SpcPPay" type="text" class="form-control" value="{{ $setting->SpcPPay }}">

                    </div>
                    <div class="form-group">

                        سه ماهه
                        <input name="SpcPPayThree" type="text" class="form-control"
                            value="{{ $setting->SpcPPayThree }}">

                    </div>
                    <div class="form-group">

                        شش ماهه
                        <input name="SpcPPaySix" type="text" class="form-control"
                            value="{{ $setting->SpcPPaySix }}">

                    </div>
                    <div class="form-group">

                        یکساله
                        <input name="SpcPPayYear" type="text" class="form-control"
                            value="{{ $setting->SpcPPayYear }}">

                    </div>

                </div>


            </div>
        </div>

        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">


                <h4> <a href="">درگاه پرداخت برای نردبان محصول</a></h4>


            </div>
            <div class="">

                <label class="switch">
                    <input name="LadderPPayStatus" type="checkbox" @if ($setting->LadderPPayStatus) checked @endif>
                    <span class="round"></span>
                </label>

            </div>
        </div>


        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">





                <input name="ladderPPay" type="text" class="form-control" value="{{ $setting->ladderPPay }}">



            </div>
        </div>

        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">


                <h4> <a href="">درگاه پرداخت برای نردبان فروشگاه</a></h4>


            </div>
            <div class="">

                <label class="switch">
                    <input name="ladderVPayStatus" type="checkbox" @if ($setting->ladderVPayStatus) checked @endif>
                    <span class="round"></span>
                </label>

            </div>
        </div>


        <div class="col-12" style="display: flex;">
            <div class="col-8 set_title">





                <input name="ladderVPay" type="text" class="form-control" value="{{ $setting->ladderVPay }}">

            </div>
        </div>





    </form>
@endsection
