


<a  href="{{ route('user.inbox' ) }}" class="col-md-4" id="toast_right">
    <div style="display: flex; flex-direction: column; justify-content: space-between; " class="col-12">
    
        <img style="max-width: 30px;" src="{{ url('main/logo2.png') }}">

        {{-- <div style="padding: 5px; cursor: pointer;" onclick="document.getElementById('toast_right').className = document.getElementById('toast_right').className.replace('show', ''); " class="closeBt">
            <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x"
                viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </div> --}}

    </div>
    <div id="desc">
        {{$unread_notifable->subject}}
        <hr>
        {{$unread_notifable->message}}
        
    </div>
</a>



<?php
        $showedd = Session::get('showedNotificationSession');

        
        if(is_null($showedd)){
            $showedd = [
                'id'=>$unread_notifable->id
            ];
            
        }else{
            
            $myArray = [
                'id'=>$unread_notifable->id
            ];
            array_push($showedd, $myArray);

        }




        
        Session::put('showedNotificationSession', $showedd);



?>
<script>


    var y = document.getElementById("toast_right")
    y.className = "show";
    setTimeout(function() {
        y.className = y.className.replace("show", "");
    }, 10000);



 

    function remove_right() {
        y.className = y.className.replace("show", "");
    }

</script>


<style>




.eachCommentInNotif{
    color: #fff;
    text-decoration: none;
    width: 100%;
    background-color: #888;
    transition: all 0.3s;
}

.eachCommentInNotif:hover{

    margin-right: 10px;
    text-decoration: none;

}






    #toast_right {
        visibility: hidden;
        max-width: 50px;
        /*margin-left: -125px;*/
        margin: auto;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        position: fixed;
        z-index: 1;
        right: 10px;

        bottom: 30px;
        font-size: 17px;
        white-space: nowrap;
        text-decoration: none;

    }

    #toast_right #img {
        width: 50px;



        padding-top: 16px;
        padding-bottom: 16px;

        box-sizing: border-box;


        /* background-color: #222; */
        color: #fff;
    }

    #toast_right #desc {


        color: #fff;

        padding: 16px;

        width: 100%;

        white-space: nowrap;
    }

    #toast_right.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, expand 0.5s 0.5s, stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, expand 0.5s 0.5s, stay 8s 1s, shrink 0.5s 9s, fadeout 0.5s 9.5s;
    }


    .closeBt{
        transition: all 0.3s;
        width: 30px ;
    }

    .closeBt:hover{

        background-color: rgb(107, 105, 105);
    }





    @-webkit-keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @-webkit-keyframes expand {
        from {
            min-width: 50px
        }

        to {
            min-width: 350px
        }
    }

    @keyframes expand {
        from {
            min-width: 50px
        }

        to {
            min-width: 350px
        }
    }

    @-webkit-keyframes stay {
        from {
            min-width: 350px
        }

        to {
            min-width: 350px
        }
    }

    @keyframes stay {
        from {
            min-width: 350px
        }

        to {
            min-width: 350px
        }
    }

    @-webkit-keyframes shrink {
        from {
            min-width: 350px;
        }

        to {
            min-width: 50px;
        }
    }

    @keyframes shrink {
        from {
            min-width: 350px;
        }

        to {
            min-width: 50px;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 60px;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 60px;
            opacity: 0;
            font-size: 0px;
        }
    }
</style>
