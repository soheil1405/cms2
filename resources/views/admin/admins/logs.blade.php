@extends('admin.layouts.admin')

@section('title')
    تاریخچه کاربر
@endsection





@section('content')
    <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">بازگشت</a>
    
    آخرین لاگ های {{$user->name}}

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">

            <thead>
                <tr>

                    <th>کد لاگ</th>
                    <th>
                        تاریخ
                    </th>
                    <th>route name</th>
                    <th>
                        status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $item)
                   
                <tr>

                    <td>
                        {{$item->id}}
                    </td>
                    
                    
                    <td>
                        {{ \Morilog\Jalali\Jalalian::forge($item->created_at) }}


                    </td>
                    
                    <td>
                        {{$item->url}}
                    </td>
                    
                    <td>
                        @if($item->status == "200")


                        <span class="text-success">{{$item->status}} </span>

                        @else

                        <span class="text-danger">{{$item->status}} </span>


                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.adminslogsShow' , ['id'=>$item->id])}}" class="btn btn-info">مشاهده</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
