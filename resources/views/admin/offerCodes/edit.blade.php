@extends('admin.layouts.admin')


@section('title')
    edit OfferCodes
@endsection


@section('content')
    ایحاد کد تخفیف


    <form action="{{ route('admin.odderCodes.update', ['odderCode' => $offerCode->id]) }}" method="post">

        @method('put')
        @csrf


        <input type="hidden" name="id" value="{{ $offerCode->id }}">


        <div class="form-group">
            <label for="">
                عنوان
            </label>
            <input type="text" value="{{ $offerCode->name }}" required name="name" class="form-control" id="">


        </div>


        <div class="form-group">
            <label for="">
                کد
            </label>
            <input type="text" value="{{ $offerCode->code }}" required name="code" class="form-control"
                id="">


        </div>

        {{-- <div class="form-group">
            <label for="">
                برای
            </label>

            <select class="form-control" name="for" id="">

                <option @if ($offerCode->for == 'all') checked @endif value="all">همه</option>
                <option @if ($offerCode->for == 'slider') checked @endif value="slider">اسلایدر ها</option>
                <option @if ($offerCode->for == 'story') checked @endif value="story">استوری ها</option>
                <option @if ($offerCode->for == 'spcP') checked @endif value="spcP">محصولات ویژه</option>
                <option @if ($offerCode->for == 'spcV') checked @endif value="spcV">فروشگاه های ویژه</option>
                <option @if ($offerCode->for == 'laddP') checked @endif value="laddP">نردبان محصول </option>
                <option @if ($offerCode->for == 'laddV') checked @endif value="laddV">نردبان فروشگاه </option>

            </select>

        </div> --}}


        <div class="form-group">
            <label for="">
                وضعیت
            </label>

            <select class="form-control" name="status" id="">

                <option @if ($offerCode->status == '1') checked @endif value="1">فعال</option>
                <option @if ($offerCode->status == '0') checked @endif value="0">غیر فعال</option>

            </select>

        </div>


        <div class="form-group">
            <label for="">
                میزان تخفیف
            </label>


            <div class="d-flex">

                <input type="number" name="fee" value="{{ $offerCode->fee }}" class="form-control" id="">

                <select name="offerType" class="form-control" id="">
                    <option value="amountable" @if ($offerCode->offerType == "amountable") selected  @endif>ریال</option>
                    <option value="percentable"  @if ($offerCode->offerType == "percentable") selected  @endif>درصد</option>

                </select>


            </div>


        </div>



        <a href="{{ route('admin.odderCodes.index') }}" class="btn btn-danger">انصراف</a>
        <input type="submit" value="ایجاد کد" class="btn btn-success">




    </form>
@endsection
