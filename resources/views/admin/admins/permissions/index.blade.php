@extends('admin.layouts.admin')

@section('title')
    دسترسی ها
@endsection





@section('content')
    <div class="row">



        @if(Session::has('msg'))


        <div class="alert alert-success">
            {{Session::get('msg')}}
        </div>

        @endif


        <div class="col-5">

            <h3>
                لیست دسترسی ادمین ها :

            </h3>


        </div>
        <div class="col-6">

            <a href="{{ route('admin.admins.index') }}" class="btn btn-primary m-2">همه ادمین ها</a>
            <a href="{{ route('admin.premissions.create') }}" class="btn btn-info m-2">
                افزودن سطح  دسترسی جدید
            </a>

        </div>

    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">

            <thead>
                <tr>

                    <th>کد دسترسی</th>
                    <th>نام دسترسی</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissons as $permission)
                    <tr>
                        <th>
                            {{$permission->id}}
                        </th>

                        <th>
                            {{$permission->name}}
                        </th>
                        <th>
                            {{-- <a class="btn btn-danger" href="">
                                حذف
                            </a> --}}
                            
                            <a class="btn btn-warning" href="{{route('admin.premissionsUsers' , ['id'=>$permission->id])}}">
                                مشاهده کاربران
                            </a>
                            <a class="btn btn-info" href="{{route('admin.premissions.edit' , ['premission'=>$permission])}}">
                                ویرایش
                            </a>
                        </th>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
