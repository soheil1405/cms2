@extends('user.layouts.user')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">

@section('title')
    create products
@endsection

@section('script')
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>


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

        .alertErr {
            display: none;
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
        $('.brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });


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

        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });

        $('#attributesContainer').hide();

        // $('.category_id').on('changed', function() {


        //     let categoryId = $(this).val();

        //     console.log(categoryId);

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
        //     })

        //     // console.log(categoryId);
        // });

        // $("#czContainer").czMore();





        function editCat() {



            $('#ChooseCatDiv').css('display', 'block');

            $('#showCats').css('display', 'none');


        }
        $(document).ready(function() {


            var element = $(".no-results");


            element.attr('id', 'noooooo');


            // console.log('asdasdasd');

        });









        $("#noooooo").click(function(e) {
            alert(1);
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



        function EditchoosedBrand() {
            $('#searchInBrands').css('display', 'block');

            $('#searchBrandResult').css('display', 'block');

            $('#editBrand').css('display', 'none');

            $('#choosedBrand').css('display', 'none');

        }


        function showselectedBrand(brandId) {




            var chooded_brand_name = $("label[for='b(" + brandId + ")']").text();


            console.log(chooded_brand_name);

            $('#searchInBrands').css('display', 'none');

            $('#searchBrandResult').css('display', 'none');

            $('#editBrand').css('display', 'block');

            $('#choosedBrand').css('display', 'block');

            $('#choosedBrand').text(chooded_brand_name);


        }




        $(document).click(function(e) {
            if (e.target.id != "searchInBrands") { // if click is not in 'mydiv'
                $('#searchBrandResult').css('display', 'none');
            }
        });


        function searchBrand() {


            $('#searchBrandResult').css('display', 'flex');

            var chars = $('#searchInBrands').val();



            if (chars != "") {
                formData = {
                    chars: chars
                };
                $.ajax({
                    type: "POST",
                    url: '/SearchBrandsAjax',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {


                        console.log(data);


                        var e = document.querySelector("#searchBrandResult");

                        var child = e.lastElementChild;
                        while (child) {


                            e.removeChild(child);
                            child = e.lastElementChild;
                        }

                        data.forEach(element => {


                            var div = $('<div>', {
                                id: 'some-id',
                                class: 'some-class some-other-class',
                                title: element.name
                            }).appendTo(e);
                            $("<label/>", {
                                id: 'BrandsearchResult',
                                class: 'vazirFont text-black searchResultItem',
                                html: element.name,
                                for: "b(" + element.id + ")"
                            }).appendTo(div);

                        });






                        if (data.length == 0) {



                            $("<span>", {

                                id: 'save2',
                                class: 'btn btn-dark',
                                html: "افزودن برند جدید :" + chars,
                                click: function() {
                                    var chars = $('#searchInBrands').val();

                                    if ($('#searchInBrands').val() == "") {
                                        $('#BrandFormError').css('display', 'block');
                                    } else {


                                        formData = {
                                            BrandName: $('#searchInBrands').val(),

                                        }
                                        $.ajax({
                                            type: "POST",
                                            url: "https://instabargh.com/vendor-dashboard/createBrand",
                                            data: formData,
                                            dataType: 'json',
                                            headers: {
                                                'X-CSRF-TOKEN': jQuery(
                                                    'meta[name="csrf-token"]').attr(
                                                    'content')
                                            },
                                            success: function(data) {


                                                var newBrand =
                                                    '<input type="radio" checked name="brand_id" id="b(' +
                                                    data.id + ')" value="' + data.id +
                                                    '" onchange="showselectedBrand(' +
                                                    data.id + ')"   >';

                                                $('input:radio[name="brand_id"]')
                                                    .filter('[value="' + data.id + '"]')
                                                    .attr('checked', true);
                                                console.log(newBrand);

                                                var label = '<label for="b(' + data.id +
                                                    ')" >"' + data.name +
                                                    '"</label>';








                                                if (newBrand) {

                                                    alert(
                                                        'برند مورد نظر با موفقیت ثبت شد '
                                                    );


                                                    // $('.brendInp').val(data.id);

                                                }
                                                jQuery('#BrandFormError').trigger(
                                                    "reset");
                                                jQuery('#brnadModal').modal('hide')
                                            },
                                            error: function(data) {
                                                console.log(data);
                                                alert('برند مورد نظر موجود می باشد');
                                            }
                                        });
                                    }
                                }

                            }).appendTo(e);

                        }




                    },
                    error: function(data) {
                        console.log(data.responseJSON.message);



                    }
                });

            }




        }








        function getVariations(categoryId) {


            var chooded_cat_name = $("label[for='categorySelect(" + categoryId + ")']").text();

            $('#ChooseCatDiv').css('display', 'none');

            $('#showCats').css('display', 'block');

            $('#choosedCat').css('display', 'block');

            $('#choosedCat').text(chooded_cat_name);





            var e = document.querySelector("#searchCatResult");

            var child = e.lastElementChild;
            while (child) {


                e.removeChild(child);
                child = e.lastElementChild;
            }



            $.get(`{{ url('/vendor-dashboard/category-attributes/${categoryId}') }}`, function(response,
                status) {
                if (status == 'success') {
                    // console.log(response);

                    $('#attributesContainer').fadeIn();

                    // Empty Attribute Container
                    $('#attributes').find('div').remove();

                    // Create and Append Attributes Input
                    response.attrubtes.forEach(attribute => {
                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.name,
                            name: `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);

                    });

                    $('#variationName').text(response.variation.name);

                } else {
                    alert('مشکل در دریافت لیست ویژگی ها');
                }
            }).fail(function() {
                alert('مشکل در دریافت لیست ویژگی ها');
            })

        }






        function openWarantyModal() {

            if ($('#waranty').val() == '1') {

                $('.hasWarantyInputs').css('display', 'flex');
            }

            inputValidation('Garanty')
        }




        function inputValidation() {

            var regexEnglishNumber = new RegExp('^[0-9]+$');

            var regexPersianNumber = new RegExp('^[0-9]+$');

            var validate = true;

            // if(inputName == "Price"  ){
            // if (regexEnglishNumber.test($("#product_price").val()) ||
            //   $("#product_price").val() == "" ||
            // regexPersianNumber.test($("#product_price").val())) {
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


            // if(inputName == "alertCategory"){
            if (($('.category_idInputRadio:checked').length) > 0) {
                $(".alertCategory").css("display", "none")
            } else {

                validate = false;

                $(".alertCategory").css("display", "block")
            }
            // }

            return validate

        }



        function mainImg() {
            const primary_image = $('#primary_image')[0].files;

            // console.log();

            if (primary_image) {
                $("#mainImgDiv").html('');
                let reader = new FileReader();
                reader.onload = function(primary_image) {
                    console.log(event.target.result);
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
                for (var i = 0; i < primary_image.length; i++) {
                    var src = window.URL.createObjectURL(primary_image[i])
                    console.log(src);
                    // $("#mainImgDiv").append('<img src=' + src  + '; style ='+ 'width="100px" height="100px"/>');
                }
            }
        }

        function saveWaranty() {

            if ($('#waranty').val() == '1') {




                if ($('#inputNumberWaranty').val() != "") {

                    var inputNumberWaranty = $('#inputNumberWaranty').val();
                    var WarrantyDuration = $('#WarrantyDuration').val();
                    var ProductWarranty = inputNumberWaranty + WarrantyDuration;
                    $('#warrantyInputHidden').val(ProductWarranty);
                    $('.modal').modal('hide');
                    $('#newWarranty').html(ProductWarranty);

                    console.log(ProductWarranty);
                } else {
                    alert('مدت زمان گارانتی نمیتواند خالی باشد');
                }

            } else {
                $('#newWarranty').html(
                    'ندارد'
                );

                $('#hasWarantyInputs').css('display', 'none');
                $('.modal').modal('hide');

            }

        }

        function SubmitAddNewBrandForm() {
            if ($('#BrandName').val() == "") {
                $('#BrandFormError').css('display', 'block');
            } else {
                $('#save').click(function(e) {});

                formData = {
                    BrandName: $('#BrandName').val(),
                    vendor_id: $('#vendor_id').val()
                }
                $.ajax({
                    type: "POST",
                    url: "https://instabargh.com/vendor-dashboard/createBrand",
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {


                        var newBrand = '<option value="' + data.id + ">" + data.name + '</option>';

                        console.log(newBrand);

                        if (newBrand) {

                            alert('برند مورد نظر با موفقیت ثبت شد و اکنون در لیست برند ها در دسترس می باشد');
                        }
                        jQuery('#BrandFormError').trigger("reset");
                        jQuery('#brnadModal').modal('hide')
                    },
                    error: function(data) {
                        // console.log(data);
                        alert('برند مورد نظر موجود می باشد');
                    }
                });
            }


        }


        function SubmitAddNewTagForm() {
            if ($('#TagName').val() == "") {
                $('#TagFormError').css('display', 'block');
            } else {
                $('#saveTag').click(function(e) {});
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                formData = {
                    TagName: $('#TagName').val(),
                    vendor_id: $('#vendor_id').val()
                }
                $.ajax({
                    type: "POST",
                    url: "https://zivar-shop.ir/vendor-dashboard/createTag",
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        var newTag = '<option  class="newBrand" value="todo' + data.id + '">' + data.name +
                            '</option';
                        if (newTag) {
                            $('#tagSelect').append(newTag);
                            alert('تگ مورد نظر با موفقیت ثبت شد و اکنون در لیست تگ ها در دسترس می باشد');


                            console.log($('.newBrand'));


                        }
                        jQuery('#AddNewTagForm').trigger("reset");
                        jQuery('#TagModal').modal('hide')
                    },
                    error: function(data) {

                        alert('تگ مورد نظر موجود می باشد');
                    }
                });
            }



        }



        $(document).ready(function() {

            inputValidation()

            if ($('input[type=radio]').is(':checked')) {
                // $('input[type=radio]').parent().css('background-color', 'red');
            }
        });




        var images = [];

        function image_select() {
            var image = document.getElementById('image').files;

            var primary_image = document.getElementById('primary_image').files;


            for (i = 0; i < image.length; i++) {
                images.push({
                    "name": image[i].name,
                    "url": URL.createObjectURL(image[i]),
                    "file": image[i],
                })
            }

            document.getElementById('container').innerHTML = image_show();



            var selectedFile = document.getElementById('image').files[0];
            // var base64 = selectedFile.convertToBase64();

            var reader = new FileReader();
            reader.readAsDataURL(selectedFile);
            reader.onload = function() {

                $('#primary_hidden').val(reader.result);

            }

        }










        function image_show() {
            var image = "";
            var primary = [];

            console.log(images);
            images.forEach((i) => {

                image += `<div style="display:flex;  flex-direction:column;" class="image_container justify-content-center">

                
                    <input  id="primary(` + images.indexOf(i) + `)"  class="primary_radio"  onChange="main_image(` +
                    images.indexOf(i) + `)"  value="` + images.indexOf(i) + `"  name="primary_image" type="radio" />
                    


                    <label  for="primary(` + images.indexOf(i) + `)" >
                      <img src="` + i.url + `" id="(` + images.indexOf(i) + `)" class="images"    alt="Image" >
                    </label>
                    
                      
                      
                      <button class="btn btn-danger p-1" onclick="delete_image(` + images.indexOf(i) + `)">حذف</button>
                  </div>`;





            });



            return image;
        }






        function delete_image(e) {
            images.splice(e, 1);
            document.getElementById('container').innerHTML = image_show();

            const dt = new DataTransfer()
            const input = document.getElementById('image')
            const {
                files
            } = input

            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (e !== i)
                    dt.items.add(file);
            }

            input.files = dt.files;
            console.log(document.getElementById('image').files);
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



        function addNewBrandddd() {


            localStorage.setItem("Ppay", $('#product_price').val());
            localStorage.setItem("Pname", $('#name').val());
            localStorage.setItem("Pdesc", $('#description').val());

            // alert($("input[type='search']").val())

            formData = {
                BrandName: $("input[type='search']").val(),

            }

            var bscs = $('.bs-select')

            $("#active").removeClass("active")

            $("#active").removeClass("selected")

            $.ajax({
                type: "POST",
                url: "https://instabargh.com/vendor-dashboard/createBrand",
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': jQuery(
                        'meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(response) {



                    console.log("ok")

                    // Assuming the response contains the new brand details
                    var newBrand = response;

                    console.log(newBrand)

                    $('#brandSelect').append('<option value="' + newBrand.id + '">' + newBrand.name +
                        '</option>');

                    // Select the newly added brand
                    $('#brandSelect').val(newBrand.id).trigger('change');



                },
                error: function(data) {
                    console.log(data);
                    alert('برند مورد نظر موجود می باشد');
                }
            });

            // $('#AddNewBrandForm2').submit();
        }





        function edit_image(id) {
            $(` #images(` + id + `)`).ijaboCropTool({
                preview: '.image-previewer',
                setRatio: 1,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['CROP', 'QUIT'],
                buttonsColor: ['#30bf7d', '#ee5155', -15],



            });
        }



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




        $(document).on('click', 'body *', function() {

            $('#addnewBrandBt').css('display', 'none');
        });



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

        function showSelected(cat, id = null) {

            if (typeof cat === 'object') {
                var name = cat.name;
            } else {

                var name = cat;
            }

            inputValidation()
            if (id) {

                var inputId = "catId_" + id;

                $('input:radio[name="category_id"]').filter('[value="' + id + '"]').attr('checked', true);

            }
            $('.SelectCatDiv').css('display', 'none');
            $('#topCatname').css('display', 'block');
            $('#selectedCatName').text(name);


            $('#searchCatResult').html("");
            $('#searchIncats').val("");

        }



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
                    imgWrap = $('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var arrfile = $('#arrfile')[0].files;
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
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'></div></div>";
                                    imgWrap.append(html);
                                    console.log(html)
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });


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

                });
            });

            $('body').on('click', ".upload__img-close", function(e) {


                $("#deleteImgMsg").css("display", "block")
                //var file = $(this).parent().data("file");
                //for (var i = 0; i < imgArray.length; i++) {
                //if (imgArray[i].name === file) {
                // imgArray.splice(i, 1);

                // Create a new input element without the removed file
                //         var input = $(this).closest('.upload__box').find('.upload__inputfile');
                //       var newInput = $('<input>', {
                //       type: 'file',
                //     name: input.attr('name'),
                //   multiple: input.attr('multiple'),
                // accept: input.attr('accept')
                //});
                //input.replaceWith(newInput);

                // Add the remaining files to the new input element
                //for (var j = 0; j < imgArray.length; j++) {
                // newInput.append(imgArray[j]);
                //}

                //         break;
                //     }
                // }
                //$(this).parent().parent().remove();
            });



            $('body').on('click', ".img-bg", function(e) {

                $(".selectedAsPrimary").removeClass("selectedAsPrimary");

                $(this).parent().addClass("selectedAsPrimary");

                var index = $(this).parent().index(); // Adding 1 because index is 0-based

                $("#mainImg").val(index)

            });
        }
    </script>

    <style>
        .yes {

            display: block;

        }

        .selectedAsPrimary {
            transition: all 0.3s;
            border: 3px solid red;
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
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;


            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
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
    <form style="display: none;" id="AddNewBrandForm2" action="{{ route('user.createBrand2') }}" method="post">
        @csrf
        <input type="hidden" id="vendor_id" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
        <input type="hidden" id="Pname" name="Pname">
        <input type="hidden" id="Ppay" name="Ppay">
        <input type="hidden" id="Pdesc" name="Pdesc">

        <input type="hidden" id="Pcat" name="Pcat">



        <input type="hidden" id="BrandNameForm" name="BrandName">

    </form>


    <!-- Modal -->
    <div class="modal fade" id="TagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ثبت تگ جدید</h5>
                </div>
                <div class="modal-body">

                    <form id="AddNewTagForm" method="post">
                        <input type="hidden" id="vendor_id" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
                        <label for="">نام تگ :</label>
                        <input type="text" id="TagName" name="TagName" class="form-control" required>
                        <span style="display: none" id="TagFormError" class="text-danger">ابتدا نام تگ را وارد کنید
                            ....</span>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>
                    <button type="button" id="saveTag" onclick="SubmitAddNewTagForm()" class="btn btn-primary"> ثبت تگ
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="brnadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ثبت برند جدید</h5>
                </div>
                <div class="modal-body">

                    <form id="AddNewBrandForm" action="{{ route('user.createBrand') }}" method="post">
                        <input type="hidden" id="vendor_id" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
                        <label for="">نام برند :</label>
                        <input type="text" id="BrandName" name="BrandName" class="form-control" required>
                        <span style="display: none" id="BrandFormError" class="text-danger">ابتدا نام برند را وارد کنید
                            ....</span>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>
                    <button type="button" id="save" onclick="SubmitAddNewBrandForm()" class="btn btn-primary"> ثبت
                        برند </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div style="display: flex !important; padding:50px !important;" class="modal-content">
                <div style="display: flex;" class="form-group col-md-3">
                    <label for="Warranty">گارانتی</label>
                    <select onchange="openWarantyModal() " class="form-control" id="waranty" name="Warranty">
                        <option value="1">
                            دارد
                        </option>
                        <option value="0" selected>ندارد</option>
                    </select>

                </div>
                <br>
                <div style="display: none;" class="hasWarantyInputs">
                    <label for="">مدت زمان</label>

                    <div class="form-group col-md-3">

                        <input type="texts" class="form-control" id="inputNumberWaranty">

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

                <span class="text-danger alertErr alertGaranty ">
                    مقدار گارانتی باید از نوع عدد باشد
                </span>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لفو</button>
                    <button type="button" onclick="saveWaranty()" class="btn btn-primary">تایید</button>
                </div>

            </div>
        </div>
    </div>




    <!-- Content Row -->
    <div style="color:black !important; " class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-1 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد محصول</h5>
            </div>
            {{-- <hr> --}}

            {{-- <div class="sol-12">

            <p style="text-align: right;" class="col-12">
                <span class="text-danger">*</span>
                دسنه بندی محصول :
            </p>

            @foreach (\App\Models\Category::lvl_one()->orderBy('id')->get() as $category)
            <div class="dropdown col-8">

                <div style="background: #bbbbbb" class="">
                    <span style="padding: 8px; cursor: pointer;" onclick="myFunction({{ $category->id }})"
                        class="dropbtn" id="dropbtn_{{ $category->id }}"> {{ $category->name }}
                    </span>
                </div>

                <div id="myDropdown_{{ $category->id }}" class="dropdown-content alldropdowns   ">
                    <input style="height: 25px;" type="text" placeholder="حستحو کنید ..."
                        id="myInput_{{ $category->id }}" onkeyup="filterFunction({{ $category->id }})">

                    @foreach ($category->childrens as $lvl_two)
                    <div class="">
                        <a id="a_{{ $lvl_two->id }}" onclick="selectCat({{ $lvl_two->id }},{{ $category->id }})"
                            style="background: #5b8e3e ; color:white; ">{{ $lvl_two->name }}</a>
                        <div class="">
                            @foreach ($lvl_two->childrens as $lvl_three)
                            <a id="a_{{ $lvl_three->id }}"
                                onclick="selectCat({{ $lvl_three->id }} ,{{ $category->id }})">{{ $lvl_three->name
                                }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            @endforeach
        </div> --}}

            @include('user.sections.errors')

            <div class="alert alert-danger" style="display: none;" id="deleteImgMsg">
                حذف عکس ها پس از ثبت محصول و در قسمت ویرایش محصول امکان پذیر است
            </div>

            <div class="card-body ">

                <form action="{{ route('user.products.store') }}" method="POST" id="currentForm"
                    enctype="multipart/form-data">

                    @csrf



                    <input type="hidden" name="mainImg" id="mainImg">

                    <div style="" class="form-row">
                        <div class="form-group col-md-3">
                            <label for="name"> <span class="text-danger">*</span> نام محصول </label>

                            <input class="form-control InputName" id="name" name="name"
                                onkeyup ="inputValidation()" type="text" value="{{ old('name') }}" required>
                            <span class="text-danger alertErr alertName ">
                                نام محصول الزامی است
                            </span>
                        </div>

                        <div class="form-group col-md-3 col-12 text-center d-flex justify-content-between">

                            {{-- <span class="text-danger alertErr alertGaranty " >
                                مقدار گارانتی باید از نوع عدد باشد
                            </span> --}}
                            <div class="">
                                {{-- <label class="my-2" for="waranty">وضعیت گارانتی :</label> --}}
                            </div>



                            <button style="height:40px;" type="button" class="btn btn-primary  px-5 text-center "
                                data-toggle="modal" data-target="#exampleModal">
                                گارانتی</button>
                            <span style="margin:5px;" id="newWarranty"></span>


                        </div>

                        <div class="form-group col-md-3 col-12">
                            <label for="brand_id"> <span class="text-danger">*</span>برند</label>
                            <div class="d-flex  justify-content-around">



                                <select name="brand_id" class="brandSelect selectoptionBrand InputBrand "
                                    onchange="inputValidation('Brand' ,'int' )" data-live-search="true" id="brandSelect">
                                    <option value="{{ $freeBrand->id }}" class="form-control" selected>
                                        {{ $freeBrand->name }}
                                    </option>



                                    @foreach ($brands as $brand)
                                        @if ($brand->created_by == null || $brand->created_by == Auth::user()->vendor->id || $brand->is_active == 1)
                                            <option value="{{ $brand->id }}" class="form-control">
                                                {{ $brand->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>



                                <div class="newBrandCheckbox" style="display: none;"
                                    onchange="inputValidation('Brand' , 'int')">
                                    <span id="newBrandName"></span>

                                    <input @checked(false) type="checkbox" checkednewBrand name="newBrand"
                                        id="addnewBrandCheckBox" onchange="SendNewBrand()">
                                    <label for="addnewBrandCheckBox">افزودن بعنوان برند جدید</label>
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




                        {{-- <div class="form-group col-md-3">
                        <label for="tag_ids">تگ</label>
                        <select id="tagSelect" name="tag_ids[]" multiple class="form-control" data-live-search="true"
                            data-live-search="true">
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary col-4" style="height: 40px;" data-toggle="modal"
                            data-target="#TagModal">
                            افزودن تگ
                        </button>

                    </div> --}}



                        <div style="margin-top: 10px;" class="form-group col-md-3">

                            قیمت (تومان) :
                            <input type="text" name="product_price" id="product_price" class="form-control"
                                onkeyup="inputValidation('Price' , 'int')">

                            {{--  <span class="text-danger alertErr alertPrice ">
                                مقدار قیمت باید از نوع عدد باشد
                            </span>  --}}
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control" id="description" name="description" style="height: 150px;">{{ old('description') }}</textarea>
                        </div>




                        <div class=" interior">


                            <div class="upload__img-wrap"></div>


                            <x-last-images />

                            <div class="upload__img-wrap2">
                            </div> <input type="file" id="arrfile" name="images[]" style="display: none;"
                                id="">

                            <label class="upload__btn btn btn-warning text-dark py-3 px-5">
                                <p class="m-0">افزودن تصویر جدید</p>
                                <input type="file" multiple accept="image/png, image/jpeg" data-max_length="20"
                                    class="upload__inputfile">
                            </label>

                            <a class="btn upload__btn btn btn-warning text-dark py-3 px-5" href="#open-modal">انتخاب تصویر
                                از تصاویر قبلی</a>
                        </div>

                        @if (App\Models\Admin\SiteSetting::first()->aparat_product)
                            <div class="form-group col-6">

                                <img class="iconsocialhover" style="width:40px!important;"
                                    src="{{ asset('main/images/socialicons/icons8-aparat.svg') }}" alt="">
                                <label for="apatatVideoLink">لینک آپارات

                                    <small>
                                        (
                                        این ویدیو باید درباره محصول شما باشد و در صفحه
                                        محصول نشان داده خواهد شد
                                        ... برای این کار شما باید لینک script ویویو را در سایت آپارات کپی و در اینجا
                                        جایگذاری کنید ...
                                        )
                                    </small>

                                </label>
                                <input type="text" class="form-control" id="apatatVideoLink" name="apatatVideoLink">

                            </div>
                        @endif





                        <div id="morImages" class="form-group col-md-12">

                            {{-- <input type="file" accept="image/*" name="img[]" multiple onchange="loadFile(event)"> --}}
                            <img style="width: 100px;" id="output" />

                            <div class="" style="width: 100%;" id="preview">

                                <div id="previewImgs"></div>
                                <div class="card-body d-flex flex-wrap justify-content-start" id="container">

                                </div>
                                <div style="display: none; justify-content: space-around; width: 100%; " id="deleteImgs">

                                </div>
                            </div>

                        </div>







                        <span style="text-align: right;  display: none;" class="col-12" id="choosedCat">


                        </span>


                        <span style="text-align: right;" class="col-12" id="choosedCat2">

                            {{ old('category_id') ? ($p = \App\Models\Category::find(old('category_id'))->name) : '' }}

                        </span>

                        <span @if (!old('category_id')) style="display: none;" @endif id="showCats"
                            onclick="editCat()" class="btn btn-primary">تغییر
                            دسته بندی</span>



                    </div>

                    {{-- @if (!old('category_id'))
                    <div id="ChooseCatDiv" style="height:100vh !important ;">
                        <nav style="display: flex;  justify-content: center; width:90%; margin:0 auto;">
                            @foreach (\App\Models\Category::lvl_one()->orderBy('id')->get() as $category)
                            <ul style="display: flex;   justify-content: center; " class="first_ul p-0">
                                <li style="width: 100%; margin:0 !important; ">
                                    <a style="width: 100%;" href="#">{{ $category->name }}</a>
                                    <ul>
                                        @foreach ($category->childrens as $lvl_two)
                                        <li style="width: 100%;">




                                            <label style="color:#fff; width:100%; cursor: pointer;"
                                                for="categorySelect({{ $lvl_two->id }})">{{ $lvl_two->name }}</label>




                                            <input style="display: none;" type="radio" class="category_id"
                                                name="category_id" onchange="getVariations({{ $lvl_two->id }})"
                                                id="categorySelect({{ $lvl_two->id }})" value="{{ $lvl_two->id }}" {{
                                                old('category_id')==$lvl_two->id ? 'selected' : '' }}>
                                            <ul style="width: 100%;float: left; ">
                                                @foreach ($lvl_two->childrens as $lvl_three)
                                                <div id="vatDiv" style="display: flex; justify-content: center; "
                                                    class="">
                                                    <label style="color:#fff; width:100%; cursor: pointer;"
                                                        for="categorySelect({{ $lvl_three->id }})">{{ $lvl_three->name
                                                        }}</label>
                                                    <input style="display: none;" type="radio" class="category_id"
                                                        name="category_id"
                                                        onchange="getVariations({{ $lvl_three->id }})"
                                                        id="categorySelect({{ $lvl_three->id }})"
                                                        value="{{ $lvl_three->id }}" {{
                                                        old('category_id')==$lvl_three->id ? 'selected' : '' }}>
                                                    <br>
                                                </div>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>


                            </ul>
                            </li>


                            </ul>
                            @endforeach
                        </nav>




                    </div>

                    @endif --}}

                    <hr>



                    <span style="display:none;" id="topCatname" onclick="$('.SelectCatDiv').css('display' , 'block')"
                        class="btn btn-outline-success col-md-6 mx-auto   fw-bold">

                        <strong class="fw-bold">
                            دسته انتخاب شده :
                        </strong>

                        <strong class="fw-bold" id="selectedCatName">

                        </strong>


                    </span>

                    <div class="row  SelectCatDiv">


                        <div class="col-md-6">
                            <span>

                                <span class="text-danger">*</span>
                                انتخاب دسته بندی</span>

                            <div class=" my-3">


                                <input type="text" class="form-control" onkeyup="searchcat()"
                                    placeholder="جستجوی دسته بندی ..." id="searchIncats">

                                <div id="searchCatResult"
                                    style=" display:flex; overflow: hidden; height:auto;  flex-wrap: nowrap;flex-direction: column; background-color: rgb(189 189 189 / 94%);border-radius:10px; z-index: 1000000000; right:3%;  "
                                    class="col-12">
                                </div>
                            </div>

                            <span class="text-danger alertErr alertCategory ">
                                مقدار دسته بندی الزامی است
                            </span>

                            @foreach (\App\Models\Category::lvl_one()->orderBy('id')->get() as $category)
                                <ul class="ulll">
                                    <li class="lii" style="cursor: pointer;">

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
                                            <li class="liii" style="cursor: pointer;">


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
                                                    <input class="category_idInputRadio " type="radio"
                                                        id="catId_{{ $lvlone->id }}" value="{{ $lvlone->id }}"
                                                        onchange="showSelected({{ $lvlone }})"
                                                        style="display: none;" name="category_id" id="">
                                                </div>

                                            </li>


                                            @if (count($lvlone->childrens) > 0)
                                                <ul class="ulll"
                                                    style="display: none;background-color: white;         border: 1px solid rgb(137, 135, 135);"
                                                    id="cat_2{{ $lvlone->id }}_child">

                                                    @foreach ($lvlone->childrens as $lvthree)
                                                        <li class="liii" style="cursor: pointer;">
                                                            <div class="form-group">

                                                                <label
                                                                    for="catId_{{ $lvthree->id }}">{{ $lvthree->name }}</label>
                                                                <input class="category_idInputRadio d-none" type="radio"
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


                    </div>








                    {{--  <input type="hidden" name="category_id" id="category_id_hidden">  --}}

                    <input type="hidden" name="primary_hidden" id="primary_hidden">
                    <input type="hidden" name="warrantyInputHidden" id="warrantyInputHidden">

                    <div class="row mt-4 g-1">
                        <div class="col-4"><a href="{{ route('user.products.index') }}"
                                class="btn btn-outline-dark  btn-blick">بازگشت</a></div>
                        <div class="col-8"><span class="btn btn-primary btn-block  text-center"
                                onclick="submitForm()">ثبت</span></div>

                    </div>
                </form>



            </div>
        </div>


    </div>
@endsection

<script src="{{ url('jquery/jquery.min.js') }}"></script>




<script>
    $(document).ready(function() {


        $('#brandSelect').select2({
            minimumInputLength: 2,
            escapeMarkup: function(markup) {
                return markup;
            },
            ajax: {
                url: 'https://instabargh.com/vendor-dashboard/createBrand',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#brandSelect').on('select2:open', function(e) {
            $('.select2-search__field').on('keyup', function() {
                var noResults = $('.select2-results__message').text() === 'No results found';
                if (noResults) {
                    $('#brandSelect').append('<option id="addNewBrand">Add New Brand</option>');
                } else {
                    $('#addNewBrand').remove();
                }
            });
        });

        $('#brandSelect').on('select2:select', function(e) {
            if ($(e.params.data.element).attr('id') === 'addNewBrand') {
                var brandName = $('.select2-search__field').val();

                $.ajax({
                    url: 'https://instabargh.com/vendor-dashboard/createBrand',
                    method: 'POST',
                    data: {
                        name: brandName
                    },
                    success: function(response) {
                        // Assuming the response contains the new brand details
                        var newBrand = response;

                        // Clear the search input
                        $('.select2-search__field').val('');

                        // Append the new option and select it
                        $('#brandSelect').append('<option value="' + newBrand.id +
                            '" selected>' + newBrand.name + '</option>');
                        $('#brandSelect').trigger('change');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        // Handle error scenario
                    }
                });
            }
        });
    });
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction(id) {

        $('.showw').removeClass('showw');

        document.getElementById("myDropdown_" + id).classList.toggle("showw");
    }

    function filterFunction(id) {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput_" + id);
        filter = input.value;
        div = document.getElementById("myDropdown_" + id);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;


            if (txtValue.indexOf(filter) > -1) {
                a[i].style.display = "flex";
            } else {
                a[i].style.display = "none";
            }
        }
    }

    function selectCat(thiscat, Mainparent) {

        $('.selectedCatt').removeClass('selectedCatt');
        $('.showw').removeClass('showw');
        console.log("thiscat : " + thiscat + "Mainparent : " + Mainparent);

        var a = document.getElementById("a_" + thiscat);
        console.log(a);
        var mastercat = document.getElementById("dropbtn_" + Mainparent);


        a.classList.toggle("selectedCatt");
        mastercat.classList.toggle("selectedCatt");


        console.log("thiscat : " + thiscat + "Mainparent : " + Mainparent);
        $('#category_id_hidden').val(thiscat);

    }

    function submitForm() {
        var selectedCat = $('.category_idInputRadio');





        var validate = inputValidation();


        if (validate) {
            if (window.confirm("آیا از اطلاعات وارد شده اطمینان دارید؟")) {
                $('#overlay').css('display', 'block');
                $('#currentForm').submit();

            }
        } else {
            alert("لطفا در درج اطلاعات دقت فرمایید")
        }






    }
</script>

<style>
    .dropbtn:hover,
    .dropbtn:focus {
        background-color: #5b8e3e;
        color: white;
    }

    #myInput {
        box-sizing: border-box;

        background-position: 14px 12px;
        background-repeat: no-repeat;
        font-size: 16px;
        padding: 14px 20px 12px 45px;
        border: none;
        border-bottom: 1px solid #ddd;
    }

    #myInput:focus {
        outline: 3px solid #ddd;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #5e5a5a;
        width: 100%;
        margin-right: 200px;
        overflow: auto;
        border: 1px solid #ddd;

        z-index: 1;
    }

    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;

        display: block;
    }

    .dropdown a:hover {
        background-color: #ddd;
        cursor: pointer;
        color: black;

    }

    .showw {
        display: flex;
        flex-wrap: wrap !important;
    }

    .selectedCatt {
        background-color: orange !important;

    }
</style>
