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

    <div class="col-md-10 col-12 p-0" id="sendTicketbox"
        style=" z-index:100 ; background-color: aliceblue; border-radius: 1px solid black; ;  ">


        <div class="col-md-12 col-sm-12 p-0">

            <h2 class="h5">
                ارسال تیکت به اینستابرق
            </h2>
            <div id="ticketSuccess" class="alert alert-success" style="display: none">


                تیکت شما با موفقیت ارسال شد



            </div>






            <div class="col-12 p-0">

                <form method="post" action="{{ route('Sendticket2') }}" class="col-12 text-center ">
                    @csrf
                    <input type="text" placeholder="عنوان تیکت :" id="ticketSubject" name="subject" required
                        class="form-control mb-3 ticketSubject">

                    <input type="hidden" name="username" class="ticketUsername" value="{{ Auth::user()->vendor->id }} ">

                    <input type="hidden" name="number" value="{{ Auth::user()->mobile }}">


                    <input type="hidden" name="ticketEmail" class="AnswerCommentMail"
                        value="{{ Auth::user()->vendor->socialMedias->email }}">

                    <textarea name="ticketText" class="w-100 p-2 rounded form-control" rows="10" id="ticketText" placeholder="متن تیکت"
                        class="form-control ticketText"></textarea>

                    <!-- <p id="ticketError" style="display: none;">

                            <small class="text-danger">

                                *

                            </small>

                            <a href="{{ route('user.vendor.images.edit', ['vendor' => Auth::user()->vendor->name]) }}" id="ticketErrorText">
                                        ایمیل شما معتبر نیست ، ابتدا ایمیل خود را بصورت صحیح وارد کنید
                            </a>

                        </p> -->



                    <button type="submit" class="btn btn-warning m-3">ارسال تیکت

                    </button>

                </form>


            </div>


        </div>





    </div>
@endsection




<script>
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


            console.log(ticketEmail);
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
                    url: "/Sendticket",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        window.location.replace("https://instabargh.com/vendor-dashboard/tickets");




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
