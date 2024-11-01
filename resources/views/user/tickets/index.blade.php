@extends('user.layouts.user')

@section('title')
    index brands
@endsection

@section('content')

@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif



   <div class="container-fluid">
    <!-- Content Row -->
    <div class="row">



                 <div class="bg-white col-12 rounded">
                <div class="col-12 ">
                <h5 class="font-weight-bold pt-1">لیست تیکت ها </h5>
            </div>
            @if(is_null(Auth::user()->vendor->socialMedias) ||  is_null(Auth::user()->vendor->socialMedias->email) || Auth::user()->vendor->socialMedias->email == "" )
                <div class="col-xs-12 col-md-9 d-inline-block">
                <div class="alert alert-danger ">
                    <a href="{{route('user.vendor.images.edit' , ['vendor'=>Auth::user()->vendor->name])}}">
                        کاربر گرامی ، شما ایمیل خود را ثبت نکرده اید ، ثبت ایمیل شما باعث میشود در زمان پاسخ دهی به تیکت به شما اطلاع رسانی شود
                    </a>
                </div>
                </div>

                @endif
            
                 <div class="col-xs-12 col-md-3 text-center mb-1 d-inline-block float-left">
                <a class="btn btn-primary " href="{{ route('user.tickets.createNew') }}" style="color: white;">ارسال تیکت جدید</a>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>

                            </th>
                            <th>
                                
                            </th>
                            <th>عنوان تیکت</th>
                            <th>متن تیکت</th>
                            <th> وضعیت </th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody id="allTickets">
                        @foreach ($Tickets as $ticket)
                            <tr>

                                <th>

                                    @if ($ticket->has_New_Ticket_In_This_Thread_from_admin > 0)
                                        <p
                                            style="background-color: rgb(20, 229, 20); border-radius: 50%; width:15px; height: 15px; margin:10px; color:white ">

                                            {{ $ticket->has_New_Ticket_In_This_Thread_from_admin  }}
                                        </p>
                                    @endif

                                </th>
                                <th>
                                    {{ $ticket->id }}
                                </th>

                                <th>
                                    {{ $ticket->subject }}

                                </th>
                                <th>
                                    {{ substr($ticket->massage, 0, 100) . '... ' }}
                                </th>

                                <th>

                                    @if ($ticket->status == 'open')
                                        باز
                                    @elseif($ticket->status == '1')
                                        بسته شده توسط شما
                                    @elseif($ticket->status == '2')
                                        بسته شده توسط ادمین
                                    @endif

                                </th>

                                <th>
                                    <a href="{{ route('user.tickets.show', ['id' => $ticket->id]) }}" class="btn btn-primary">
                                        مشاهده </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">

            </div>
       
    </div>
</div>
@endsection




<script>
   function OpenSendTicketbox(){
    $('#sendTicketbox').css('display' , 'block')
   }


   function Sendticket() {



var username = $('.ticketUsername').val();
var ticketUsername_guest = $('.ticketUsername_guest').val();
var ticketSubject = $('.ticketSubject').val();
var ticketEmail = $('.ticketEmail').val();
var ticketText = $('.ticketText').val();


if (ticketEmail == "" || ticketSubject == "" || ticketText == "") {
    $('#ticketError').css('display', 'block');
    $('#ticketErrorText').text('لطفا تمامی فیلد ها را به درستی پر کنید ...');
    console.log('all null');

} else {

    if (!validateEmail(ticketEmail)) {
        $('#ticketError').css('display', 'block');
        console.log('emailError');
        $('#ticketErrorText').text('مقدار ایمیل به درستی وارد نشده است')
    } else {

        formData = {
            username: username ? username : ticketUsername_guest,
            subject: ticketSubject,
            ticketEmail: ticketEmail,
            ticketText: ticketText
        };


        $.ajax({

            type: "POST",
            url: "/Sendticket" ,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            success : function(data){
                console.log(data);
                $('#ticketError').css('display', 'none');
                $('#ticketSuccess').css('display', 'block');





            },error :function(data){
                console.log(data.responseJSON.message);

            }

        });

    }
}
}
function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }








</script>