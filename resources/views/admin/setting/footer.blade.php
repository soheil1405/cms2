@extends('admin.layouts.admin')

@section('title')
    edit categories
@endsection

@section('script')
@endsection

<style>
    .colsed {
        height: 0px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .activ {
        height: auto;
        transition: all 0.3s;
    }
</style>

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش صفحه فوتر : </h5>
            </div>
            <hr>

            @include('admin.sections.errors')

            <form class="col-12" method="POST" action="{{ route('admin.settindDetail.questions.update') }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="">


                    <div class="form-row">

                        <div class="form-group col-12">
                            <textarea name="footerText" id="content" class="ckeditor" rows="6"> {!! $setting_detail->footerText !!} </textarea>
                        </div>
    
                    </div>

                    <hr>




                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.settindDetail.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>


            </form>




        <div class="">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                افزودن لینک جدید

            </button>
        </div>




            لینک های موجود در فوتر

            @foreach ($footerLinks as $link)
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary"
                    onclick="
                    
                    
                    
                    $('.activ').addClass('closed');
                    
                    $('.activ').removeClass('activ');

                    $(this).next().removeClass('closed');
                    $(this).next().addClass('activ');
                    
                    
                    
                    ">

                    {{ $link->name }}

                </button>

                <!-- Modal -->
                <div class="colsed">
                    <div class="">
                        <h5 class="" id="exampleModalLabel">ویرایش لینک {{ $link->name }}</h5>

                    </div>



                    <form action="{{ route('admin.settindDetail.questions.update') }}" method="post">

                        @method('PUT')
                        @csrf
                        <div class="">

                            <label for="name">نام لینک</label>

                            <input type="text" name="name" id="name" required class="form-control"
                                value="{{ $link->name }}">


                        </div>


                        <div class="">
                            <label for="link"> لینک </label>
                            <input type="link" name="link" id="link" required class="form-control"
                                value="{{ $link->link }}">
                        </div>

                        <input type="hidden" name="id" value="{{ $link->id }}">
                        <input type="submit" name="submit" value="ویرایش لینک" class="btn btn-primary">


                    </form>



                    <div class="">

                        <form action="{{ route('admin.settindDetail.link.delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $link->id }}">
                            <button type="submit" class="text-danger">حذف لینک</button>
                        </form>

                        <button type="button" class="btn btn-secondary"
                            onclick="
                                                        
                             $('.activ').addClass('closed');
                        
                             $('.activ').removeClass('activ');
                                
                                ">لغو</button>
                    </div>
                </div>
            @endforeach
        </div>



            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">افزودن لینک جدید</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('admin.settindDetail.link.store') }}" method="post">

                                @csrf
                                <div class="">

                                    <label for="name">نام لینک</label>

                                    <input type="text" name="name" id="name" required class="form-control">


                                </div>


                                <div class="">
                                    <label for="link"> لینک </label>
                                    <input type="link" name="link" id="link" required class="form-control">
                                </div>
                                <input type="submit" name="submit" value="ذخیره لینک" class="btn btn-primary">


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>

                        </div>
                    </div>
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
