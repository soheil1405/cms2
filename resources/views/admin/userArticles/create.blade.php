@extends('admin.layouts.admin')

@section('title')
    ایجاد مقاله
@endsection

@section('content')





<form action="{{route('user.UserArticles.store')}}" method="post" enctype="multipart/form-data">

    @csrf


    <div class="m-5">
        
    <label for="">عنوان مقاله</label>
    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="">

    </div>

    <div class="m-5">
        
    <label for="">فایل مقاله( word)</label>
    <input type="file" name="file" accept=".docx"   class="form-control" id="">

    </div>


    
    
    
    
    
    
    <div class="m-5">
        <label for="">سایر توضیحات(ذکر منبع و توضیحات بیشتر)</label>
    <textarea name="disc" class="form-control" id="" cols="30" rows="10"></textarea>
    
    </div>
    
    <a href="{{route('user.UserArticles.index')}}" class="btn btn-danger">انصراف</a>
    <input type="submit" value="ذخیره مقاله" class="btn btn-primary">
    
</form>



@if ($errors->any())

@foreach ($errors->all() as $error)

<li>
    {{$error}}

</li>


@endforeach
    
@endif










@endsection
