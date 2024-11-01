<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FormView;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class VendorExcelExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return Vendor::all();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function map($vendor): array
    {

        $out = [
            $vendor->id,
            $vendor->title,
            $vendor->user->name,
            $vendor->user->id ,
            $vendor->user->mobile ,
            \Morilog\Jalali\Jalalian::forge($vendor->created_at) ,
            \Morilog\Jalali\Jalalian::forge($vendor->last_login) ,
            $vendor->login_count ,
            $vendor->products_count ,
            $vendor->story_count ,
            $vendor->slider_count ,
            $vendor->spcP_count ,
            $vendor->ladderP_count ,
            $vendor->spcV_count ,
            $vendor->ladderV_count ,
        ];
        return $out;
    }

    public function headings(): array
    {
        return [
            "ایدی",
            "نام فروشگاه",
            "نام مدیر",
            'ایدی مدیر',
            'شماره مدیر',
            'تاریخ ثبت',
            'آخرین ورود',
            'دفعات ورود',
            'تعداد کالا ها',
            'تعداد استوری ها',
            'تعداد اسلایدر ها',
            'تعداد محصولات ویژه',
            'تعداد نردبان محصول',
            'تعداد فروشگاه های ویژه',
            'تعداد نردبان فروشگاه',
        ];
    }

}