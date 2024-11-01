@extends('admin.layouts.admin')

@section('title')
    index orders
@endsection





@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست تراکنش ها {{ count($orders) }}</h5>


            </div>


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
                                نام فروشگاه
                            </th>
                            <th>
                                track_id
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
                            @if ($order->user)
                                <tr>
                                    <th>

                                        {{ $order->id }}

                                    </th>

                                    <th>
                                        <a href="{{ route('admin.showUserDetail', ['id' => $order->user->id]) }}">
                                            {{ $order->user->name }}
                                        </a>
                                        {{-- کاربر یا فروشگاه حذف شده --}}
                                    </th>

                                    <th>
                                        {{ $order->user->mobile }}

                                    </th>

                                    <th>
                                        <a href="{{ route('admin.vendors.show', ['vendor' => $order->user->vendor]) }}">


                                        {{ $order->user->vendor->name }}
                                        </a>
                                    </th>
                                    <th>

                                        {{ $order->track_id }}

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

                                    <th>


                                        @if ($order->persianStatus == 'پرداخت تایید شده است.' || $order->persianStatus == 'پرداخت از طریق کیف پول')
                                            <span class="text-success">
                                            @elseif($order->persianStatus == 'در انتظار پرداخت')
                                                <span class="text-gray">
                                                @else
                                                    <span class="text-danger">
                                        @endif

                                        {{ $order->persianStatus }}

                                        </span>
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
                                        <a
                                            href="{{ route('user.orders.show', ['id' => $order->id]) }}"class="btn btn-info">مشاهده
                                            فاکتور</a>
                                    </th>


                                </tr>
                            @else
                                <tr>
                                    <th>

                                        {{ $order->id }}

                                    </th>

                                    <th>
                                        کاربر یا فروشگاه حذف شده
                                    </th>

                                    <th>
                                        ------
                                    </th>

                                    <th>

                                        کاربر یا فروشگاه حذف شده


                                    </th>
                                    <th>

                                        {{ $order->track_id }}

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

                                    <th>


                                        @if ($order->persianStatus == 'پرداخت تایید شده است.' || $order->persianStatus == 'پرداخت از طریق کیف پول')
                                            <span class="text-success">
                                            @elseif($order->persianStatus == 'در انتظار پرداخت')
                                                <span class="text-gray">
                                                @else
                                                    <span class="text-danger">
                                        @endif

                                        {{ $order->persianStatus }}

                                        </span>
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
                                        <a
                                            href="{{ route('user.orders.show', ['id' => $order->id]) }}"class="btn btn-info">مشاهده
                                            فاکتور</a>
                                    </th>


                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>


    {{ $orders->links() }}
@endsection
