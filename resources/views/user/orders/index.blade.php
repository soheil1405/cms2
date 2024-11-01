@extends('user.layouts.user')

@section('title')
    index products
@endsection





@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-3">



                <form action="{{ route('user.increaseCredit') }}" method="post">
                    @csrf


                    <label for="">مبلغ</label>
                    <input type="hidden" name="type" value="increaseCreadit">
                    <input type="number" name="amount" id="" min="250000" value="250000" required
                        class="form-control">ریال
                    <hr>
                    <label for="">توضیحات(اختیاری)</label>
                    <textarea name="desc" id="" class="form-control" cols="10" rows="5"></textarea>

                    <input type="submit" value="پرداخت" class="btn btn-success">



                </form>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 ">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between py-4 px-2 bg-white rounded">
                <h5 class="font-weight-bold ">لیست تراکنش ها {{ count($orders) }}</h5>





                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">

                    افزایش حساب
                </button>



                <a href="{{ route('user.SummaryOfOrders') }}">مشاهده خلاصه پرداخت ها</a>

            </div>

            @if (Session::has('update'))
                <div class="alert alert-success">
                    {{ Session::get('update') }}
                </div>
            @endif

            @if (Session::has('created'))
                <div class="alert alert-success">
                    {{ Session::get('created') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>کد سفارش</th>



                            <th>
                                نام کاربر
                            </th>
                            <th>
                                شماره کاربر
                            </th>


                            <th>
                                کد درگاه
                            </th>
                            <th>
                                نوع سفارش
                            </th>
                            <th>
                                وضعیت سفارش
                            </th>

                            <th>
                                تاریخ پرداخت
                            </th>
                            <th>
                                توضیحات سفارش
                            </th>
                            <th>
                                مبلغ کل
                            </th>

                            <th>
                                مبلغ بعد از تخفیف
                            </th>
                            <th>
                                عملیات
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                <th>

                                    {{ $order->id }}

                                </th>


                                <th>
                                    <a href="{{ route('admin.showUserDetail', ['id' => $order->user->id]) }}">
                                        {{ $order->user->name }}
                                    </a>
                                </th>
                                <th>
                                    0{{ $order->user->mobile }}
                                </th>




                                <th>

                                    {{ $order->idFromIdpay }}

                                </th>
                                <th>

                                    @if ($order->orderType == 'increaseCredit')
                                        افزایش موجودی کیف پول
                                    @else
                                        {{ $order->description }}
                                    @endif
                                </th>

                                <th @if ($order->persianStatus == 'پرداخت تایید شده است.') class="text-success" @endif>

                                    {{ $order->persianStatus }}

                                </th>

                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($order->created_at) }}
                                </th>

                                <th>

                                    {{ $order->orderDescription }}
                                </th>

                                <th>
                                    {{ $order->totalAmount }}
                                </th>

                                <th>
                                    {{ $order->amountAfterOffer }}
                                </th>

                                <th>
                                    <a href="{{ route('user.orders.show', ['id' => $order->id]) }}"class="btn btn-info">مشاهده
                                        فاکتور</a>
                                </th>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>


    {{ $orders->links() }}
@endsection
