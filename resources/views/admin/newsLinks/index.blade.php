@extends('admin.layouts.admin')

@section('title')
    index brands
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        @if (Session::has('ok'))
            <div class="alert alert-success">
                {{ Session::get('ok') }}
            </div>
        @endif
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست لینک های خبری</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.newsLinks.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد لینک جدید
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th> عکس اصلی </th>
                            <th> عنوان لینک </th>
                            <th>سازنده</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>



                        @foreach ($links as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>

                                <td>
                                    <img style="width: 50px;" src="{{url(env('NEWS_LINKS_PICS').$item->pic)}}" alt="">
                                </td>
                                <td>
                                    {{ $item->title }}
                                </td>
                                <td>
                                    {{ $item->creator->name }}
                                </td>
                                <td>
                                    {{ \Morilog\Jalali\Jalalian::forge($item->created_at) }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.newsLinks.edit', ['newsLink' => $item]) }}"
                                        class="btn btn-info">ویرایش </a>

                                    <form onSubmit="return confirm('ایا از حذف این لینک اطمینان دارید؟') "
                                        action="{{ route('admin.newsLinks.destroy', ['newsLink' => $item]) }}"
                                        method="post">

                                        @method('DELETE')

                                        @csrf

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" value="حذف" class="btn btn-danger">



                                    </form>


                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
