@extends('admin.layouts.admin')

@section('title')
    create categories
@endsection

@section('script')
    <script>
        $('#attributeSelect').selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $('#attributeSelect').on('changed.bs.select', function() {
            let attributesSelected = $(this).val();
            let attributes = @json($attributes);

            let attributeForFilter = [];

            attributes.map((attribute) => {
                $.each(attributesSelected, function(i, element) {
                    if (attribute.id == element) {
                        attributeForFilter.push(attribute);
                    }
                });
            });

            $("#attributeIsFilterSelect").find("option").remove();
            $("#variationSelect").find("option").remove();
            attributeForFilter.forEach((element) => {
                let attributeFilterOption = $("<option/>", {
                    value: element.id,
                    text: element.name
                });

                let variationOption = $("<option/>", {
                    value: element.id,
                    text: element.name
                });

                $("#attributeIsFilterSelect").append(attributeFilterOption);
                $("#attributeIsFilterSelect").selectpicker('refresh');

                $("#variationSelect").append(variationOption);
                $("#variationSelect").selectpicker('refresh');
            });


        });

        $("#attributeIsFilterSelect").selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $("#variationSelect").selectpicker({
            'title': 'انتخاب متغیر'
        });
    </script>
@endsection

@section('content')


    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <div class="alert alert-danger">
                {{ $item }}
            </div>
        @endforeach
    @endif


    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد دسته بندی</h5>
            </div>
            <hr>

            @include('admin.sections.errors')

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text"
                            value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="parent_id">والد</label>
                        <select class="form-control" id="parent_id" data-live-search="true" name="parent_id">
                            <option value="0">بدون والد</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <div class="">
                    @foreach ($images as $img)
                        <?php $link = env('ARTICLE_IMAGES_UPLOAD_PATH') . $img->image;
                        
                        $link2 = asset($link);
                        
                        ?>
                        <img src="{{ $link }}" style="width: 150px; cursor: pointer;"
                            onclick="copyUrl({{ $img->id }})" alt="">




                        {{-- <span id="id({{ $img->id }})" class="linkspan" style="display: none">

                            برای استفاده از این عکس لینک

                            <br>
                            {{ $link2 }}
                            <br>

                            را کپی کنید و در cdEditor استفاده کنید ....


                        </span> --}}
                    @endforeach
                </div>

                <label class="text-danger" style="cursor: pointer" for="images"> برای افزودن عکس جدید اینجا کلیک کنید ...
                </label>



                <div id="divLink" class="">

                </div>






                <div class="form-group">
                    <textarea name="description" id="content" class="ckeditor" rows="6">{{ old('description') }}</textarea>
                </div>









                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
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
