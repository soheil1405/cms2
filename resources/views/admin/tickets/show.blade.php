@extends('admin.layouts.admin')

@section('title')
    index brands
@endsection

<style>
    .msgcard {
        box-shadow: 0 0px 25px rgba(0, 0, 0, .2);
    }

    .chat-log {
        overflow: auto;
        height: calc(75vh);
    }

    .chat-log_item {
        background: #eaeaea;
        padding: 10px;
        margin: 0 auto 10px;

        min-width: 25%;
        float: left;
        font-size: 13px;
        border-radius: 0 20px 20px 20px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
        clear: both;
    }

    .chat-log_item.chat-log_item-own {
        float: right;
        background: #D5F4E7;
        text-align: right;
        margin-right: 0.7rem;
        border-radius: 20px 0 20px 20px;
    }

    .chat-form {
        background: #DDDDDD;

        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .chat-log_author {
        margin: 0 auto 0em;
        font-size: 12px;
        font-weight: bold;
    }

    .chat-log_time {

        direction: rtl;
        font-size: 12px;
        opacity: 0.5;
    }
</style>

@section('content')
    <!-- Content Row -->
    <div class="m-0 bg-white p-3">
        <h5 class="fw-bold mb-3 w-100 "> عنوان تیکت : {{ $ticket->subject }} </h5>

        <div class=" row   pt-4">
            <div class="col-md-3">
                <h6 class="font-weight-bold mb-3 mb-md-0"> نام فرستنده : @if ($ticket->username == 'guest')
                        کاربر مهممان
                    @elseif($ticket->vendor)
                        <a href="{{ route('vendor.home', ['vendor' => $ticket->vendor->name]) }}">
                            {{ $ticket->vendor->title }}</a>
                    @else
                        فروشگاه حذف شده
                    @endif
                </h6>
                <h6 class="font-weight-bold mb-3 mb-md-0"> ایمیل فرستنده : {{ $ticket->email }} </h6>
                <h6 class="font-weight-bold mb-3 mb-md-0"> شماره تلفن : {{ $ticket->number }} </h6>

                <h6 class="font-weight-bold mb-3 mb-md-0"> وضعیت تیکت : {{ $ticket->status }} </h6>

                <a class="btn btn-primary" href="{{ route('admin.tickets.index') }}">
                    بازگشت
                </a>


            </div>

            <div style="height: 80%;" class=" col-md-9  d-block bg-white">

                <div class=" mx-auto " style="max-height: 100%; ">
                    <div class="card  msgcard">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div id="messages_container" class="chat-log">

                                    <div class="chat-log_item chat-log_item-own z-depth-0">
                                        <div class="row justify-content-end mx-1 d-flex">
                                            <div class="col-auto px-0">
                                                <span class="chat-log_author fw-bold">
                                                    {{ $ticket->username }}
                                                </span>
                                            </div>
                                            <div class="col-auto px-0">
                                            </div>
                                        </div>
                                        <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                                        <div class="chat-log_message">
                                            <p> {{ $ticket->massage }} </p>
                                        </div>
                                        <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                                        <div class="row chat-log_time m-0 p-0 justify-content-end">

                                            {{ \Morilog\Jalali\Jalalian::forge($ticket->created_at) }}
                                        </div>

                                    </div>


                                    @foreach ($answers as $answer)
                                        @if ($answer->username != 'admin')
                                            <div class="chat-log_item chat-log_item-own z-depth-0">
                                                <div class="row justify-content-end mx-1 d-flex">
                                                    <div class="col-auto px-0">
                                                        <span class="chat-log_author">

                                                            {{ $answer->username }}

                                                        </span>
                                                    </div>
                                                    <div class="col-auto px-0">
                                                    </div>
                                                </div>
                                                <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                                                <div class="chat-log_message">
                                                    <p> {{ $answer->massage }} </p>
                                                </div>
                                                <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                                                <div class="row chat-log_time m-0 p-0 justify-content-end">

                                                    {{ \Morilog\Jalali\Jalalian::forge($answer->created_at) }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat-log_item chat-log_item z-depth-0">
                                                <div class="row justify-content-end mx-1 d-flex">
                                                    <div class="col-auto px-0">
                                                        <span class="chat-log_author">
                                                            admin
                                                        </span>
                                                    </div>
                                                    <div class="col-auto px-0">
                                                    </div>
                                                </div>
                                                <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                                                <div class="chat-log_message">
                                                    <p>
                                                        {{ $answer->massage }}


                                                    </p>
                                                </div>
                                                <hr class="my-1 py-0 col-8" style="opacity: 0.5">
                                                <div class="row chat-log_time m-0 p-0 justify-content-end">

                                                    {{ \Morilog\Jalali\Jalalian::forge($answer->created_at) }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 bottom-rounded " style="background-color: #97E3C2">
                            <div class="row d-block w-100">
                                <div class="col col-md-12 col-lg-12 ">
                                    <div class="">
                                        <form action="{{ route('admin.tickets.answer') }}" method="post"
                                            class="row">

                                            @csrf

                                            <div class="col-12 col-md-10 align-self-center ">
                                                <div class="">
                                                    <div class=" ">
                                                        <div class="form-group ">
                                                            <textarea rows="2" id="content" name="massage" placeholder="what's up bro!"
                                                                class="form-control textarea resize-ta"required></textarea>
                                                            <input type="hidden" name="id"
                                                                value="{{ $ticket->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-md-2 d-flex align-self-center justify-content-center justify-content-md-end my-0">
                                                <div class="md-form my-1">
                                                    <button type="submit" class="btn btn-success">Send Message</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
