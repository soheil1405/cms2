@extends('user.layouts.user')

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



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">



                    آیا از بستن این تیکت اظمینان دارید؟

                    <form action="{{ route('user.tickets.close') }}" id="deleteForm" method="post">

                        @csrf

                        <input type="hidden" name="id" value="{{ $ticket->id }}">

                        <input type="submit" class="btn btn-danger" value="بله">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>

                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>







    <!-- Content Row -->
    <p class="font-weight-bold mb-3 mb-md-0   rounded mt-3 p-3 w-50"> عنوان تیکت :
        {{ $ticket->subject }} </p>
    <div class="row">

        <div class="col-xl-12 d-flex col-md-12   bg-white row">
            <div class="col-md-3 ">

             
                <p class="font-weight-bold mb-3 mb-md-0 bg-secondary text-white rounded mt-3 p-3 w-50"> وضعیت تیکت :
                    {{ $ticket->status }} </p>




            </div>

            <div style="height: 80%;" class="  mb-4  bg-white col-md-9">

                <div class="col col-md-10 col-lg-9 col-xl-8 mx-auto " style="max-height: 100%; ">
                    <div class="card  msgcard">
                        @if ($ticket->status == 'open')
                            <button type="button" class="btn btn-dark" data-toggle="modal"
                                data-target="#exampleModalCenter">

                                بستن تیکت

                            </button>
                        @endif

                        <div class="card-body">
                            <div class="p-5 bg-light">
                                <div id="messages_container " class="chat-log">

                                    <div class="chat-log_item chat-log_item-own z-depth-0 m-2">
                                        {{ $ticket->massage }}
                                        <p>                       {{ \Morilog\Jalali\Jalalian::forge($ticket->created_at) }}
                                            
                                        </p>

                                    </div>


                                    @foreach ($answers as $answer)
                                        @if ($answer->username != 'admin')
                                            <div class="chat-log_item chat-log_item-own z-depth-0 m-2">

                                                {{ $answer->massage }}

                                                <p>                                                {{ \Morilog\Jalali\Jalalian::forge($ticket->created_at) }}
                                                         
                                                    
                                                </p>
                                            </div>
                                        @else
                                            <div class="chat-log_item chat-log_item z-depth-0 mx-3">

                                                <strong class="">admin</strong>

                                                <p class="">
                                                    {{ $answer->massage }}
                                                </p>
                                                <p>             
                                                    {{ \Morilog\Jalali\Jalalian::forge($ticket->created_at) }}
                                            
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        @if ($ticket->status == 'open')
                            <div class="card-footer border-0 bottom-rounded bg-secondary">



                                <div class="col-12 d-flex mb-5">


                                    @csrf


                                    <textarea style="width: 95% !important;" id="massage" placeholder="" rows="4" class="form-control"required></textarea>
                                    <input type="hidden" id="id" value="{{ $ticket->id }}">
                                    <input type="hidden" id="username" value="{{ Auth::user()->vendor->id }}">







                                    <button onclick="sendAnswerTicketUser()" class="btn btn-primary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                        </svg></button>


                                </div>


                            </div>
                        @else
                            <div class=" card-footer border-0 bottom-rounded alert-danger">
                                @if ($ticket->status == '1')
                                    این تیکت توسط شما بسته شده است
                                @elseif($ticket->status == '2')
                                    این تیکت توسظ ادمین بسته شده است
                                @endif

                            </div>
                        @endif


                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection


<script>
    function sendAnswerTicketUser() {
        var id = $('#id').val();
        var username = $('#username').val();
        var massage = $('#massage').val();

        var messages_container = $('#messages_container');

        formData = {
            id: id,
            username: username,
            massage: massage
        };

        console.log(formData);

        $.ajax({


            type: "POST",
            url: '/vendor-dashboard/UseranswerTicket',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {


                $("<div/>", {


                    class: 'chat-log_item chat-log_item-own z-depth-0',
                    html: data.massage + ' (لحظاتی پیش)',
                }).appendTo(messages_container);





                console.log(data);

            },
            error: function(data) {
                console.log("no");

                console.log(data.responseJSON.message);

            }

        });







    }
</script>
