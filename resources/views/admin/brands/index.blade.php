@extends('admin.layouts.admin')

@section('title')
    index brands
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">


                    با حذف این برند تمامی محصولات آن به دسته بدون برند انتقال داده خواهند شد

                    <form action="{{ route('admin.deleteBRand') }}" id="deleteForm" method="post">

                        @csrf

                        <input type="hidden" class="brandId" name="brandId" value="1">

                        <input type="submit" class="btn btn-danger" value="حذف">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>

                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>



    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست برند ها ({{ count($brands) }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.brands.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد برند
                </a>
            </div>

            <div class="table-responsive">
                <table id="" class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>

                            <th>id</th>
                            <th>آیکون</th>
                            <th>نام</th>
                            <th>وضعیت</th>
                            <th>سازنده</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $brand)
                            <tr>

                                <th>
                                    {{ $brand->id }}
                                </th>
                                <th>

                                    <img src="{{ url(env('BRAND_ICON_UPLOAD_PATH') . $brand->icon_name) }}"
                                        style="width:100px; height:100px;" alt="">
                                </th>
                                <th>
                                    <a href="{{ route('showByBrand', ['brand' => $brand->id]) }}">

                                        {{ $brand->name }}
                                    </a>
                                </th>
                                <th>
                                    <span
                                        class="{{ $brand->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                        {{ $brand->is_active }}
                                    </span>
                                </th>
                                <th>
                                    @if (!is_null($brand->vendor))
                                        <small class="text-danger">
                                            {{ $brand->vendor->name }}
                                        </small>
                                    @else
                                        ادمین
                                    @endif
                                </th>
                                <th>

                                    <button type="button" class="btn btn-danger mr-3 mb-1"
                                        onclick="$('.brandId').val({{ $brand->id }})" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        حذف
                                    </button>



                                    <a class="btn btn-sm btn-outline-info mr-3"
                                        href="{{ route('admin.brands.edit', ['brand' => $brand->id]) }}">ویرایش</a>

                                    @if (!$brand->getRawOriginal('is_active'))
                                        <form action="{{ route('admin.brands.update', ['brand' => $brand->id]) }}"
                                            method="POST">

                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $brand->id }}">

                                            <input type="submit" value="تایید" class="btn btn-success">
                                        </form>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal2" onclick="$('#BrandTochang').val({{ $brand->id }})">

                                            انتقال به برند موجود
                                        </button>
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{-- {{ $brands->render() }} --}}
                {{-- <div> {{ $brands->links() }}</div> --}}

            </div>
        </div>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.changeBrand') }}" method="post">

                    <div class="modal-body">




                        @csrf

                        <div class=" d-flex">
                            <select name="brand_id" data-live-search="true" id="brandSelect">


                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" class="form-control">{{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>



                            <input type="hidden" name="id" id="BrandTochang" value="">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">لغو</button>
                            <button type="submit" class="btn btn-primary"> انتقال </button>
                        </div>

                </form>

            </div>
        </div>
    </div>
@endsection
