@extends('admin.layouts.admin')


@section('title')
    index brands
@endsection

<style>
    .selected {
        scale: 0.95;
        border: 3px solid red;
    }
</style>

@section('content')
    <h1 style="color: black;" class="text-center">صفحه افزودن مقاله</h1>



    <form method="post" action="{{ route('admin.buyGuidProduct.store') }}" enctype="multipart/form-data">
        @csrf


        <div class="col-12">


            <label class="text-black" for="title">عنوان </label>
            <input class="form-control " required type="text" name="title" id="" value="{{old('title')}}">


        </div>

        <div class="col-12">


            <label class="text-black" for="pre_show"> انتخاب محصول(اختیاری) </label>

            <select name="category_id" class="selectpicker" aria-label="Default select example" data-live-search="true">

                <option value="">هیچ کدام</option>

                @foreach ($catgegories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <textarea name="body" required id="content" class="ckeditor" rows="6">{{old('body')}}</textarea>
        </div>



        <input type="submit" class="btn btn-success" value="ذخیره ">
    </form>
@endsection


<script src={{ asset('ckeditor/ckeditor.js') }}></script>



<script type="text/javascript">
    function submitArticleImagesForm() {
        document.getElementById("ArticleImagesForm").submit();
    }


    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>




<script type="text/javascript">
    CKEDITOR.replace('content', {
        language: 'fa'
    });

    function copyUrl(id) {


    }
</script>
