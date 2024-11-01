@extends('admin.layouts.admin')

@section('title')
    create brands
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد برند</h5>
            </div>
            <hr>


            @if(Session::has('duplicate'))

                <div class="alert alert-danger">{{Session::get('duplicate')}}</div>

            @endif



            @include('admin.sections.errors')
            <form enctype="multipart/form-data" action="{{ route('admin.brands.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام برند</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                    </div>
                    {{-- <div class="form-group col-md-3">
                        <label for="persian_name">  نام فارسی</label>
                        <input class="form-control" id="persian_name" name="persian_name" type="text" value="{{ old('persian_name') }}" >
                    </div> --}}

                    {{--                     

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div> --}}
                    <div class="form-group col-md-3" style="display: flex; flex-direction: column; ">

                        <label style="margin-top:20px;" class="" for="icon">آیکون:</label>
                        <input type="file" name="icon" id="icon">
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>
@endsection
