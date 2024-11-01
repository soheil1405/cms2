@extends('admin.layouts.admin')


@section('title')
    index OfferCodes
@endsection


@section('content')
    ایحاد کد تخفیف


    <form action="{{ route('admin.odderCodes.store') }}" method="post">

        @csrf


        <div class="form-group">
            <label for="">
                عنوان
            </label>
            <input type="text" required name="name" class="form-control" id="">


        </div>


        <div class="form-group">
            <label for="">
                کد
            </label>
            <input type="text" required name="code" class="form-control" id="">


        </div>

        {{-- <div class="form-group">
            <label for="">
                برای
            </label>

            <select class="form-control" name="for" id="">
                <option value="all">همه</option>
                <option value="all">اسلایدر ها</option>
                <option value="all">استوری ها</option>
                <option value="all">محصولات ویژه</option>
                <option value="all">فروشگاه های ویژه</option>
                <option value="spcv">نردبان محصول </option>
                <option value="spcv">نردبان فروشگاه </option>

            </select>

        </div>
 --}}

        <div class="form-group">
            <label for="">
                وضعیت
            </label>

            <select class="form-control" name="status" id="">
                <option value="1">فعال</option>
                <option value="0">غیر فعال</option>

            </select>

        </div>



        <div class="form-group">
            <label for="">
                میزان تخفیف
            </label>


            <div class="d-flex">

                <input type="number" name="fee"  class="form-control" id="">

                <select name="offerType" class="form-control" id="">
                    <option value="amountable">تومان</option>
                    <option value="percentable">ریال</option>

                </select>


            </div>


        </div>
        <a href="{{ route('admin.odderCodes.index') }}" class="btn btn-danger">انصراف</a>
        <input type="submit" value="ایجاد کد" class="btn btn-success">




    </form>
@endsection
