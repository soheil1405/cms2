<style>
    body {
      
        background-color: #e9ebee;
        direction: rtl;
    }



    .be-comment-block {
        margin-bottom: 50px !important;
        border: 1px solid #edeff2;
        border-radius: 2px;
        padding: 50px 70px;
        border: 1px solid #ffffff;
    }

    .comments-title {
        font-size: 22px;
        color: #262626;
        margin-bottom: 15px;
        font-family: 'Conv_helveticaneuecyr-bold';
    }

    .be-img-comment {
        width: 60px;
        height: 60px;
        float: left;
        margin-bottom: 15px;
    }

    .be-ava-comment {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .be-comment-content {
        margin-left: 80px;
    }

    .be-comment-content span {
        display: inline-block;
        width: 49%;
        margin-bottom: 15px;
    }

    .be-comment-name {
        font-size: 13px;
        font-family: 'Conv_helveticaneuecyr-bold';
    }

    .be-comment-content a {
        color: #383b43;
    }

    .be-comment-content span {
        display: inline-block;
        width: 49%;
        margin-bottom: 15px;
    }

    .be-comment-time {
        text-align: right;
    }

    .be-comment-time {
        font-size: 11px;
        color: #b4b7c1;
    }

    .be-comment-text {
        font-size: 13px;
        line-height: 18px;
        color: #7a8192;
        display: block;
        background: #f6f6f7;
        border: 1px solid #edeff2;
        padding: 15px 20px 20px 20px;
    }

    .form-group.fl_icon .icon {
        position: absolute;
        top: 1px;
        left: 16px;
        width: 48px;
        height: 48px;
        background: #f6f6f7;
        color: #b5b8c2;
        text-align: center;
        line-height: 50px;
        -webkit-border-top-left-radius: 2px;
        -webkit-border-bottom-left-radius: 2px;
        -moz-border-radius-topleft: 2px;
        -moz-border-radius-bottomleft: 2px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }

    .form-group .form-input {
        font-size: 13px;
        line-height: 50px;
        font-weight: 400;

        width: 100%;
        height: 50px;
        padding-left: 20px;
        padding-right: 20px;
        border: 1px solid #edeff2;
        border-radius: 3px;
    }

    .form-group.fl_icon .form-input {
        padding-left: 70px;
    }

    .form-group textarea.form-input {
        height: 150px;
    }





    #commentForm {
        transition: all 0.3s;
    }

    @media screen and (min-width: 0) and (max-width: 750px) {



        .be-comment {
            width: 100%;
        }

        .be-comment-text {
            width: 100%;
        }

        .be-comment-time {
            font-size: 14px;
            margin: 0px;
            padding: 0px;
        }

        .answerBt {

            color: white !important;
            cursor: pointer !important;
            float: left !important;

            font-size: 14px;

        }


        .be-comment-block {
            width: 100% !important;
            padding: 10px !important;
            margin: 0px !important;
        }


    }
</style>


<script>
    function showcommentForm() {
        $('#answerForm').css('height', '0');
        $('#commentForm').css('height', '100%');
        $('#sendCommentBt').css('display', 'none');
        reloadCaptcha();

    }

    function OpenAnswerForm(id) {
        $('#commentForm').css('height', '0');
        // $('#parent_name').val(parent_name);
        $('#answered_to').val(id);
        $('#parent_name').val(id);
        $('#answerForm').css('height', '100%');
        $('#sendCommentBt').css('display', 'block');
        reloadCaptcha();
    }
</script>






