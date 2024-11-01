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



@extends('admin.layouts.admin')

@section('title')
    edit categories
@endsection

@section('script')
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
             
                <div class="modal-body">

                    آیا از حذف این ویدیو اطمینان دارید ؟

                    <form action="{{ route('admin.settindDetail.deleteFile')}}" id="deleteForm" method="post">

                        @csrf
                        @if($setting_detail->vendor_video_name)
                        <input type="hidden" name="vendorPageGuid" value="1">
                        <input type="hidden" name="page" value="vendor">
                        <input type="hidden" name="fileName" value="{{ env('SETTING_VIDEOS_UPLOAD_PATH') . $setting_detail->vendor_video_name }}" >
                        <input type="submit" class="btn btn-danger"  value="حذف">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >لغو</button>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>



    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش صفحه (راهنمای صفحه فروشگاه) : </h5>
            </div>
            <hr>













            @include('admin.sections.errors')

            <form class="col-12" method="POST" action="{{ route('admin.settindDetail.questions.update') }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
            
            
                <div class="mb-4 text-center text-md-right">
                   
                    <label for="">title :</label>
                    <input type="text" value="{{$setting_detail->guidVTitle}}" class="form-controll" name="guidVTitle">
                    
                </div>

                <div class="mb-4 text-center text-md-right">
                    <label for="">icon :</label>
                    <input type="file" class="form-control" name="guidVendorPic">
                    
                </div>



                <hr>
    
            
            
            
            
            
            
            
            
                <div class="form-row">





                    <div class="form-group col-12">
                        <textarea name="VendortPage_guid_Text" id="content" class="ckeditor" rows="6"> {!! $setting_detail->VendortPage_guid_Text !!} </textarea>
                    </div>

                </div>


                <div class="">

                    <label for=""> لینک فیلم در آپارات </label>

                    <input type="text" class="form-control" value="{{ $setting_detail->aparat_vendor }}"
                        name="aparat_vendor">
                        <span class="btn btn-danger"  onclick="deleteAparatAdd()" >
                            حذف لینک آپارات
                        </span>
    
                </div>

                <div class="">

                    <label for=""> آپلود فیلم </label>

                    <input type="file" class="form-control" name="vendor_video_name"
                        value="{{ $setting_detail->vendor_video_name }}">

                </div>


                {{--
                    
                    
                    اینجا باید فیلمو نشون بدم

                     --}}


                @if ($setting_detail->vendor_video_name)
                    <div class="col-12">

                        <video controls>
                            <source src="{{ env('SETTING_VIDEOS_UPLOAD_PATH') . $setting_detail->vendor_video_name }}"
                                type="video/webm" />
                        </video>


                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                            حذف ویدیو
                        </button>


                    </div>
                @endif




                گالری عکس ها :
                <div class="col-12">
                    @foreach ($images as $img)
                        <?php $link = env('ARTICLE_IMAGES_UPLOAD_PATH') . $img->image;
                        
                        $link2 = asset($link);
                        
                        ?>
                        <img src="{{ $link }}" style="width: 150px; height:150px;  cursor: pointer;"
                            onclick="copyUrl({{ $img->id }})" alt="">
                    @endforeach




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
        <form action="{{ route('admin.settindDetail.questions.update') }}" id="deleteAparatVideoForm" method="post">

            @csrf
            @method('PUT')

            <input type="hidden" name="delete_Vendor_AparatVideoForm" value="1" >

        </form>

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


    function deleteAparatAdd(){
        $('#deleteAparatVideoForm').submit();
    }
</script>
