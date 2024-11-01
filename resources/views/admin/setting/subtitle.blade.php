@extends('admin.layouts.admin')

@section('title')
@endsection


@section('content')
    <form action="{{ route('admin.settindDetail.questions.update') }}" method="post">

        @csrf

        @method('PUT')

        متن زیر نویس
        <input type="text" name="subtitle" class="form-control" value="{{ $setting->subtitle }}" id="">

        <input type="submit" value="ذخیره"class="btn btn-success">
        <a href="{{ route('admin.settindDetail.index') }}" class="btn btn-danger">
            بازپشت
        </a>
    </form>
@endsection