<div class="container ">
    <div class="row">
        <div class="col-12 pb-2 pt-2">
            <div style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;        
    "
                class=" biggerFont container be-comment-block" id="alert2">


                @if (session('SaveCommentSuccessfully'))
                    <script>
                        document.getElementById("alert").scrollIntoView();
                    </script>



                    <div class="alert alert-success" id="alert" style="justify-content: center" role="alert">

                        <span>{{ session('SaveCommentSuccessfully') }}</span>

                    </div>
                @endif


                <h3 style="font-family:'dastnevis' !important;" class="h2 comments-title">دیدگاه ها
                    ({{ count($product->commentCounts) }})</h3>
                <div class="be-comment">


                    @foreach ($product->Available_comments as $comment)
                        <div style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;   "
                            class="be-comment-content be-comment-text">

                            <div class="">

                                <a href="" style="font-size: 25px">
                                    @if ($comment->username == $comment->vendor->name)
                                        <img style="width:40px; height:40px !important;"
                                            src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $comment->vendor->avatar) }}"
                                            class=" rounded-circle ">
                                    @elseif($comment->username == 'instabargh')
                                        <img src="{{ url('main/logo.png') }}" style="width:40px; height:40px; "
                                            class="logo">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd"
                                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg>
                                    @endif

                                    {{ $comment->username }}

                                </a>





                                <span
                                    onclick="         $('#addNewBt').css('display', 'block'); OpenAnswerForm({{ $comment->id }})  "
                                    style="color: black; border:1px solid black; " class=" btn   ">
                                    پاسخ

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-reply-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                                    </svg>
                                </span>

                                (
                                {{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($comment->created_at)) }}
                                )


                            </div>


                            <hr>

                            <p style="color: black !important;" class="normalFont be-comment-text biggerFont">

                                {{ $comment->comment }}
                            </p>
                        </div>



                        {{-- javab ha --}}

                        @foreach ($comment->AllAnswers as $answer)
                            <div style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;  
                            
                            margin-right:20%;

                            "
                                class="be-comment-content be-comment-text">

                                <div class="">

                                    <a href="" style="font-size: 25px">

                                        @if ($answer->username == $product->vendor->name)
                                            <img style="width:40px; height:40px !important;"
                                                src="{{ url(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $product->vendor->avatar) }}"
                                                class=" rounded-circle ">
                                        @elseif($answer->username == 'instabargh')
                                            <img src="{{ url('main/logo.png') }}" style="width:40px; height:40px; "
                                                class="logo">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                            </svg>
                                        @endif

                                        {{ $answer->username }}

                                        <small>(در پاسخ به {{ $answer->answered_to_name }})</small>

                                    </a>





                                    <span
                                        onclick="         $('#addNewBt').css('display', 'block'); OpenAnswerForm({{ $answer->id }})  "
                                        style="color: black; border:1px solid black; " class=" btn   ">
                                        پاسخ

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-reply-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                                        </svg>
                                    </span>

                                    ({{ str_replace('پس از', 'پیش', Carbon\Carbon::now()->diffForHumans($answer->created_at)) }})
                                </div>


                                <hr>

                                <p style="color: black !important;" class="normalFont be-comment-text biggerFont">

                                    {{ $answer->comment }}
                                </p>
                            </div>
                        @endforeach
                    @endforeach

                    <br>
                    <hr>
                    <br>


                    @error('captcha')
                        <p class="text-danger">مقدار فرم اعتبار سنجی را به صورت صحیح وارد کنید</p>
                    @enderror
                    <span
                        onclick="$('#commentForm').css('display' , 'block'); $('#addNewBt').css('display' , 'none'); reloadCaptcha();   "
                        id="addNewBt" class="btn btn-success"> افزودن دیدگاه </span>

                    <form id="commentForm" style="height:100%; overflow: hidden; display:none;" method="POST"
                        action="{{ route('saveProductComment') }}" class="form-block">

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="vendor_id" value="{{ $product->vendor->id }}">

                        @csrf
                        <div class="row">

                            @guest
                                <div class="col-xs-12 col-md-12 " style="display: flex;">


                                    <input id="writerAnswerName" name="username" class=" form-control m-1" type="text"
                                        required
                                        style="font-family: Arial, Helvetica, sans-serif !important;   font-size: 14px !important; text-color:bla"
                                        placeholder="نام">
                                    <input name="email" class=" form-control  m-1" type="email"
                                        style="font-family: Arial, Helvetica, sans-serif !important;   font-size: 14px !important; text-color:bla"
                                        id="writerAnswerName" required placeholder="ایمیل " required>


                                </div>


                                <div class="col-xs-12 col-md-12 " style="display: flex;">


                                    <input name="number" class=" form-control m-1" type="number"
                                        style="font-family: Arial, Helvetica, sans-serif !important;   font-size: 14px !important; text-color:bla"
                                        id="writerAnswerName" required
                                        placeholder="شماره تلفن (نمایش داده نمیشود و جهت ارتباط ادمین با شما می باشد) ">

                                </div>
                            @endguest


                            @auth

                                <input id="writerAnswerName" name="username" class=" form-control m-1" type="hidden"
                                    value="{{ Auth::user()->name }}">
                                @if (Auth::user()->vendor->socialMedias)
                                    <input name="email" value="{{ Auth::user()->vendor->socialMedias->email }}"
                                        class=" form-control  m-1" type="hidden" id="writerAnswerName">
                                @endif


                                <div class="col-xs-12 col-md-12 " style="display: flex;">


                                    <input name="number" class=" form-control m-1" type="hidden"
                                        value="0{{ Auth::user()->mobile }}">



                                </div>

                            @endauth


                            @if ($errors->any())

                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach

                            @endif
                        </div>






                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="comment" class="form-control"
                                    style=" height:150px ; font-family: Arial, Helvetica, sans-serif !important;   text-color:blaCK;" required=""
                                    placeholder="دیدگاه شما"></textarea>
                            </div>
                        </div>

                        <div class="form-group mt-4 mb-4">
                            <div class="captcha">
                                <span>{!! Captcha::img('flat') !!}</span>
                                <button type="button" class="btn btn-danger" class="reload"
                                    onclick="reloadCaptcha()">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">

                                <input style="font-size:14px;" type="text"
                                    placeholder="مقدار فرم اعتبار سنجی را وارد کنید" name="captcha"
                                    class="form-control required">

                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary pull-right biggerFont"> ارسال دیدگاه</button>
                </div>
                </form>




                <form id="answerForm" style="height:0px; overflow: hidden;" method="POST"
                    action="{{ route('AnswerComment') }}" class="form-block">

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group fl_icon">

                                <div style="border: 1px solid rgb(219, 219, 219);" class="d-flex">
                                    {{-- <span style="margin: 0 10px 10px 10px;" class="col-2">در پاسخ به :</span> --}}
                                    <input style="margin: 0 10px 10px 10px;" id="parent_name" name="parent_name"
                                        class="biggerFont form-control" type="hidden" disabled>
                                </div>

                                @guest
                                    <div class="col-xs-12 col-md-12 " style="display: flex;">


                                        <input id="writerAnswerName" name="username" class=" form-control m-1"
                                            type="text" required
                                            style="font-family: Arial, Helvetica, sans-serif !important;   font-size: 14px !important; text-color:bla"
                                            placeholder="نام">
                                        <input name="email" class=" form-control  m-1" type="email"
                                            style="font-family: Arial, Helvetica, sans-serif !important;   font-size: 14px !important; text-color:bla"
                                            id="writerAnswerName" required placeholder="ایمیل " required>


                                    </div>


                                    <div class="col-xs-12 col-md-12 " style="display: flex;">


                                        <input name="number" class=" form-control m-1" type="number"
                                            style="font-family: Arial, Helvetica, sans-serif !important;   font-size: 14px !important; text-color:bla"
                                            id="writerAnswerName" required
                                            placeholder="شماره تلفن (نمایش داده نمیشود و جهت ارتباط ادمین با شما می باشد) ">

                                    </div>
                                @endguest


                                @auth

                                    <input id="writerAnswerName" name="username" class=" form-control m-1"
                                        type="hidden" value="{{ Auth::user()->name }}">
                                    @if (Auth::user()->vendor->socialMedias)
                                        <input name="email" value="{{ Auth::user()->vendor->socialMedias->email }}"
                                            class=" form-control  m-1" type="hidden" id="writerAnswerName">
                                    @else
                                        <input name="email" value="" class=" form-control  m-1" type="email"
                                            id="writerAnswerName">

                                        <small>(شما ایمیل خود را ثبت نکردید)</small>
                                    @endif


                                    <div class="col-xs-12 col-md-12 " style="display: flex;">


                                        <input name="number" class=" form-control m-1" type="hidden"
                                            value="0{{ Auth::user()->mobile }}">



                                    </div>

                                @endauth


                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <textarea name="comment" id="Answer" class="form-control biggerFont"
                                    style="font-family: Arial, Helvetica, sans-serif !important; margin:10px; max-height:200px;  max-width:100%; min-height:200px; min-width:100%;  font-size: 25px !important; text-color:bla"
                                    required="" placeholder="پاسخ شما"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="answered_to" id="answered_to">




                        <div class="row">

                            <div class="form-group mt-4 mb-4">
                                <div class="captcha">
                                    <span>{!! Captcha::img('flat') !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload"
                                        onclick="reloadCaptcha()">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">

                                    <input type="text" placeholder="مقدار فرم اعتبار سنجی را وارد کنید"
                                        name="captcha" class="form-control required input-font">
                                    
                                        
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-primary col-md-4 m-1 col-sm-12 pull-right biggerFont">ارسال
                                پاسخ</button>

                            <button style="float: left;" onclick="showcommentForm()" id="sendCommentBt"
                                class="btn col-md-3 col-sm-12 m-1 btn-primary pull-right biggerFont">درج
                                دیدگاه جدید</button>

                        </div>




                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
