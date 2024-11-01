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
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست راهتما های خرید کالا</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.buyGuidProduct.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد مورد جدید
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>

                            <th> عنوان </th>
                            <th>دسته</th>
                            <th>سازنده</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($items as $item)
                            <tr>
                                <th>
                                    {{ $item->id }}
                                </th>

                                <th>
                                    {{ $item->title }}
                                </th>

                                <th>

                                    @if ($item->category)
                                        {{ $item->category->name }}
                                    @else
                                    دسته انتخاب نشده
                                    @endif
                                </th>

                                <th>
                                    {{ $item->creator->name }}
                                </th>
                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($item->created_at) }}

                                </th>


                                <th>
                                    

                                    <form onSubmit="return confirm('ایا از حذف این لینک اطمینان دارید؟') "
                                        action="{{ route('admin.buyGuidProduct.destroy', ['buyGuidProduct' => $item]) }}"
                                        method="post">

                                        @method('DELETE')

                                        @csrf

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" value="حذف" class="btn btn-danger">


                                        <a href="{{ route('admin.buyGuidProduct.edit', ['buyGuidProduct' => $item]) }}"
                                            class="btn btn-sm btn-primary">
                                            ویرایش
                                        </a>

                                        <a href="{{ route('admin.buyGuidproducts.show', ['buyGuidProduct' => $item]) }}"
                                            class=" btn btn-sm btn-outline-primary"> نمایش </a>

                                    </form>





                                            




                                </th>



                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
