@extends('admin.layouts.admin')

@section('title')
    edit categories
@endsection

@section('script')
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش صفحه تماس یا ما : </h5>
            </div>
            <hr>

            @include('admin.sections.errors')

            <form class="col-12" method="POST" action="{{route('admin.settindDetail.questions.update')}}"  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">





                    <div class="form-group col-12">
                        <textarea name="contact_us" id="content" class="ckeditor" rows="6"> {!! $setting_detail->contact_us !!} </textarea>
                    </div>

                </div>



                <div class="col-12">
                    @foreach ($images as $img)
                        <?php $link = env('ARTICLE_IMAGES_UPLOAD_PATH') . $img->image;
                        
                        $link2 = asset($link);
                        
                        ?>
                        <img src="{{ $link }}" style="width: 150px; cursor: pointer;"
                            onclick="copyUrl({{ $img->id }})" alt="">
                    @endforeach
                </div>

                <div class="col-12">

                    <label class="text-danger" style="cursor: pointer" for="images"> برای افزودن عکس جدید اینجا کلیک کنید
                        ... </label>

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.settindDetail.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>


            </form>




            <div class="form-group col-md-3">
                <div class="custom-file">
                    <form action="{{ route('admin.articleImages.store') }}" id="ArticleImagesForm" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input style="display: none;" onchange="submitArticleImagesForm()" type="file" name="images"
                            id="images">
                    </form>


                </div>
            </div>



        </div>

    </div>
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

        var cuurect_id = id;

        console.log(cuurect_id);
        document.getElementById(`id(${cuurect_id})`).style.display = "block";

        setTimeout(() => {
            document.getElementById(`id(${cuurect_id})`).style.display = "none";

        }, "10000")
    }
</script>
