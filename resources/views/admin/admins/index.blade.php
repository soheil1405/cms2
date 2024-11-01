@extends('admin.layouts.admin')

@section('title')
    ادمین ها
@endsection




@section('content')

    
    <div class="row">

        <div class="d-xs-block d-md-none">
            @if (Auth::user()->vendor->type != 'main')
                @if (!is_null(Auth::user()->vendor->EditReportText))
                    {{ Auth::user()->vendor->EditReportText }}
                @else
                    <div class="alert alert-warning your-store-dashbord">
                        فروشگاه شما در صف تایید کارشناسان می باشد
                    </div>
                @endif
            @else
                <div class="alert alert-success ">
                    فروشگاه شما فعال می باشد.
                </div>
            @endif

        </div>
        <div class="d-xs-block d-md-none ">
            @if (\App\Models\Admin\SiteSetting::first()->paymentStatus)
                <div
                    @if (Auth::user()->CREDIT < 10000) class="alert alert-danger "

              @else
                class="alert alert-info " @endif>
                    {{-- @dd(Auth::user()->CREDIT); --}}
                    موجودی حساب شما : {{ Auth::user()->CREDIT }} تومان

                    <a class="btn btn-success" href="{{ route('user.orders.index') }}"> افزایش حساب +</a>

                </div>
            @endif
        </div>

    </div>




    @if (isset($adminss))
        <div class="">
            <div class="">

                <h3>



                    لیست ادمین های {{ $permission->name }}



                </h3>


            </div>
            <hr>
            <div class="col-6">

                توضیحات نقش :
                <small>{{ $permission->name }}</small>
                <hr>
                <a href="{{ route('admin.admins.index') }}" class="btn btn-primary m-2"> همه ادمین ها</a>
                <a href="{{ route('admin.premissions.index') }}" class="btn btn-primary m-2"> همه سطح دسترسی ها </a>

            </div>

        </div>
    @else
        <div class="row">
            <div class="col-5">

                <h3>




                

                </h3>


            </div>
            <div class="col-6">

                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary m-2">افزودن ادمین جدید</a>
                <a href="{{ route('admin.premissions.index') }}" class="btn btn-primary m-2"> مدیریت سطح دسترسی ادمین ها
                </a>

            </div>

        </div>
    @endif
    <div class="table-responsive" style="margin-top:10px!important;">
        <table class="table table-bordered table-striped text-center">

            <thead>
                <tr>

                    <th>کد کاربری</th>
                    <th>نام</th>
                    <th>نقش </th>
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
                @if (isset($admins))
                    @foreach ($admins as $admin)
                        <tr>

                            <th>

                                {{ $admin->user->id }}

                            </th>


                            <th>
                                {{ $admin->user->name }}

                            </th>

                            <th>
                                @if (is_null($admin->user->permissions))
                                    SUPER ADMIN
                                @elseif (is_null($admin->user->permission_name_for_admins))
                                    custom
                                @else
                                    {{ $admin->user->permission_name_for_admins }}
                                @endif
                            </th>

                            <th>
                                0{{ $admin->user->mobile }}
                            </th>
                            <th>
                                {{ \Morilog\Jalali\Jalalian::forge($admin->user->created_at) }}
                            </th>

                            <th>

                                @if ($admin->user->status == '1')
                                    <span class="text-success">فعال</span>
                                @else
                                    غیر فعال
                                @endif
                            </th>


                            <th>
                                <span class="text-success">آنلاین :)</span>
                            </th>


                            <th>


                                @if (!is_null($admin->user->permissions))
                                    <a href="{{ route('admin.adminslogs', ['id' => $admin->user->id]) }}"
                                        class="btn btn-secondary mb-1">تاریخچه کاربر</a>
                                    <a href="{{ route('admin.admins.edit', ['admin' => $admin->user]) }}"
                                        class="btn btn-info mb-1">مشاهده
                                        و ویرایش</a>


                                    @if (is_null(Auth::user()->permissions))
                                        <a onclick="deleteee({{ $admin->id }})" class="btn btn-danger">حذف</a>
                                    @endif
                                @endif


                            </th>
                        </tr>
                    @endforeach
                @elseif(isset($adminss))
                    @foreach ($adminss as $admin)
                        <tr>

                            <th>

                                {{ $admin->id }}

                            </th>


                            <th>
                                {{ $admin->name }}

                            </th>

                            <th>
                                @if (is_null($admin->permissions))
                                    SUPER ADMIN
                                @elseif (is_null($admin->permission_name_for_admins))
                                    custom
                                @else
                                    {{ $admin->permission_name_for_admins }}
                                @endif
                            </th>

                            <th>
                                0{{ $admin->mobile }}
                            </th>
                            <th>
                                {{ \Morilog\Jalali\Jalalian::forge($admin->created_at) }}
                            </th>

                            <th>

                                @if ($admin->status == '1')
                                    <span class="text-success">فعال</span>
                                @else
                                    غیر فعال
                                @endif
                            </th>


                            <th>
                                <span class="text-success">آنلاین :)</span>
                            </th>


                            <th>


                                @if (!is_null($admin->permissions))
                                    <a href="{{ route('admin.adminslogs', ['id' => $admin->id]) }}"
                                        class="btn btn-secondary">تاریخچه کاربر</a>
                                    <a href="{{ route('admin.admins.edit', ['admin' => $admin]) }}"
                                        class="btn btn-info">مشاهده
                                        و ویرایش</a>


                                    @if (is_null(Auth::user()->permissions))
                                        <a onclick="deleteee({{ $admin->id }})" class="btn btn-danger">حذف</a>
                                    @endif
                                @endif


                            </th>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection




<form action="{{ route('admin.deleteAadmin') }}" id="deleteForm" method="post">

    @csrf

    <input type="hidden" name="uid">

</form>

<script>
    function deleteee(id) {


        var answer = window.confirm(
            "با حذف این ادمین تمام لاگ های مرتیط با آن حذف خواهد شد.... آیا میخواهید این ادمین را حذف کنید ؟");
        if (answer) {
            $('#uid').val(id);
            $('#deleteForm').submit();


        }
    }
</script>
