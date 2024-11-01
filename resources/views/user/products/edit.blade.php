@extends('user.layouts.user')
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}"> --}}



{{-- <link rel="stylesheet" href="{{ asset('Croppie-master/croppie.css') }}"> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css"> --}}
<script src="https://cdnjs.cloudflare.com/ajax/lbs/jquery/3.3.1/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script> --}}
{{-- <script src="{{ asset('Croppie-master/croppie.min.js') }}"></script> --}}




@section('title')
    ویرایش محصول {{ $product->name }}
@endsection

@section('script')
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>

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
                    $("#newWarrantyInput").val(ProductWarranty);

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

                            id: 'catIdd_' + element.id,
                            type: 'radio',
                            value: element.id,
                            class: 'd-none',
                            onchange: "showSelected('" + element.name + " ','" + element.id +
                                "' )",
                            name: 'category_id',

                        }).appendTo(e);
                        $("<label/>", {

                            id: 'searchResultItem',
                            class: 'vazirFont text-black searchResultItem py-1',
                            html: element.name,
                            for: "catIdd_" + element.id,


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


        function addNewBrandddd() {


            localStorage.setItem("Ppay", $('#product_price').val());
            localStorage.setItem("Pname", $('#name').val());
            localStorage.setItem("Pdesc", $('#description').val());


            $('#AddNewBrandForm2').submit();
        }





        function submitAllEdits(count2) {

            // $('#photoForm').submit();


            var validate = inputValidation();

            if (validate) {
                if (window.confirm("آیا از اطلاعات وارد شده اطمینان دارید؟")) {
                    $('#overlay').css('display', 'block');
                    if (count2) {

                        $('#editForm2').submit();
                    } else {
                        $('#editForm').submit();

                    }

                }
            } else {
                alert("لطفا در درج اطلاعات دقت فرمایید")
            }


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



        function inputValidation() {

            var regexEnglishNumber = new RegExp('^[0-9]+$');

            var regexPersianNumber = new RegExp('^[0-9]+$');

            var validate = true;

            // if(inputName == "Price"  ){
            //  if (regexEnglishNumber.test($("#product_price").val()) ||
            //    $("#product_price").val() == "" ||
            //  regexPersianNumber.test($("#product_price").val())) {
            // $(".alertPrice").css("display", "none")
            // } else {
            //   validate = false;
            // $(".alertPrice").css("display", "block")
            //}

            // }

            // if(inputName == "Name"  ){
            if ($("#name").val() == "") {
                validate = false;
                $(".alertName").css("display", "block ")

                console.log("no")
            } else {

                console.log($("#name").val())
                $(".alertName").css("display", "none")
            }
            // }



            return validate

        }


        document.addEventListener('DOMContentLoaded', function() {
            const imgWrap = $('.upload__img-wrap2');

            function refreshImages() {
                imgWrap.empty(); // Clear existing images

                $('.image-checkbox:checked').each(function() {
                    var src = $(this).data('src');
                    imgWrap.append('<img class="upload__img-box" src="' + src + '" alt="Selected Image">');
                });
            }
            $('body').on('change', '.image-checkbox', function() {
                refreshImages();
            });

            // Initial update
            refreshImages();

        });
    </script>

    <style>
        .alertErr {
            display: none;
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

        .primaryImage {
            border: 3px solid rgb(0, 51, 255) !important;
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


        function upladnewImages() {
            $('#overlay').css('display', 'block');
            $("#submitphotos").submit()

        }
        $("input[type='search']").keyup(function(e) {

            $('#BrandNameForm').val($(this).val());



            var count = $(".inner ul").children().children().length;

            $('#addnewBrandBt').css('display', 'none');

            if (count < 1) {

                $('.newBrandCheckbox').css('display', 'block');
            } else {
                $('.newBrandCheckbox').css('display', 'none');
                //      $('#addnewBrandCheckBox').prop('checked', false);
            }




        });




        function SendNewBrand() {





            if ($('#addnewBrandCheckBox:checkbox:checked').length == 0) {
                $(".selectoptionBrand").css("display", "block")

                $('.newBrandCheckbox').css('display', 'none');

                console.log("0")
                $("#newBrandName").text(" ")

                $("#newBrandName").val("")

            } else {
                console.log(">0")

                $(".selectoptionBrand").css("display", "none")
                $('#newBrandCheckbox').css("display", "block");
                $("#newBrandName").text($("input[type='search']").val())
                $("#newBrandNameInput").val($("input[type='search']").val())
            }
        }

        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var arrfile = $('#arrfile')[0].files;

                    if (arrfile) {

                        var newFileList = new DataTransfer();

                        var iterator = 0;
                        filesArr.forEach(function(f, index) {

                            if (!f.type.match('image.*')) {
                                return;
                            }

                            if (imgArray.length > maxLength) {
                                return false
                            } else {
                                var len = 0;
                                for (var i = 0; i < imgArray.length; i++) {
                                    if (imgArray[i] !== undefined) {
                                        len++;
                                    }
                                }
                                if (len > maxLength) {
                                    return false;
                                } else {
                                    imgArray.push(f);

                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        var html =
                                            "<div class='upload__img-box'><div style='background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length + "' data-file='" +
                                            f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                        imgWrap.append(html);
                                        iterator++;
                                    }
                                    reader.readAsDataURL(f);
                                }
                            }

                        });

                        $("#submitImgsBtn").css("display", "block")

                        // Add existing files to the new FileList
                        for (var i = 0; i < arrfile.length; i++) {
                            newFileList.items.add(arrfile[i]);
                        }

                        // Add new files to the new FileList
                        for (var i = 0; i < files.length; i++) {
                            newFileList.items.add(files[i]);
                        }

                        // Set the new FileList as the value of the input element
                        $('#arrfile')[0].files = newFileList.files;

                        // Access arrfile.files here
                    } else {
                        console.error('arrfile is not defined');
                    }

                });
            });

            $('body').on('click', ".upload__img-close", function(e) {



                var file = $(this).parent().data("file");

                var arrfile = $('#arrfile')[0].files;

                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        arrfile.splice(i, 1);

                        // Create a new input element without the removed file
                        var input = $(this).closest('.upload__box').find('.upload__inputfile');
                        var newInput = $('<input>', {
                            type: 'file',
                            name: input.attr('name'),
                            multiple: input.attr('multiple'),
                            accept: input.attr('accept')
                        });
                        input.replaceWith(newInput);

                        // Add the remaining files to the new input element
                        for (var j = 0; j < imgArray.length; j++) {
                            newInput.append(imgArray[j]);
                            arrfile.append(imgArray[j]);

                        }

                        break;
                    }
                }
                $(this).parent().parent().remove();
            });


            $('body').on('click', ".img-bg", function(e) {

                $(".primaryImage").removeClass("primaryImage");
                var file = $(this).parent().addClass(" primaryImage");
                var index = $(".img-bg").index(this);
                changePrimaryImage(index.toString(), index.toString(), 'new');

            });


        }



        function deleteImgs(imageId) {
            $('#imageeee_' + imageId).css("display", "none")
            var arr = $("#deletedImageIds").val()
            $("#deletedImageIds").val($("#deletedImageIds").val() + "-" + imageId)


        }

        function changePrimaryImage(imageName, imageID, type) {

            if (type != "new") {
                $(".primaryImage").removeClass("primaryImage");
            }
            $("#primaryImageName").val(imageName)
            $("#primaryImageType").val(type)
            $("#imageeee_" + imageID).addClass(" primaryImage")
            console.log(imageID)

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




        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            min-width: 116px;
            transition: all 0.3s ease;
            cursor: pointer;


            border-radius: 10px;

            font-size: 14px;
        }

        .upload__btn:hover {
            background-color: unset;

            transition: all 0.3s ease;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-wrap2 {
            display: flex;
            max-width: 80px;
            max-height: 80px;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: "✖";
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }
    </style>
@endsection

@section('content')

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
                        url: "{{ route('user.products.addNewBYajax', ['product' => $product]) }}",
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

                        <input type="text" class="form-control" id="inputNumberWaranty">

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




    <form style="display: none;" id="AddNewBrandForm2" action="{{ route('user.createBrand2') }}" method="post">
        @csrf
        <input type="hidden" id="vendor_id" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
        <input type="hidden" id="Pname" name="Pname">
        <input type="hidden" id="Ppay" name="Ppay">
        <input type="hidden" id="Pdesc" name="Pdesc">
        <input type="hidden" id="Pcat" name="Pcat">
        <input type="hidden" id="BrandNameForm" name="BrandName">
        <input type="hidden" name="pid" value="{{ $product->id }}">

        <input type="hidden" name="url" value="edit">
    </form>


    <!-- Content Row -->
    <div class="row">


        <div class="col-xl-12 col-md-12 mb-4 p-5 bg-white">


            @if ($product->status == 'yes')
                <div class="alert alert-success">
                    این محصول در تاریخ
                    {{ \Morilog\Jalali\Jalalian::forge($product->created_at) }}
                    منتشر شد و تا کنون

                    {{ $product->view_counter }}

                    بازدید
                    و همچنین
                    {{ count($product->commentCounts) }}
                    دیدگاه داشته است.



                </div>




                @if ($product->status == 'edited')
                    <div class="alert alert-danger">


                        تغییرات جدید شما در صف تایید کارشناسان است
                    </div>
                @elseif($product->status == 'reported')
                    <div class="alert alert-danger">
                        این محصول توسط ادمین رد شده است ، برای انتشار آن لطفا طبق قوانین اینستابرق آن را ویرایش کنید
                    </div>
                @endif
            @elseif($product->status == 'new')
            @else
                <div class="alert alert-warning">
                    این محصول در صف انتشار است و پس از تایید نهایی منتشر خواهد شد


                </div>
            @endif




            @include('user.sections.errors')

        </div>
    </div>

    @php
        $pId = $product->id;
    @endphp
    <!-- Content Row -->
    <div class="row">

        {{--  <input type="file" id="arrfile" name="images[]" style="display: none;" id="">  --}}
        @if (is_null($product->EditedData))

            <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
                <div class="mb-4 text-center text-md-right">
                    <h5 class="font-weight-bold">ویرایش محصول {{ getProductLastDate($pId, 'name') }}</h5>
                </div>
                <hr>

                @include('user.sections.errors')


                <form id="editForm" action="{{ route('user.products.update', ['product' => $product->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <input type="file" id="arrfile" name="images[]" style="display: none;" id="">

                    <input type="hidden" name="primaryImageType" id="primaryImageType" value="last">


                    <input type="hidden" name="primaryImage" id="primaryImageName" value="{{ $product->primary_image }}">



                    <input type="hidden" name="deletedImageIds" id="deletedImageIds" value="">
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="name">نام</label>
                            <input class="form-control" id="name" name="name" type="text"
                                onkeyup ="inputValidation()" value="{{ getProductLastDate($pId, 'name') }}">
                            <span class="text-danger alertErr alertName ">
                                نام محصول الزامی است
                            </span>
                        </div>

                        {{-- <div class="form-group col-md-3">
                            <label for="brand_id">برند</label>
                            <div class=" d-flex">
                                <select id="brandSelect" name="brand_id" class="brandSelect" data-live-search="true">
                                    @foreach ($brands as $brand)
                                        @if ($brand->created_by == null || $brand->created_by == Auth::user()->vendor->id || $brand->is_active == 1)
                                            <option value="{{ $brand->id }}"
                                                {{ $brand->id == $product->brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>





                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary col-4" style="height: 40px;"
                                    data-toggle="modal" data-target="#brnadModal">
                                    افزودن برند
                                </button>

                            </div>


                        </div> --}}


                        <div class="form-group col-md-3 col-6">
                            <label for="brand_id"> <span class="text-danger">*</span>برند</label>
                            <div class=" d-flex">


                                <select name="brand_id" class="brandSelect selectoptionBrand " data-live-search="true"
                                    id="brandSelect">
                                    <option value="{{ $freeBrand->id }}" class="form-control">{{ $freeBrand->name }}
                                    </option>



                                    @foreach ($brands as $brand)
                                        @if ($brand->created_by == null || $brand->created_by == Auth::user()->vendor->id || $brand->is_active == 1)
                                            <option value="{{ $brand->id }}" class="form-control"
                                                @if ($product->brand_id == $brand->id) selected @endif>
                                                {{ $brand->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>


                                <div class="newBrandCheckbox" style="display: none;">
                                    <span id="newBrandName"></span>

                                    <input @checked(false) type="checkbox" checkednewBrand name="newBrand"
                                        id="addnewBrandCheckBox" onchange="SendNewBrand()">
                                    <label for="addnewBrandCheckBox"
                                        style="background-color:wheat !important; color:black;">افزودن بعنوان برند
                                        جدید</label>
                                    <input type="hidden" value="" name="newBrandName" id="newBrandNameInput">

                                </div>




                                {{-- <span id="choosedBrand" style="display: none;"></span>

                            <span onclick="EditchoosedBrand()" class="btn btn-info" style="display: none;"
                                id="editBrand">تغییر برند</span>
                            @foreach ($brands as $brand)
                            @if ($brand->created_by == null || $brand->created_by == Auth::user()->vendor->id || $brand->is_active == 1)
                            <div class="form-group">
                                <input style="display: none;" class="brendInp" type="radio" name="brand_id"
                                    id="b({{ $brand->id }})" value="{{ $brand->id }}"
                                    onchange="showselectedBrand({{ $brand->id }})">


                            </div>
                            @endif
                            @endforeach --}}

                                {{-- <div class="" id="">
                                <input type="text" class="form-control" onkeydown="searchBrand()"
                                    placeholder="جستجوی  برند ..." id="searchInBrands">

                                <div id="searchBrandResult"
                                    style=" display:none; position: absolute; overflow: hidden; height:auto; max-height: 800px; flex-direction: column;   background-color: rgb(216, 213, 213); z-index: 1000000000;  "
                                    class="col-8">
                                    @foreach ($brands as $brand)
                                    @if ($brand->created_by == null || $brand->created_by == Auth::user()->vendor->id || $brand->is_active == 1)
                                    <div class="form-group">

                                        <label for="b({{ $brand->id }})">{{ $brand->name }}</label>
                                    </div>
                                    @endif
                                    @endforeach

                                </div>

                            </div> --}}








                            </div>


                        </div>






                        <div class="form-group  col-md-3" style="display: flex; flex-direction: column;">





                            <label for="waranty">وضعیت گارانتی</label>
                            <button type="button" class="btn  btn-secondary" data-toggle="modal"
                                data-target="#exampleModal">
                                گارانتی</button>

                            @if ($product->Warranty != null)
                                <span>
                                    {{ $product->Warranty }}
                                </span>
                            @else
                                <input type="hidden" name="newWarranty" id="newWarrantyInput">
                                <span id="newWarranty"></span>
                            @endif
                        </div>

                        <div style="margin-top: 10px;" class="form-group col-md-3">

                            قیمت :

                            <div style="display: flex" class="">
                                <input type="text" value="{{ $product->product_price }}" name="product_price"
                                    onkeyup="inputValidation()" id="product_price" class="form-control">

                                <span style="padding:10px;">تومان</span>

                            </div>
                            {{--  
                            <span class="text-danger alertErr alertPrice ">
                                مقدار قیمت باید از نوع عددی باشد
                            </span>  --}}

                        </div>



                        @if (App\Models\Admin\SiteSetting::select('aparat_product')->first()->aparat_product)
                            <div class="form-group col-sm-12 col-md-12">
                                <label for="apatatVideoLink">لینک آپارات</label>
                                <input type="text" class="form-control mb-2" id="apatatVideoLink"
                                    name="apatatVideoLink" value="{{ getProductLastDate($pId, 'apatatVideoLink') }}">

                                <small class="p-2">
                                    (
                                    این ویدیو باید درباره محصول شما باشد و در صفحه
                                    محصول نشان داده خواهد شد
                                    ... برای این کار شما باید لینک script ویویو را در سایت آپارات کپی و در اینجا جایگذاری
                                    کنید ...
                                    )
                                </small>


                                @if ($product->apatatVideoLink)
                                    {!! $product->apatatVideoLink !!}
                                @endif


                            </div>
                        @endif
                        <div class="form-group col-md-12">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ getProductLastDate($pId, 'description') }}</textarea>
                        </div>




                        <span id="topCatname" onclick="$('.SelectCatDiv').css('display' , 'block')"
                            class="btn btn-outline-success">

                            <span>
                                دسته انتخاب شده :
                            </span>

                            <span id="selectedCatName">
                                {{ $product->category->name }}
                            </span>


                        </span>

                        <div style="display:none;" class="col-12  SelectCatDiv">

                            <input type="text" class="form-control my-3" onkeyup="searchcat()"
                                placeholder="جستجوی دسته بندی ..." id="searchIncats">

                            <div id="searchCatResult my-3"
                                style=" display:flex; overflow: hidden; height:auto; max-height: 800px; flex-wrap: wrap;flex-direction: column;   background-color: rgb(216, 213, 213); z-index: 1000000000; right:15%;  "
                                class="col-8">
                            </div>

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




                        </div>


                        <div class="upload__box text-center col-12">
                            <div class="upload__btn-box text-center w-100">
                                <label class="upload__btn   text-center mx-auto">
                                    <p class="m-0 upload__btn btn btn-warning text-dark py-3 px-5">افزودن تصویر</p>
                                    <input type="file" name="imggg[]" multiple accept="image/png, image/jpeg"
                                        data-max_length="20" class="upload__inputfile">
                                </label>

                                <a class="btn upload__btn btn btn-warning text-dark py-3 px-5" href="#open-modal">انتخاب
                                    تصویر از
                                    تصاویر قبلی</a>
                            </div>
                            <div class="upload__img-wrap"></div>

                            <x-last-images />

                            <div class="upload__img-wrap2">
                            </div>
                        </div>

                        <div class="w-100">


                            {{-- <form id="submitphotos" action="{{ route('user.products.imageadd', ['product' => $product]) }}"
                                id="" method="POST" enctype="multipart/form-data">
            
            
            
            
                                @csrf 



                             
            
                                <div class="form-group col-md-4">
            
                                    <div class="custom-file">
            
                                        
                                    </div>
                                </div>
            
                            </form>  --}}

                            <div class="col-12 col-md-12 mb-5">
                                <h5>تصاویر : </h5>
                            </div>
                            <hr>
                            @if ('product-default-limage.jpg' == $product->primary_image)
                                <div class="d-none" style="border:  3px solid red;">
                                    <img class="card-img-top img-fluid "
                                        src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                        alt="{{ $product->name }}">
                                </div>
                            @endif


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
                    <div class="container  ">
                        <div class="row">
                            <div class="col-8"><span onclick="submitAllEdits()" class="btn btn-primary w-100 mt-5"
                                    type="submit">ثبت</span></div>
                            <div class="col-4"><a href="{{ route('user.products.index') }}"
                                    class="btn btn-outline-dark mt-5  ">بازگشت</a></div>
                        </div>
                    </div>
                </form>
                <div class="w-100 row">
                    @foreach ($product->Allimages as $image)
                        <div class="col-md-3 position-relative " id="imageeee_{{ $image->id }}"
                            @if (is_null($image->acceptedbyAdmin))  @endif>
                            <div id="innerDivImg_{{ $image->image }}"
                                class="card   @if ($image->image == $product->primary_image) primaryImage @endif ">
                                <img class="card-img-top img-fluid"
                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                    alt="{{ $product->name }}">
                                <div class="card-body text-center ">
                                    <form id="photoForm"
                                        action="{{ route('user.products.images.destroy', ['product' => $product->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        <span class="btn btn-danger btn-sm mb-3 position-absolute" style="top:5;right:5;"
                                            onclick="deleteImgs({{ $image->id }})"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg></span>
                                        {{--  <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>  --}}
                                    </form>
                                    {{--  @if ($image->image != $product->primary_image)  --}}
                                    <form id="photoForm"
                                        action="{{ route('user.products.images.set_primary', ['product' => $product->id]) }}"
                                        method="post">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        {{--  <button class="btn btn-primary btn-sm mb-3" type="submit">انتخاب به عنوان تصویر
                                                اصلی</button>  --}}

                                        <span class="btn btn-outline-primary btn-sm mb-3"
                                            onclick="changePrimaryImage('{{ $image->image }}','{{ $image->id }}' , 'last')">انتخاب
                                            به عنوان تصویر
                                            اصلی</span>


                                    </form>
                                    {{--  @endif  --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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

                <form id="editForm2" action="{{ route('user.products.update', ['product' => $product->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-row">


                        <input type="hidden" name="primaryImage" id="primaryImageName"
                            value="{{ $product->primary_image }}">

                        <input type="hidden" name="deletedImageIds" id="deletedImageIds" value="">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="name">نام</label>
                                <input class="form-control" id="name" name="name" type="text"
                                    value="{{ get_object_vars($data[$lastOne])['name'] }}">
                            </div>





                            <div class="form-group col-md-3 col-6">
                                <label for="brand_id"> <span class="text-danger">*</span>برند</label>
                                <div class=" d-flex">
                                    <select name="brand_id" class="brandSelect  " data-live-search="true"
                                        id="brandSelect">
                                        <option value="{{ $freeBrand->id }}" class="form-control">{{ $freeBrand->name }}
                                        </option>



                                        @foreach ($brands as $brand)
                                            @if ($brand->created_by == null || $brand->created_by == Auth::user()->vendor->id || $brand->is_active == 1)
                                                <option value="{{ $brand->id }}" class="form-control"
                                                    @if (get_object_vars($data[$lastOne])['brand_id'] == $brand->id) selected @elseif  (!is_null($vendorCreatedBrand) && $vendorCreatedBrand->id == $brand->id) selected @endif>
                                                    {{ $brand->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>



                                    <input type="file" id="arrfile" name="images[]" style="display: none;"
                                        id="">
                                    <!-- Button trigger modal -->
                                    <button type="button" onclick="addNewBrandddd()" class="btn btn-primary col-4"
                                        id="addnewBrandBt" style="display: none;">
                                        افزودن بعنوان برند جدید
                                    </button>

                                </div>


                            </div>



                            <div class="form-group  col-md-3" style="display: flex; flex-direction: column;">





                                <label for="waranty">وضعیت گارانتی</label>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
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
                                    <input type="text" value="{{ get_object_vars($data[$lastOne])['product_price'] }}"
                                        name="product_price" id="product_price" class="form-control">

                                    <span style="padding:10px;">تومان</span>

                                </div>
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                                <label for="apatatVideoLink">لینک آپارات</label>
                                <input type="text" class="form-control" id="apatatVideoLink" name="apatatVideoLink"
                                    value="{{ $product->apatatVideoLink }}">

                            </div>

                            <div class="form-group col-md-12">
                                <label for="description">توضیحات</label>
                                
                                <textarea class="form-control" id="description" name="description" rows="4">{{ getProductLastDate($pId, 'description') }}</textarea>
                            </div>



                            <span id="topCatname" onclick="$('.SelectCatDiv').css('display' , 'block')"
                                class="btn btn-primary">

                                <span>
                                    دسته بندی محصول :
                                </span>

                                <span id="selectedCatName">





                                    {{ \App\Models\Category::findOrFail(get_object_vars($data[$lastOne])['category_id'])->name }}

                                    {{--  {{ $product->category->name }}  --}}

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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-plus-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                            <path
                                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                        </svg>

                                                    </small>

                                                    <small onclick="closeCat({{ $category->id }})"
                                                        class="closeCat_{{ $category->id }} ClosCattt no "
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
                                                                    @if (get_object_vars($data[$lastOne])['category_id'] == $lvlone->id) selected @endif
                                                                    value="{{ $lvlone->id }}"
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
                                                                                @if (get_object_vars($data[$lastOne])['category_id'] == $lvthree->id) selected @endif
                                                                                class="category_idInputRadio"
                                                                                type="radio"
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
                    <a href="{{ route('user.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                    <span onclick="submitAllEdits(2)" class="btn btn-primary  ">ثبت</span>


                </form>
            </div>
        @endif

    </div>

@endsection


<script>
    function uploadImage2(event) {
        $('#overlay').css('display', 'block');







        // const input = event.target;
        // if (input.files && input.files[0]) {
        //     const reader = new FileReader();

        //     reader.onload = function (e) {
        //     const img = new Image();
        //     img.src = e.target.result;

        //     img.onload = function () {
        //         const canvas = document.createElement('canvas');
        //         const ctx = canvas.getContext('2d');
        //         let width = img.width;
        //         let height = img.height;

        //         // Check for EXIF data to get the image orientation
        //         EXIF.getData(img, function () {
        //         const orientation = EXIF.getTag(this, 'Orientation');
        //         if (orientation === 6) {
        //             width = img.height;
        //             height = img.width;
        //         }

        //         // Set proper canvas dimensions for rotation
        //         canvas.width = width;
        //         canvas.height = height;

        //         // Rotate and draw the image on the canvas
        //         ctx.clearRect(0, 0, canvas.width, canvas.height);
        //         if (orientation === 6) {
        //             ctx.translate(canvas.width / 2, canvas.height / 2);
        //             ctx.rotate(90 * Math.PI / 180);
        //             ctx.drawImage(img, -img.width / 2, -img.height / 2);
        //         } else {
        //             ctx.drawImage(img, 0, 0, width, height);
        //         }

        //         console.log("asasddsasd");
        //         // Convert canvas to Blob and append to form data
        //         canvas.toBlob(function (blob) {
        //             const formData = new FormData(document.getElementById('myForm'));
        //             formData.append('image', blob, 'image.jpg');

        //             // Send the formData to the server using AJAX or fetch
        //             fetch({{ route('user.products.imageadd', ['product' => $product]) }}, {
        //             method: 'POST',
        //             body: formData,
        //             })
        //             .then(response => {
        //             // Handle response from the server
        //             console.log('Image uploaded successfully');
        //             window.location.reload
        //             })
        //             .catch(error => {
        //             // Handle error
        //             console.error('Error uploading image:', error);
        //             });
        //         }, 'image/jpeg');
        //         });
        //     };
        //     };


        // }











        $('#submitphotos').submit();
    }
</script>
