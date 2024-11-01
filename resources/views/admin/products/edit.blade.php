@extends('admin.layouts.admin')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">



<link rel="stylesheet" href="{{ asset('Croppie-master/croppie.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<script src="{{ asset('Croppie-master/croppie.min.js') }}"></script>




@section('title')
    edit products
@endsection



<script>
    $('.brandSelect').selectpicker({
        'title': 'انتخاب برند'
    });
    let variations = @json($productVariations);
    variations.forEach(variation => {
        $(`#variationDateOnSaleFrom-${variation.id}`).MdPersianDateTimePicker({
            targetTextSelector: `#variationInputDateOnSaleFrom-${variation.id}`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        $(`#variationDateOnSaleTo-${variation.id}`).MdPersianDateTimePicker({
            targetTextSelector: `#variationInputDateOnSaleTo-${variation.id}`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });
    });
    $('#categorySelect').selectpicker({
        'title': 'انتخاب دسته بندی'
    });






    // $('#attributesContainer').hide();
    // $('#categorySelect').on('changed.bs.select', function() {
    //     let categoryId = $(this).val();

    //     $.get(`{{ url('/vendor-dashboard/category-attributes/${categoryId}') }}`, function(response,
    //         status) {
    //         if (status == 'success') {
    //             // console.log(response);

    //             $('#attributesContainer').fadeIn();

    //             // Empty Attribute Container
    //             $('#attributes').find('div').remove();

    //             // Create and Append Attributes Input
    //             response.attrubtes.forEach(attribute => {
    //                 let attributeFormGroup = $('<div/>', {
    //                     class: 'form-group col-md-3'
    //                 });
    //                 attributeFormGroup.append($('<label/>', {
    //                     for: attribute.name,
    //                     text: attribute.name
    //                 }));

    //                 attributeFormGroup.append($('<input/>', {
    //                     type: 'text',
    //                     class: 'form-control',
    //                     id: attribute.name,
    //                     name: `attribute_ids[${attribute.id}]`
    //                 }));

    //                 $('#attributes').append(attributeFormGroup);

    //             });

    //             $('#variationName').text(response.variation.name);

    //         } else {
    //             alert('مشکل در دریافت لیست ویژگی ها');
    //         }
    //     }).fail(function() {
    //         alert('مشکل در دریافت لیست ویژگی ها');
    //     });
    // });

    // $("#czContainer").czMore();


    function searchcat() {




        var chars = $('#searchIncats').val();


        formData = {
            chars: chars
        };
        $.ajax({
            type: "POST",
            url: '/searchCategoryAjax',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                var e = document.querySelector("#searchCatResult");

                var child = e.lastElementChild;
                while (child) {


                    e.removeChild(child);
                    child = e.lastElementChild;
                }
                data.forEach(element => {

                    console.log(element);

                    $("<input/>", {

                        id: 'catId_' + element.id,
                        type: 'radio',
                        value: element.id,
                        class: 'd-none',
                        onchange: 'showSelected(' + element + ')',
                        name: 'category_id',

                    }).appendTo(e);
                    $("<label/>", {

                        id: 'searchResultItem',
                        class: 'vazirFont text-black searchResultItem',
                        html: element.name,
                        for: "catId_" + element.id,


                    }).appendTo(e);

                });







                // 
                // console.log('lvlThree :');

                // data.lvlThree.forEach(element => {

                //     console.log(element);

                //     $("<label/>", {

                //         id: 'searchResultItem',
                //         class: 'vazirFont text-black searchResultItem',
                //         html: element.name,
                //         for: "categorySelect(" + element.id + ")"


                //     }).appendTo(e);


                // });


                // console.log('lvlTwo :');

                // data.lvlTwo.forEach(element => {

                //     console.log(element);

                //     $("<label/>", {

                //         id: 'searchResultItem',
                //         class: 'vazirFont text-black searchResultItem',
                //         html: element.name,
                //         for: "categorySelect(" + element.id + ")"


                //     }).appendTo(e);


                // });





            },
            error: function(data) {
                console.log(data.responseJSON.message);



            }
        });






    }


    function SubmitAddNewBrandForm() {
        if ($('#BrandName').val() == "") {
            $('#BrandFormError').css('display', 'block');
        } else {
            $('#save').click(function(e) {});
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            formData = {
                BrandName: $('#BrandName').val(),
                vendor_id: $('#vendor_id').val()
            }
            $.ajax({
                type: "POST",
                url: "https://zivar-shop.ir/vendor-dashboard/createBrand",
                data: formData,
                dataType: 'json',
                success: function(data) {

                    console.log(data);

                    var newBrand = '<option value="' + data.id + '"> ' + data.name + '</option>';


                    console.log(newBrand);

                    if (newBrand) {
                        $('#brandSelect').append(newBrand);
                        alert('برند مورد نظر با موفقیت ثبت شد و اکنون در لیست برند ها در دسترس می باشد');
                    }
                    jQuery('#BrandFormError').trigger("reset");
                    jQuery('#brnadModal').modal('hide')
                },
                error: function(data) {
                    alert('برند مورد نظر موجود می باشد');
                }
            });
        }


    }





    // Show File Name
    $('#primary_image').change(function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });

    $('#images').change(function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });


    function openWarantyModal() {

        if ($('#waranty').val() == '1') {

            $('.hasWarantyInputs').css('display', 'flex');
        }
    }







    function saveWaranty() {

        if ($('#waranty').val() == '1') {




            if ($('#inputNumberWaranty').val() != "") {

                var inputNumberWaranty = $('#inputNumberWaranty').val();
                var WarrantyDuration = $('#WarrantyDuration').val();
                var ProductWarranty = inputNumberWaranty + WarrantyDuration;
                console.log(ProductWarranty);
                $('#warrantyInputHidden').val(ProductWarranty);
                $('.modal').modal('hide');
                $('#newWarranty').html(ProductWarranty);

            } else {
                alert('مدت زمان گارانتی نمیتواند خالی باشد');
            }

        } else {
            $('#hasWarantyInputs').css('display', 'none');
            $('.modal').modal('hide');

        }

    }

    $("input[type='search']").keyup(function(e) {

        $('#BrandNameForm').val($(this).val());



        var count = $(".inner ul").children().children().length;

        $('#addnewBrandBt').css('display', 'none');

        if (count < 1) {


            $('#addnewBrandBt').css('display', 'block');
        }




    });


    $(function() {

        var Ppay = localStorage.getItem("Ppay");

        if (Ppay) {
            $('#product_price').val(Ppay);

        }

        var Pname = localStorage.getItem("Pname");

        if (Pname) {

            $('#name').val(Pname);

        }


        var pDesc = localStorage.getItem("Pdesc");

        if (pDesc) {

            $('#description').val(pDesc);

        }

        localStorage.clear();


    });







    function addNewBrandddd() {


        localStorage.setItem("Ppay", $('#product_price').val());
        localStorage.setItem("Pname", $('#name').val());
        localStorage.setItem("Pdesc", $('#description').val());


        $('#AddNewBrandForm2').submit();
    }





    function submitAllEdits() {

        $('#photoForm').submit();
    }


    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })



    //     $('#images').ijaboCropTool({
    //       preview : '.image-previewer',
    //       setRatio:1,
    //       allowedExtensions: ['jpg', 'jpeg','png'],
    //       buttonsText:['CROP','QUIT'],
    //       buttonsColor:['#30bf7d','#ee5155', -15],

    //       processUrl: "https://zivar-shop.ir/vendor-dashboard/products/"+ {{ $product->id }} +"/images-add " ,

    //       withCSRF:['_token','{{ csrf_token() }}'],
    //       onSuccess:function(data){

    //     },
    //       onError:function(data){

    //         console.log(data);
    //     }
    //    });file


    // $('#images').ijaboCropTool({
    //     preview: '.image-previewer',
    //     setRatio: 1,
    //     allowedExtensions: ['jpg', 'jpeg', 'png'],
    //     buttonsText: ['CROP', 'QUIT'],
    //     buttonsColor: ['#30bf7d', '#ee5155', -15],
    //     processUrl: "www.google.com ",
    //     onSuccess: function(message, element, status) {
    //         alert(message);
    //     },
    //     onError: function(message, element, status) {
    //         alert(message);
    //     }
    // });



    function editCat(categoryId) {

        console.log(categoryId);
        console.log('sadsd');

        var chooded_cat_name = $("label[for='categorySelect(" + categoryId + ")']").text();

        $('#editCat').css('display', 'none');


        $('#old_cat').text(chooded_cat_name);
        $('#choosCatBT').css('display', 'block');

    }

    function showEditCats() {

        $('#editCat').css('display', 'block');

        $('#choosCatBT').css('display', 'none');




    }
