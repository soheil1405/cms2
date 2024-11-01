@extends('user.layouts.user')

@section('title')
    کارمندان
@endsection





@section('content')

    

    <div class="bg-white py-2 px-2 rounded">
        لیست کارمندان من :

        <a href="{{ route('user.Employees.create') }}" class="btn btn-primary">افزودن کاربر جدید</a>
    </div>
    <div class="table-responsive" style="margin-top:10px!important;">
        <table class="table table-bordered table-striped text-center">

            <thead>
                <tr>

                    <th>کد کاربری</th>
                    <th>نام</th>
                    <th>
                        شماره تلفن
                    </th>
                    <th>تاریخ ثبت </th>
                    <th>وضعیت</th>
                    <th>آخرین بازدید</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Employers as $Employer)
                    <tr>

                        <th>

                            {{ $Employer->id }}

                        </th>


                        <th>
                            {{ $Employer->name }}

                        </th>

                        <th>
                            0{{ $Employer->mobile }}
                        </th>
                        <th>
                            {{ \Morilog\Jalali\Jalalian::forge($Employer->created_at) }}

                        </th>

                        <th>

                            @if ($Employer->status == '1')
                                فعال
                            @else
                                غیر فعال
                            @endif
                        </th>


                        <th>
                            <span class="text-success">آنلاین :)</span>
                        </th>


                        <th>

                            <a href="{{ route('user.Employees.logs', ['userId' => $Employer->id]) }}"
                                class="btn btn-secondary">تاریخچه کاربر</a>
                            <a href="{{ route('user.Employees.edit', ['Employee' => $Employer]) }}"
                                class="btn btn-info">مشاهده
                                و ویرایش</a>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
