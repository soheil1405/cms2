<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #08a6c5;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #08a6c5;
    }
</style>



@if (Session::has('Session_rated_list'))


            <?php
            $rates_array = Session::get('Session_rated_list');
            ?>

        <?php $oldRated = null; ?>


            @for ($i = 0; $i < count($rates_array); $i++)
                @if ($rates_array[$i]['vendor_id'] == $vendor->id)
                    <?php $oldRated = $rates_array[$i]['rate']; ?>
                @endif
            @endfor


            



            
            @if (is_null($oldRated))
                


                <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" @if (Session::has('Session_rated_list') && $oldRated == '5') checked @endif
                                onchange="rateVendor({{ $vendor->id }} , '5')" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" onchange="rateVendor({{ $vendor->id }}, '4')"  @if (Session::has('Session_rated_list') && $oldRated == '4') checked @endif/>
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" @if (Session::has('Session_rated_list') && $oldRated == '3') checked @endif
                                onchange="rateVendor({{ $vendor->id }}, '3')" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" @if (Session::has('Session_rated_list') && $oldRated == '2') checked @endif
                                onchange="rateVendor({{ $vendor->id }}, '2')" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" @if (Session::has('Session_rated_list') && $oldRated == '1') checked @endif
                                onchange="rateVendor({{ $vendor->id }}, '1')" />
                            <label for="star1" title="text">1 star</label>
                        </div>

        @endif

@else


<div class="rate">
    <input type="radio" id="star5" name="rate" value="5"
        onchange="rateVendor({{ $vendor->id }} , '5')" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4"
     onchange="rateVendor({{ $vendor->id }}, '4')" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" 
        onchange="rateVendor({{ $vendor->id }}, '3')" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" 
        onchange="rateVendor({{ $vendor->id }}, '2')" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" 
        onchange="rateVendor({{ $vendor->id }}, '1')" />
    <label for="star1" title="text">1 star</label>
</div>





@endif