</script>

<style>
    li {
        list-style-type: none;
    }

    nav ul ul {
        display: none;
    }

    nav ul li:hover>ul {
        display: block;
    }


    .first_ul {
        background: #efefef;
        background: linear-gradient(top, #efefef 0%, #bbbbbb 100%);
        background: -moz-linear-gradient(top, #efefef 0%, #bbbbbb 100%);
        background: -webkit-linear-gradient(top, #efefef 0%, #bbbbbb 100%);
        box-shadow: 0px 0px 9px rgba(0, 0, 0, 0.15);
        padding: 0 20px;

        list-style: none;
        position: relative;
        width: 100%;

        display: inline-table;
    }

    .first_ul:after {
        content: "";
        clear: both;
        display: block;

    }

    .first_ul li {}

    .first_ul li:hover {
        background: #4b545f;
        background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
        background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
        background: -webkit-linear-gradient(top, #4f5964 0%, #5f6975 40%);
    }

    nav ul li:hover a {
        color: #fff;
    }

    nav ul li a {
        width: 100%;
        display: block;
        padding: 25px 40px;
        color: #757575;
        text-decoration: none;
    }


    nav ul ul {
        background: #5f6975;
        border-radius: 0px;
        padding: 0;
        position: absolute;
        top: 100%;
    }

    nav ul ul li {
        float: none;
        border-top: 1px solid #6b727c;
        border-bottom: 1px solid #575f6a;
        position: relative;
    }

    nav ul ul li a {
        padding: 15px 40px;
        color: #fff;
    }

    nav ul ul li a:hover {
        background: #4b545f;
    }


    nav ul ul ul {
        position: absolute;
        left: 100%;
        top: 0;
    }
</style>



<style>
    #preview img {
        max-height: 100px;
    }

    .activeCat {
        display: block !important;
    }


    .activeCat2 {
        display: block !important;
    }

    .row::-webkit-scrollbar {
        display: none;
    }



    a {
        text-decoration: none !important;
    }


    #deleteImgs a {
        cursor: pointer;
        color: white;
        margin: 0px 25px;
        padding: 2px;
        width: 80px;
        /* background-color: red; */
    }

    #deleteImgs a:hover {
        background-color: rgb(128, 5, 5);

    }

    li {
        list-style-type: none;
    }

    nav ul ul {
        display: none;
    }

    nav ul li:hover>ul {
        display: block;
    }


    .first_ul {
        background: #efefef;
        background: linear-gradient(top, #efefef 0%, #bbbbbb 100%);
        background: -moz-linear-gradient(top, #efefef 0%, #bbbbbb 100%);
        background: -webkit-linear-gradient(top, #efefef 0%, #bbbbbb 100%);
        box-shadow: 0px 0px 9px rgba(0, 0, 0, 0.15);


        list-style: none;
        position: relative;
        width: 100%;

        display: inline-table;
    }

    .first_ul:after {
        content: "";
        clear: both;
        display: block;

    }

    .first_ul li {}

    .first_ul li:hover {
        background: #4b545f;
        background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
        background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
        background: -webkit-linear-gradient(top, #4f5964 0%, #5f6975 40%);
    }

    nav ul li:hover a {
        color: #fff;
    }

    nav ul li a {
        width: 100%;
        display: block;
        padding: 8px 27px;
        color: #757575;
        text-decoration: none;
    }


    nav ul ul {
        background: #5f6975;
        border-radius: 0px;
        padding: 0;
        position: absolute;
        top: 100%;
    }

    nav ul ul li {
        float: none;
        border-top: 1px solid #6b727c;
        border-bottom: 1px solid #575f6a;
        position: relative;
    }

    nav ul ul li a {
        padding: 15px 40px;
        color: #fff;
    }

    nav ul ul li a:hover {
        background: #4b545f;
    }


    nav ul ul ul {
        position: absolute;
        left: 100%;
        top: 0;
    }




    label:hover {
        background-color: rgb(230, 128, 128);
    }

    .searchResultItem :hover {
        background-color: rgb(230, 128, 128);

    }
</style>

<script>
    function openCat(id) {
        console.log(id);
        $('.activeCat').removeClass('activeCat');
        $('.no').removeClass('no');
        $('.ClosCattt').addClass('no');
        $('.closeCat_' + id).removeClass('no');
        $('.openCat_' + id).addClass('no');
        $('#cat_' + id + '_child').addClass('activeCat');
    }

    function openCat2(id) {
        console.log(id);
        $('.activeCat2').removeClass('activeCat2');
        $('.no1').removeClass('no1');


        $('.openCat_' + id).removeClass('no1');
        // $('.openCattt1').removeClass('no1');

        $('.ClosCattt1').addClass('no1');



        $('.openCat_' + id).addClass('no1');
        $('.closeCat_' + id).removeClass('no1');
        // $('.openCat_' + id).addClass ('no1');
        $('#cat_2' + id + '_child').addClass('activeCat2');
    }

    function closeCat(id) {
        console.log(id);
        $('.activeCat').removeClass('activeCat');
        $('.openCat_' + id).removeClass('no');
        $('.ClosCattt').addClass('no');
        // $('.closeCat_'+id).addClass('no');
        // $('#cat_' + id + '_child').addClass('activeCat');
    }

    function closeCat2(id) {
        console.log(id);
        $('.activeCat2').removeClass('activeCat2');
        $('.openCat_' + id).removeClass('no1');
        // $('.openCattt1').removeClass('no1');

        $('.ClosCattt1').addClass('no1');
        // $('.closeCat_'+id).addClass('no');
        // $('#cat_' + id + '_child').addClass('activeCat');
    }

    function showSelected(cat) {

        $('.SelectCatDiv').css('display', 'none');
        $('#topCatname').css('display', 'block');
        $('#selectedCatName').text(cat.name);


    }



    function newBrandModal(brand) {


        $('#NewBname').text(brand.name);

        $('#hiddBName').val(brand.id);




    }
</script>

<style>
    .yes {

        display: block;

    }

    .no,
    .no1 {
        display: none !important;
    }

    .ulll {

        padding: 5px;
        margin-right: 3%;
    }

    .SelectCatDiv {
        transition: all 1s ease-out;
    }

    [type="radio"]:checked+label:after {
        opacity: 1;
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }

    .liii {
        padding: 1px;
    }

    .category_idInputRadio: selected {
        /* backround-color: red; */
    }

    li input[type="radio"]:checked+label {
        background-color: #76cf9f;
    }

    label {
        cursor: pointer;
    }
</style>

@section('content')


    <div class="modal fade" id="newBrandModalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">

                    کاربر برای ایجاد این محصول برند جدیدی تحت عنوان


                    <span id="NewBname"></span>

                    اضافه کرده است و شما باید ابتدا ان برند را تایید کنید

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <a id="newBLink" class="text-danger" href="{{ route('admin.brands.index') }}"> مشاهده برند
                    </a>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    {{-- <div class="modal fade bd-example-modal-lg" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> تغییر  فروشگاه</h5>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="col-md-4 text-center">
                            <div id="upload-demo-logo"></div>
                        </div>

                        <input type="file" id="logo">

                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-success btn-upload-image-logo" style="margin-top:2%"> تغییر لوگو
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>

                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var resize = $('#upload-demo-logo').croppie({
                enableExif: true,
                enableOrientation: true,
                viewport: { // Default { width: 100, height: 100, type: 'square' } 
                    width: 400,
                    height: 400,
                    type: 'square' //square
                },
                boundary: {
                    width: 500,
                    height: 400
                }
            });


            $('#logo').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    resize.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });


            $('.btn-upload-image-logo').on('click', function(ev) {
                resize.croppie('result', {
                    type: 'canvas',
                    size: 'viewport',
                    quality: 1
                }).then(function(img) {


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    var files = $('#logo')[0].files;
                    var formData = new FormData();

                    formData.append('cover', img);

                    $.ajax({
                        type: "POST",
                        // dataType: "json",
                        url: "{{ route('admin.products.addNewBYajax', ['product' => $product]) }}",
                        data: formData,
                        enctype: 'multipart/form-data',
                        async: false,
                        cache: false,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType

                        success: function(data) {

                            // console.log(data);
                            location.reload();

                        },
                        error: function(data) {

                            console.log(data);
                        }
                    });
                });
            });
        </script>

    </div>
 --}}
 


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div style="display: flex !important; padding:50px !important;" class="modal-content">
                <div style="display: flex;" class="form-group col-md-3">
                    <label for="Warranty">گارانتی</label>
                    <select onchange="openWarantyModal()" class="form-control" id="waranty" name="Warranty">
                        <option value="1" {{ $product->Warranty != null ? 'selected' : '' }}>
                            {{ $product->Warranty != null ? $product->Warranty : 'دارد' }}
                        </option>
                        <option value="0" {{ $product->Warranty == null ? 'selected' : '' }}>ندارد</option>
                    </select>

                </div>
                <br>
                <div style="display: none;" class="hasWarantyInputs">
                    <label for="">مدت زمان</label>

                    <div class="form-group col-md-3">

                        <input type="number" class="form-control" id="inputNumberWaranty">

                    </div>


                    <div style="display: flex;" class="form-group col-md-3">

                        <select class="form-control" id="WarrantyDuration">
                            <option value="ماه">
                                ماه
                            </option>
                            <option value="سال">سال

                            </option>
                        </select>

                    </div>
                </div>




                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>
                    <button type="button" onclick="saveWaranty()" class="btn btn-primary">تایید</button>
                </div>

            </div>
        </div>
    </div>






    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-5 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش تصاویر محصول : {{ $product->name }}</h5>
            </div>
            <hr>

            @include('admin.sections.errors')
            <div class="row">
                <div class="col-12 col-md-12 mb-5">
                    <h5>تصاویر : </h5>
                </div>

                <div style="border:  3px solid red;" class="col-md-3    ">

                    <img style="width: 350px;" class="card-img-top"
                        src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                        alt="{{ $product->name }}">

                </div>



                {{-- @dd($product->Allimages) --}}
                @foreach ($product->Allimages as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <img style="width: 350px;" class="card-img-top"
                                src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                alt="{{ $product->name }}">
                            <div class="card-body text-center">
                                <form id="photoForm"
                                    action="{{ route('admin.products.images.destroy', ['product' => $product->id]) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>
                                </form>
                                <form id="photoForm"
                                    action="{{ route('admin.products.images.set_primary', ['product' => $product->id]) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    <button class="btn btn-primary btn-sm mb-3" type="submit">انتخاب به عنوان تصویر
                                        اصلی</button>
                                </form>
                            </div>

                        </div>

                    </div>
                @endforeach
                <form id="submitphotos" action="{{ route('admin.products.imageadd', ['product' => $product]) }}"
                    id="" method="POST" enctype="multipart/form-data">


                    @csrf

                    <div class="form-group col-md-4">
                        <div class="custom-file">
                            {{-- <input type="file" style="display:none !important;" name="images[]" id="images"> --}}
                            {{-- 
                            <label style=" display:flex;" data-toggle="modal" data-target=".bd-example-modal-lg">

                                <span>

                                    انتخاب تصاویر


                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-image-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707v5.586l-2.73-2.73a1 1 0 0 0-1.52.127l-1.889 2.644-1.769-1.062a1 1 0 0 0-1.222.15L2 12.292V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zm-1.498 4a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                        <path
                                            d="M10.564 8.27 14 11.708V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-.293l3.578-3.577 2.56 1.536 2.426-3.395z" />
                                    </svg>

                                </span>



                            </label> --}}


                            <label style=" display:flex;" for="images">

                                <span>

                                    انتخاب تصاویر


                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-image-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707v5.586l-2.73-2.73a1 1 0 0 0-1.52.127l-1.889 2.644-1.769-1.062a1 1 0 0 0-1.222.15L2 12.292V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zm-1.498 4a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                        <path
                                            d="M10.564 8.27 14 11.708V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-.293l3.578-3.577 2.56 1.536 2.426-3.395z" />
                                    </svg>

                                </span>

                            </label>



                            <input type="file" style="display:none !important;" name="images[]"
                                onchange="  $('#submitphotos').submit();    " multiple id="images">


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

    


    <!-- Content Row -->
    <div class="row">


        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if (is_null($product->EditedData))
        
            <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
                <div class="mb-4 text-center text-md-right">
                    <h5 class="font-weight-bold">ویرایش محصول {{ $product->name }}</h5>

                </div>
                <hr>

                @include('user.sections.errors')

                <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="name">نام</label>
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ $product->name }}">
                        </div>


                        <div class="form-group col-md-3 col-6">
                            <label for="brand_id"> <span class="text-danger">*</span>برند</label>
                            <div class=" d-flex">
                                <select name="brand_id" class="brandSelect  " data-live-search="true" id="brandSelect">



                                    <option value="{{ $freeBrand->id }}" 
                                        
                                        @if (getProductLastDate($product->id, 'brand_id') == $freeBrand->id) @selected(true) @endif
                                                
                                        

                                        class="form-control">{{ $freeBrand->name }}
                                    </option>



                                    @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" class="form-control"
                                                @if (getProductLastDate($product->id, 'brand_id') == $brand->id) @selected(true) @endif
                                                
                                                
                                                >{{ $brand->name }}
                                            </option>
                                    @endforeach
                                </select>

                            </div>


                        </div>






                        <div class="form-group  col-md-3" style="display: flex; flex-direction: column;">





                            <label for="waranty">وضعیت گارانتی</label>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                گارانتی</button>

                            @if ($product->Warranty != null)
                                <span>
                                    {{ $product->Warranty }}
                                </span>
                            @else
                                <span id="newWarranty"></span>
                            @endif
                        </div>

                        <div style="margin-top: 10px;" class="form-group col-md-3">

                            قیمت :

                            <div style="display: flex" class="">
                                <input type="text" value=" {{ $product->product_price }} " name="product_price"
                                    id="product_price" class="form-control">

                                <span style="padding:10px;">تومان</span>

                            </div>
                        </div>



                        @if (App\Models\Admin\SiteSetting::select('aparat_product')->first()->aparat_product)
                            <div class="form-group col-sm-12 col-md-2">
                                <label for="apatatVideoLink">لینک آپارات</label>
                                <input type="text" class="form-control" id="apatatVideoLink" name="apatatVideoLink"
                                    value="{{ $product->apatatVideoLink }}">



                                @if ($product->apatatVideoLink)
                                    {!! $product->apatatVideoLink !!}
                                @endif


                            </div>
                        @endif
                        <div class="form-group col-md-12">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{!! nl2br($product->description) !!}</textarea>
                        </div>
                        <span id="topCatname" onclick="$('.SelectCatDiv').css('display' , 'block')"
                            class="btn btn-primary">

                            <span>
                                دسته انتخاب شده :
                            </span>

                            <span id="selectedCatName">
                                {{ $product->category->name }}
                            </span>


                        </span>

                        <div style="display:none;" class="col-12  SelectCatDiv">
                            @foreach (\App\Models\Category::lvl_one()->orderBy('id')->get() as $category)
                                <ul class="ulll">
                                    <li class="lii">

                                        <small onclick="openCat({{ $category->id }})"
                                            class="m-1 openCat_{{ $category->id }} openCattt ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>

                                        </small>

                                        <small onclick="closeCat({{ $category->id }})"
                                            class="closeCat_{{ $category->id }} ClosCattt no " class="m-1">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                            </svg>

                                        </small>

                                        {{ $category->name }}
                                    </li>


                                    <ul class="ulll" style="display: none; background-color: #efefef;"
                                        id="cat_{{ $category->id }}_child">
                                        @foreach ($category->childrens as $lvlone)
                                            <li class="liii">


                                                <div class="form-group">

                                                    <small onclick="openCat2({{ $lvlone->id }})"
                                                        class="m-1 openCat_{{ $lvlone->id }} openCattt1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-plus-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                            <path
                                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                        </svg>

                                                    </small>


                                                    <small onclick="closeCat2({{ $lvlone->id }})"
                                                        class="closeCat_{{ $lvlone->id }} ClosCattt1 no1 "
                                                        class="m-1">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-dash-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                            <path
                                                                d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                                        </svg>

                                                    </small>


                                                    <label for="catId_{{ $lvlone->id }}">{{ $lvlone->name }}</label>
                                                    <input class="category_idInputRadio" type="radio"
                                                        id="catId_{{ $lvlone->id }}" value="{{ $lvlone->id }}"
                                                        @if ($product->lvl_one_category_id == $lvlone->id) selected @endif
                                                        onchange="showSelected({{ $lvlone }})" name="category_id"
                                                        id="">
                                                </div>

                                            </li>


                                            @if (count($lvlone->childrens) > 0)
                                                <ul class="ulll"
                                                    style="display: none;background-color: white;         border: 1px solid rgb(137, 135, 135);
                            "
                                                    id="cat_2{{ $lvlone->id }}_child">

                                                    @foreach ($lvlone->childrens as $lvthree)
                                                        <li class="liii">
                                                            <div class="form-group">

                                                                <label
                                                                    for="catId_{{ $lvthree->id }}">{{ $lvthree->name }}</label>
                                                                <input class="category_idInputRadio" type="radio"
                                                                    id="catId_{{ $lvthree->id }}"
                                                                    value="{{ $lvthree->id }}"
                                                                    @if ($product->lvl_one_category_id == $lvthree->id) selected @endif
                                                                    onchange="showSelected({{ $lvthree }})"
                                                                    name="category_id" id="">
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </ul>

                                </ul>
                            @endforeach


                            <div class="col-md-6">


                                <input type="text" class="form-control" onkeyup="searchcat()"
                                    placeholder="جستجوی دسته بندی ..." id="searchIncats">

                                <div id="searchCatResult"
                                    style=" display:flex; overflow: hidden; height:auto; max-height: 800px; flex-wrap: wrap;flex-direction: column;   background-color: rgb(216, 213, 213); z-index: 1000000000; right:15%;  "
                                    class="col-8">
                                </div>
                            </div>

                        </div>







                        {{-- Attributes & Variations --}}
                        {{-- <div class="col-md-12">
                        <hr>
                        <p>ویژگی ها : </p>
                    </div>
                    @foreach ($productAttributes as $productAttribute)
                        <div class="form-group col-md-3">
                            <label>{{ $productAttribute->attribute->name }}</label>
                            <input class="form-control" type="text"
                                name="attribute_values[{{ $productAttribute->id }}]"
                                value="{{ $productAttribute->value }}">
                        </div>
                    @endforeach

                    @foreach ($productVariations as $variation)
                        <div class="col-md-12">
                            <hr>
                            <div class="d-flex">
                                <p class="mb-0"> قیمت و موجودی برای متغیر ( {{ $variation->value }} ) : </p>
                                <p class="mb-0 mr-3">
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapse-{{ $variation->id }}">
                                        نمایش
                                    </button>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="collapse mt-2" id="collapse-{{ $variation->id }}">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label> قیمت </label>
                                            <input type="text" class="form-control"
                                                name="variation_values[{{ $variation->id }}][price]"
                                                value="{{ $variation->price }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> تعداد </label>
                                            <input type="text" class="form-control"
                                                name="variation_values[{{ $variation->id }}][quantity]"
                                                value="{{ $variation->quantity }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> sku </label>
                                            <input type="text" class="form-control"
                                                name="variation_values[{{ $variation->id }}][sku]"
                                                value="{{ $variation->sku }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}

                    </div>




                    <input type="hidden" name="warrantyInputHidden" id="warrantyInputHidden">


                    @if ($product->brand->vendor_id && $product->brand->is_active != 'فعال')
                        <!-- Button trigger modal -->
                        <button type="button" onclick="newBrandModal({{ $product->brand }})" class="btn btn-primary"
                            data-toggle="modal" data-target="#newBrandModalModal">

                            تایید محصول

                        </button>
                    @else
                        <button onclick="submitAllEdits()" class="btn btn-outline-primary mt-5" type="submit"> تایید /
                            ثبت </button>
                    @endif
                    <a href="{{ route('user.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                </form>
            </div>
        @else
            @php
                $data = json_decode($product->EditedData);

                $lastOne = count($data) - 1;

            @endphp

            <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
                <div class="mb-4 text-center text-md-right">
                    <h5 class="font-weight-bold">ویرایش محصول {{ get_object_vars($data[$lastOne])['name'] }}</h5>

                </div>
                <hr>

                @include('user.sections.errors')

                <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="name">نام</label>
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ get_object_vars($data[$lastOne])['name'] }}">
                        </div>



                        
                        
                        <div class="form-group col-md-3 col-6">
                            <label for="brand_id"> <span class="text-danger">*</span>برند</label>
                            <div class=" d-flex">
                                <select name="brand_id"  id="brandSelect">
                                    <option value="{{ $freeBrand->id }}"
                                        
                                        @if ( get_object_vars($data[$lastOne])['brand_id']  == $freeBrand->id)  selected @endif

                                        class="form-control">{{ $freeBrand->name }}
                                    </option>
                                    @foreach ($brands as $brand)
        
                                        <option value="{{$brand->id}}" class="form-control"    
                                            @if (get_object_vars($data[$lastOne])['brand_id'] == $brand->id) selected @endif >
                                            {{ $brand->name}} - {{$brand->id }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>


                        </div>



                        <div class="form-group  col-md-3" style="display: flex; flex-direction: column;">





                            <label for="waranty">وضعیت گارانتی</label>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                گارانتی</button>

                            @if ($product->Warranty != null)
                                <span>
                                    {{ $product->Warranty }}
                                </span>
                            @else
                                <span id="newWarranty"></span>
                            @endif
                        </div>

                        <div style="margin-top: 10px;" class="form-group col-md-3">

                            قیمت :

                            <div style="display: flex" class="">
                                <input type="text" value="{{ $product->product_price }} " name="product_price"
                                    id="product_price" class="form-control">

                                <span style="padding:10px;">تومان</span>

                            </div>
                        </div>

                        <div class="form-group col-sm-12 col-md-2">
                            <label for="apatatVideoLink">لینک آپارات</label>
                            <input type="text" class="form-control" id="apatatVideoLink" name="apatatVideoLink"
                                value="{{ $product->apatatVideoLink }}">

                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{  get_object_vars($data[$lastOne])['description']  }}</textarea>
                        </div>



                        <span id="topCatname" onclick="$('.SelectCatDiv').css('display' , 'block')"
                            class="btn btn-primary">

                            <span>
                                دسته بندی محصول :
                            </span>

                            <span id="selectedCatName">

                                {{ \App\Models\Category::findOrFail(get_object_vars($data[$lastOne])['category_id'])->name }}

                            </span>


                        </span>

                        <div style="display:none;" class=" col-12   SelectCatDiv">

                            <div class="row">

                                <div class="col-md-6">
                                    @foreach (\App\Models\Category::lvl_one()->orderBy('id')->get() as $category)
                                        <ul class="ulll">
                                            <li class="lii">

                                                <small onclick="openCat({{ $category->id }})"
                                                    class="m-1 openCat_{{ $category->id }} openCattt ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-plus-square"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                        <path
                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                    </svg>

                                                </small>

                                                <small onclick="closeCat({{ $category->id }})"
                                                    class="closeCat_{{ $category->id }} ClosCattt no " class="m-1">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-dash-square"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                        <path
                                                            d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                                    </svg>

                                                </small>

                                                {{ $category->name }}
                                            </li>


                                            <ul class="ulll" style="display: none; background-color: #efefef;"
                                                id="cat_{{ $category->id }}_child">
                                                @foreach ($category->childrens as $lvlone)
                                                    <li class="liii">


                                                        <div class="form-group">

                                                            <small onclick="openCat2({{ $lvlone->id }})"
                                                                class="m-1 openCat_{{ $lvlone->id }} openCattt1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-plus-square" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                                    <path
                                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                                </svg>

                                                            </small>


                                                            <small onclick="closeCat2({{ $lvlone->id }})"
                                                                class="closeCat_{{ $lvlone->id }} ClosCattt1 no1 "
                                                                class="m-1">

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-dash-square" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                                    <path
                                                                        d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                                                </svg>

                                                            </small>


                                                            <label
                                                                for="catId_{{ $lvlone->id }}">{{ $lvlone->name }}</label>
                                                            <input class="category_idInputRadio" type="radio"
                                                                id="catId_{{ $lvlone->id }}"
                                                                value="{{ $lvlone->id }}"
                                                                @if (get_object_vars($data[$lastOne])['category_id'] == $lvlone->id)  @checked(true) @endif
                                                                onchange="showSelected({{ $lvlone }})"
                                                                name="category_id" id="">
                                                        </div>

                                                    </li>


                                                    @if (count($lvlone->childrens) > 0)
                                                        <ul class="ulll"
                                                            style="display: none;background-color: white;         border: 1px solid rgb(137, 135, 135);
                                "
                                                            id="cat_2{{ $lvlone->id }}_child">

                                                            @foreach ($lvlone->childrens as $lvthree)
                                                                <li class="liii">
                                                                    <div class="form-group">

                                                                        <label
                                                                            for="catId_{{ $lvthree->id }}">{{ $lvthree->name }}</label>
                                                                        <input
                                                                        @if (get_object_vars($data[$lastOne])['category_id'] == $lvthree->id) @checked(true) @endif
                                                                        class="category_idInputRadio" type="radio"
                                                                            id="catId_{{ $lvthree->id }}"
                                                                            value="{{ $lvthree->id }}"
                                                                            onchange="showSelected({{ $lvthree }})"
                                                                            name="category_id" id="">
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </ul>
                                    @endforeach

                                </div>

                                <div class="col-md-6">


                                    <input type="text" class="form-control" onkeyup="searchcat()"
                                        placeholder="جستجوی دسته بندی ..." id="searchIncats">

                                    <div id="searchCatResult"
                                        style=" display:flex; overflow: hidden; height:auto; max-height: 800px; flex-wrap: wrap;flex-direction: column;   background-color: rgb(216, 213, 213); z-index: 1000000000; right:15%;  "
                                        class="col-8">
                                    </div>
                                </div>
                            </div>




                        </div>

                    </div>

                    <input type="hidden" name="warrantyInputHidden" id="warrantyInputHidden">


                    @if ($product->brand->vendor_id && $product->brand->is_active != 'فعال')
                        <!-- Button trigger modal -->
                        <button type="button" onclick="newBrandModal({{ $product->brand }})" class="btn btn-primary"
                            data-toggle="modal" data-target="#newBrandModalModal">

                            تایید محصول

                        </button>
                    @else
                        <button onclick="submitAllEdits()" class="btn btn-outline-primary mt-5" type="submit"> تایید /
                            ثبت
                        </button>
                    @endif
                    <a href="{{ route('user.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                </form>
            </div>
        @endif
    </div>



    <a class="btn btn-outline-danger" href="{{ route('admin.sendMessage.edit', ['sendMessage' => $product->id]) }}">
        ریپورت </a>


@endsection
