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
    <h1 style="color: black;" class="text-center"> ویرایش لینک جذاب خبری</h1>

    <form action="{{ route('admin.newsLinks.update' , ['newsLink'=>$link] ) }}" method="post" enctype="multipart/form-data">
        @csrf

        @method("put")

        <input type="hidden" name="id" value="{{$link->id}}">

        <div class="m-5">
            <label for="">عنوان لینک</label>
            <input type="text" name="title" value="{{$link->title}}" class="form-control" id="">
        </div>

        <div class="m-5">
            <label for=""> لینک</label>
            <input type="text" name="link"  value="{{$link->link}}" class="form-control" id="">
        </div>
        
        
        <div class="m-5">
            <label for=""> توضیحات</label>
            <textarea type="text" name="discription" class="form-control" id="">{{$link->discription}}</textarea>
        </div>


        <div class="m-4">
            
        <a class="btn btn-secondary" href="{{route('admin.newsLinks.index')}}"> بازگشت</a>
        <input type="submit" value="ذخیره لینک" class="btn btn-primary">
        </div>
        
    </form>
@endsection
