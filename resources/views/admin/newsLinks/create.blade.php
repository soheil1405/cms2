@extends('admin.layouts.admin')

@section('title')

ساخت لینک جذاب خبری
@endsection

<style>
    .selected {
        scale: 0.95;
        border: 3px solid red;
    }
</style>

@section('content')
    <h1 style="color: black;" class="text-center">صفحه افزودن لینک جذاب خبری</h1>

    <form action="{{ route('admin.newsLinks.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="m-5">

            <label for="">عنوان لینک</label>
            <input type="text" name="title" class="form-control" id="">

        </div>

        <div class="m-5">

            <label for=""> لینک</label>
            <input type="text" name="link" class="form-control" id="">

        </div>
        <div class="m-5">


            <label for=""> عکس</label>
            <input type="file" name="pic" class="form-control" id="">

        </div>
        
        <div class="m-5">

            <label for=""> توضیحات
            </label>
            <textarea type="text" name="discription" class="form-control" id=""></textarea>

        </div>


        <div class="m-4">
            
        <a class="btn btn-secondary" href="{{route('admin.newsLinks.index')}}">
            بازگشت
        </a>
        <input type="submit" value="ذخیره لینک" class="btn btn-primary">
        </div>
        
    </form>
@endsection
