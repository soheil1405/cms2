@extends('user.layouts.user')
@section('title')
    لیست اعلانات
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="" method="get" id="filterForm" hidden>
                <input type="text" name="type" value="default" id="filterType">
            </form>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">لیست اعلانات</h3>
                    <select id="typeFilter" class="form-control form-control-lg">
                        @php
                            $list_opt_filter_type = [
                                'default'           => 'همه',
                                'newuser'           => 'کاربر جدید',
                                'userVerified'      => 'کاربر تایید شده',
                                'updateProfile'     => 'به روز رسانی پروفایل',
                                'login'             => 'لاگین',
                                'logout'            => 'خارج شده',
                                'sendOtp'           => 'ارسال اس ام اس',
                            ];
                        @endphp
                        @foreach ($list_opt_filter_type as $key => $val)
                        <option value="{{$key}}" @if(request()->has('type') && request()->type == $key) selected @endif>
                            {{$val}}
                        </option>
                        @endforeach
                        
                        
                    </select>
                </div>
                <div class="card-header">
                    <h3 class="card-title">لیست اعلانات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>نوع</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        @php
                            $i = 1;
                        @endphp
                        <x-user-notifs :notifs="$notifs"/>
                        </tbody>
                    </table>
                    {{ $notifs->links('vendor.pagination.bootstrap-4') }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('footer_scripts')
    <script>
        $(document).ready(function () {
            $( "#typeFilter" ).change(function() {
                console.log($('#filterForm'));
                $('#filterType').val(this.value);
                $('#filterForm').submit();
            });
        });
    </script>
@endpush