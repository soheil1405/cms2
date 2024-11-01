<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExcelExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;

    private $items;

    public function __constuct($items)
    {

        $this->items = $items;
    }

    public function collection()
    {

        return $this->items;
    }

    public function map($order): array
    {

        $out = [
            $order->id,

            $order->user->name,
            $vendor->user->id,
            $vendor->user->mobile,
            \Morilog\Jalali\Jalalian::forge($vendor->created_at),
            \Morilog\Jalali\Jalalian::forge($vendor->last_login),
            $vendor->login_count,
            $vendor->products_count,
            $vendor->story_count,
            $vendor->slider_count,
            $vendor->spcP_count,
            $vendor->ladderP_count,

            $vendor->spcV_count,
            $vendor->ladderV_count,

        ];
        return $out;
    }

    public function headings(): array
    {
        return [type
            "کد سفارش",
            "نام کاربر",
            "شماره کاربر", "نام فروشگاه	", "track_id", "کد درگاه", "نوع سفارش", "وضعیت سفارش", "تاریخ پرداخت", "توضیحات سفارش", "",
        ];
    }

}
