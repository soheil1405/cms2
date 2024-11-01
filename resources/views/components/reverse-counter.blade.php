@php
    $id_reverse_counter = microtime();
    $id_reverse_counter = str_replace('0.','',$id_reverse_counter);
    $id_reverse_counter = explode(' ',$id_reverse_counter);
    $id_reverse_counter = "$id_reverse_counter[1]$id_reverse_counter[0]";
    $show_reverse_counter = (Carbon\Carbon::now() < Carbon\Carbon::parse($expireDate))?true:false;
@endphp
@push('footer_scripts')
<script>
    var elem_resend = $('{{$resendElem}}');
</script>
@endpush
@if ($show_reverse_counter)
<p id="{{$id_reverse_counter}}" class="text-danger">
</p>
<p id="msg_{{$id_reverse_counter}}" class="text-danger">
    {{$msgWait}}
</p>

@push('footer_scripts')
    <script>
        
        var elem = $('#{{$id_reverse_counter}}');
        var elem_msg = $('#msg_{{$id_reverse_counter}}');

        var time = new Date({{Carbon\Carbon::parse($expireDate)->getTimestampMs()}});
        var time_now = Date.now();
        
        elem_resend.css('display','none');
        function interval_{{$id_reverse_counter}}()
        {
            time_now = Date.now();
            if((time - time_now) < 0)
            {
                elem.removeClass('text-danger');
                elem.addClass('text-success');
                elem_msg.removeClass('text-danger');
                elem_msg.addClass('text-success');
                elem_msg.text('{{$msgTry}}');
                elem_resend.css('display','unset');
            }else{
                elem_resend.css('display','none');
                var tmp_time = new Date(time - time_now);
                elem.text( tmp_time.getUTCMinutes() + ':' + tmp_time.getUTCSeconds() );
            }
        }
        interval_{{$id_reverse_counter}}();
        setInterval(() => {
            interval_{{$id_reverse_counter}}();
        }, 1000);
    </script>
@endpush
@else
@push('footer_scripts')
<script>
    elem_resend.css('display','unset');
</script>
@endpush
<p id="{{$id_reverse_counter}}" class="text-success">
    0:0
</p>
<p class="text-success">
    {{$msgTry}}
</p>
@endif
