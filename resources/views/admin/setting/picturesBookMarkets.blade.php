@extends('admin.layouts.admin')

@section('title')
@endsection

@section('content')
    <h4>ویرایش عکس های سایت</h4>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">


                    این عکس بصورت خودکار در همه جای سایت شما حذف خواهد شد

                    <form action="{{ route('admin.settindDetail.DestroyPicFromBookmarkets') }}" id="deleteForm"
                        method="post">

                        @csrf

                        <input type="hidden" class="id" name="id" value="1">

                        <input type="submit" class="btn btn-danger" value="حذف">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>

                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="col-6 alert alert-info">

        <label class="text-danger p-3" style="cursor: pointer; margin-right: 30px;" for="images"> برای افزودن عکس جدید
            اینجا کلیک کنید </label>

    </div>



    <div class="form-group col-md-3">
        <div class="custom-file">
            <form action="{{ route('admin.articleImages.store') }}" id="ArticleImagesForm" method="post"
                enctype="multipart/form-data">
                @csrf
                <input style="display: none;" onchange="submitArticleImagesForm()" type="file" multiple name="images[]"
                    id="images">
            </form>


        </div>
    </div>

    @if (Session::has('deleted'))
        <div class="alert alert-danger">

            {{ Session::get('deleted') }}
        </div>
    @endif


    <div class=" row ">
        @foreach ($images as $image)
            <div class="col-1">
                <img src="{{ env('ARTICLE_IMAGES_UPLOAD_PATH') . $image->image }}"
                    style="width: 70px; height: 70px; cursor: pointer;" alt="">

                <button type="button" class="btn btn-danger " onclick="$('.id').val({{ $image->id }})"
                    data-toggle="modal" data-target="#exampleModalCenter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash3" viewBox="0 0 16 16">
                        <path
                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                    </svg>
                </button>

            </div>
        @endforeach

    </div>
@endsection
<script>
    function submitArticleImagesForm() {
        document.getElementById("ArticleImagesForm").submit();
    }
</script>
