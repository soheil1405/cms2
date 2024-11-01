@extends('user.layouts.user')

@section('title')
    index banner
@endsection

<style>
    .inboxMessageItem {
        margin: 5px;
        background-color: rgb(111, 113, 114);
        width: 100% !important;
        color: black;
        padding: 20px;
        text-align: center;
        border-radius: 25px;
    }

    .datemessage {
        color: rgb(39, 38, 38);
        display: none;
    }

    .inboxMessageItem:hover {
        text-decoration: none !important;
        color: rgb(19, 18, 18) !important;
    }
</style>

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white"
            style=" height:100vh; overflow: scroll ; display: flex; flex-direction: column; ">
            @foreach ($messages as $message)
                @if ($message->subject == 'تایید محصول')
                    <?php
                    $product = App\Models\Product::find($message->subject_id);
                    ?>



                    @if ($product)
                        <a href="{{ route('products.show', [ 'product' => $product->slug]) }}"
                            class="inboxMessageItem">


                            {{ $message->message }}

                            <br>

                            <small class="datemessage">
                                ({{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }})
                            </small>









                        </a>
                    @endif
                @elseif ($message->subject == 'محصول جدید فالوور')
                    <a class="inboxMessageItem" style="color: white;" href="{{ $message->link }}">

                        {{ $message->message }}

                        <br>

                        <small class="datemessage">
                            ({{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }})
                        </small>





                    </a>
                @elseif ($message->subject == 'خوش آمد گویی')
                    <a class="inboxMessageItem" style="color: white;">


                        {{ $message->message }}

                        <br>

                        <small class="datemessage">
                            ({{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }})
                        </small>





                    </a>







                    @elseif($message->subject == "ریپورت فروشگاه")

                    <?php
                    $vendor = App\Models\vendor::find($message->subject_id);
                    ?>
                    @if ($vendor)
                        <a   href="{{ route('user.vendor.images.edit', ['vendor' => $vendor->name]) }}" class="inboxMessageItem">

                            {{ $message->message }}


                            ، لطفا برای انتشار مجدد آن را ویرایش کنید

                            <br>

                            <small class="datemessage">
                                (
                                {{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }}

                                )
                            </small>


                        </a>
                    @endif















                    @elseif($message->subject == "ریپورت محصول")

                    <?php
                    $product = App\Models\Product::find($message->subject_id);
                    ?>
                    @if ($product)
                        <a href="{{ route('user.products.edit', ['product' => $product->id]) }}" class="inboxMessageItem">

                            {{ $message->message }}


                            ، لطفا برای انتشار مجدد آن را ویرایش کنید
                            <br>

                            <small class="datemessage">
                                (
                                {{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }}

                                )
                            </small>


                        </a>
                    @endif
                @elseif($message->subject == 'ویرایش محصول')
                    <?php
                    $product = App\Models\Product::find($message->subject_id);
                    ?>
                    @if ($product)
                        <a href="{{ route('user.products.edit', ['product' => $product->id]) }}" class="inboxMessageItem">

                            {{ $message->message }}


                            <br>

                            <small class="datemessage">
                                (
                                {{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }}

                                )
                            </small>










                        </a>
                    @endif
                @elseif($message->subject == ' کامنت محصول ')
                    <?php
                    $product = App\Models\Product::find($message->subject_id);
                    ?>


                    @if ($product)
                        <a href="{{ route('products.show', [ 'product' => $product->slug]) }}"
                            class="inboxMessageItem">



                            {{ $message->message }}

                            <br>

                            <small class="datemessage">
                                ({{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }})
                            </small>









                        </a>
                    @endif
                @elseif($message->subject == 'ویرایش فروشگاه')
                    <?php
                    $vendor = App\Models\vendor::find($message->subject_id);
                    ?>



                    <a href="#" class="inboxMessageItem">



                        {{ $message->message }}


                        <br>

                        <small class="datemessage">
                            ({{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }})
                        </small>









                    </a>
                @elseif($message->subject == 'تایید قزوشگاه')
                    <?php
                    $vendor = App\Models\vendor::find($message->subject_id);
                    ?>



                    <a href="#" class="inboxMessageItem">



                        {{ $message->message }}


                        <br>

                        <small class="datemessage">
                            ({{ \Morilog\Jalali\Jalalian::forge($message->updated_at) }})
                        </small>









                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
