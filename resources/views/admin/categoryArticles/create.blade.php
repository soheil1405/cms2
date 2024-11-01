<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="{{ asset('main/datepicker/datepicker.css') }}" />
    <script src="{{ url('jquery/jquery.min.js') }}"></script>

    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />

    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    @yield('style')

<style>
    .selected {
        scale: 0.90;
        border: 3px solid red;
    }
</style>

</head>
<body>
<h1 style="color: black;" class="text-center">صفحه افزودن مقاله</h1>


    <div class="col-12 d-flex">

        <div class="col-6 alert alert-danger">
            <p style="color: black; margin-right: 30px;"> از بین عکس های زیر عکس اصلی مقاله را انتخاب کنید </p>

            <p style="color: black; margin-right: 30px;">برای استفاده از عکس ها در مقاله باید عکس مورد نظر را در ادیتور drag
                کنید</p>
        </div>

        <div class="col-6 alert alert-info">

            <label class="text-danger p-3" style="cursor: pointer; margin-right: 30px;" for="images"> برای افزودن عکس جدید
                اینجا کلیک کنید </label>

        </div>



    </div>



    <div class="card-body">
        <form method="post" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-12  row">

                <div class="col-3" style="height:500px ;overflow-y:scroll;">

                    @foreach ($images as $img)
                    <?php $link = env('ARTICLE_IMAGES_UPLOAD_PATH') . $img->image;
                    
                    $link2 = asset($link);
                    
                    ?>
                    <label class="" for="main_img({{ $img->id }})">
                        <img src="{{ $link }}" style="width: 150px; height: 150px; cursor: pointer;" alt="">
                    </label>
                    <input type="radio" style="display: none" required class="main_img"
                        onchange=" $('.selected').removeClass('selected');   ;$(this).prev().addClass('selected');"
                        value="{{ $img->image }}" name="main_img" id="main_img({{ $img->id }})">
                @endforeach
    
                </div>

                <div class="col-8">

                    <div class="col-12 " style="border-top:2px">


                        <label class="text-black" for="title">عنوان مقاله</label>
                        <input class="form-control " required type="text" name="title" id="">


                    </div>

                    <div class="col-12">


                        <label class="text-black" for="pre_show"> متن پیش نمایش </label>
                        <input class="form-control " required type="text" name="pre_show" id="pre_show">


                    </div>

                    <div class="form-group">
                        <textarea name="body" required id="content" class="ckeditor" rows="6"></textarea>
                    </div>


                </div>
            </div>

            <input type="submit" class="btn btn-success m-auto" value=" ذخیره مقاله">
            <a href="{{route('admin.articles.index')}}" class="btn btn-danger">بازگشت</a>
        </form>



        <div class="form-group col-md-3">
            <div class="custom-file">
                <form action="{{ route('admin.articleImages.store') }}" id="ArticleImagesForm" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input style="display: none;" onchange="submitArticleImagesForm()" multiple type="file" name="images"
                        id="images">
                </form>


            </div>
        </div>


    </div>

</body>
    

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
</html>