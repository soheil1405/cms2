@extends('admin.layouts.admin')

@section('title')
    ویرایش مقاله
@endsection

@section('content')






@if ($errors->any())

@foreach ($errors->all() as $error)

<li>
    {{$error}}

</li>


@endforeach
    
@endif








<form action="{{ route('admin.UserArticles.update', ['UserArticle' => $article]) }}" method="post"
        enctype="multipart/form-data">


        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{$article->id}}">

        <div class="m-5">

            <label for="">عنوان مقاله</label>
            <input type="text" required name="name" value="{{ $article->name }}" class="form-control" id="">

        </div>

        <div class="m-5">

            {!! $article->body !!}
        </div>








        <div class="m-5">
            <label for="">سایر توضیحات(ذکر منبع و توضیحات بیشتر)</label>
            <textarea name="disc" class="form-control" id="" cols="30" required rows="10">{{ $article->discreption }}</textarea>

        </div>

        <a href="{{ route('admin.UserArticles.index') }}" class="btn btn-danger">انصراف</a>
        <input type="submit" value="ذخیره مقاله" class="btn btn-primary">

</form>
@endsection
