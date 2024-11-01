<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GeneralExportExcel implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    private $items;
    private $type;

    public function __construct($items, $type)
    {

        $this->items = $items;
        $this->type = $type;

    }

    public function collection()
    {
        return $this->items;
    }

    public function map($data): array
    {
        $type = $this->type;
        

        if ($type == "spcV") {
            $array = [
                $data->id,
                $data->vendor->name,
                \Morilog\Jalali\Jalalian::forge($data->fromDate),
                \Morilog\Jalali\Jalalian::forge($data->fromDate),
            ];
        } elseif ($type == "spcP") {
            $array = [
                $data->id,
                $data->Product->vendor->name,
                $data->Product->name,
                \Morilog\Jalali\Jalalian::forge($data->fromDate),
                \Morilog\Jalali\Jalalian::forge($data->fromDate),
            ];
        } elseif ($type == "allP") {

            $array = [
                $data->id,
                $data->name,
                $data->vendor->name,
                $data->brand->name,
                $data->category->name,
                \Morilog\Jalali\Jalalian::forge($data->created_at),
                $data->view_counter,
            ];

        } elseif ($type == "sliders") {

            $array = [

                $data->id,
                $data->vendorName,
                \Morilog\Jalali\Jalalian::forge($data->created_at),
                \Morilog\Jalali\Jalalian::forge($data->from),
                \Morilog\Jalali\Jalalian::forge($data->to),

            ];

        } elseif ($type == "stories") {

            if ($data->vendor) {
                $vandorName = $data->vendor->title;
            } else {
                $vandorName = " ";
            }

            if ($data->product) {
                $pname = $data->product->name;
            } else {
                $pname = " ";
            }
            $array = [
                $data->id,
                $vandorName,
                $pname,
                \Morilog\Jalali\Jalalian::forge($data->created_at),

            ];

        } elseif ($type == "orders"  || $type == "userOrdes") {

            if ($data->orderType == 'increaseCredit') {
                $orderdescription = " افزایش موجودی کیف پول";

            } else {
                $orderdescription =  $data->description;

            }
            $array = [

                $data->id,
                $data->user->name,
                $data->user->mobile,
                $data->user->vendor->name,
                $data->track_id,
                $data->idFromIdpay,
                $orderdescription,
                \Morilog\Jalali\Jalalian::forge($data->created_at), 
                $data->orderDescription,
                $data->totalAmount,
                $data->amountAfterOffer,
                
                $data->persianStatus,

            ];

        }

        return $array;
    }

    public function headings(): array
    {
        $type = $this->type;

        if ($type == "spcV") {
            $array = [
                "آیدی",
                "نام فروشگاه",
                "تاریخ شروع",
                "تاریخ پایان",
            ];


        }if ($type == "spcP") {

            $array = [
                "آیدی",
                "نام فروشگاه",
                "نام محصول",
                "تاریخ شروع",
                "تاریخ پایان",
            ];
        } elseif ($type == "allP") {
            $array = [
                "آیدی",
                "نام محصول",
                "نام فروشگاه",
                "نام برند",
                "نام دسته بندی",
                "تاریخ ثبت",
                "تعداد بازدید",
            ];
        } elseif ($type == "sliders") {
            $array = [
                "آیدی اسلایدر",
                "نام فروشگاه",
                "تاریخ ثبت",
                "تاریخ انتشار",
                "تاریخ پایان",
            ];
        } elseif ($type == "stories") {
            $array = [
                "آیدی استوری",
                "نام فروشگاه",
                "نام محصول",
                "تاریخ انتشار",

            ];

        } elseif ($type == "orders" || $type == "userOrdes") {
            $array = [
                "گد سفارش",
                "نام کاربر",
                "شماره کاربر",
                "نام فروشگاه	",
                "track_id",
                "کد درگاه	",
                "نوع سفارش	",
                "تاریخ ایجاد سفارش	",
                "توضیحات سفارش	",
                "مبلغ کل	",
                "مبلغ بعد از تخفیف	",
                "وضعیت سفارش",

            ];
        }

        
        

        return $array;

    }

    // public function getHeaders($type) : array
    // {

    //     if ($type == "spcV") {
    //         $array = [
    //             "آیدی",
    //             "نام فروشگاه",
    //             "تاریخ شروع",
    //             "تاریخ پایان",
    //         ];
    //     }elseif($type =="spcP"){
    //         $array = [
    //             "آیدی",
    //             "نام فروشگاه",
    //             "نام محصول",
    //             "تاریخ شروع",
    //             "تاریخ پایان",
    //         ];
    //     }
    //     return $array;

    // }

    // public function getdata( $data , $type)  : array
    // {

    //     if ($type == "spcV") {
    //         $array = [
    //             $data->id ,
    //             $data->vendor->name ,
    //             \Morilog\Jalali\Jalalian::forge($data->fromDate) ,
    //             \Morilog\Jalali\Jalalian::forge($data->fromDate)
    //         ];
    //     }elseif($type =="spcP"){
    //         $array = [
    //             $data->id ,
    //             $data->vendor->name ,
    //             $data->Product->name ,
    //             \Morilog\Jalali\Jalalian::forge($data->fromDate) ,
    //             \Morilog\Jalali\Jalalian::forge($data->fromDate)
    //         ];
    //     }
    //     return $array;

    // }

}
