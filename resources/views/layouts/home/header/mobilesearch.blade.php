<script>
    function mobilesearch2() {



        if ($("input[name='mobileradiochecked']:checked").val() == null) {

            $('#SearchErr').css('display', 'block');
            
        } else {

            $('#SearchErr').css('display', 'none');
            var search_in = $("input[name='mobileradiochecked']:checked").val();

            
            console.log(search_in)

            
            switch (search_in) {
                
                case 'product':
                    var searchInput = $('#searchInput2').val();
                    formData = {
                        searchInput: $('#searchInput2').val()
                    }
                    document.querySelector("#searchResult2").classList.add('d-flex');
                    document.querySelector("#searchResult2").classList.remove('d-none');
                    $.ajax({
                        type: "POST",
                        url: '/SearchProductAjax',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function(data) {




                            var e = document.querySelector("#searchResult2");


                            var child = e.lastElementChild;
                            while (child) {
                                e.removeChild(child);
                                child = e.lastElementChild;
                            }


                            $("<a/>", {
                                href: 'https://instabargh.com/searchProductInAllCats?searchInput=' +
                                    searchInput,
                                name: 'link_html_edit',
                                id: 'searchResultItem',
                                class: ' vazirFont text-black searchResultItem search-title-style  text-center p-3 border  rounded',
                                html: searchInput + ' در همه ی دسته ها :  ',

                            }).appendTo(e);



                            data.forEach(element => {

                                var imgSrc =
                                    'https://instabargh.com/upload/files/products/images/' + element
                                    .img;

                                console.log(imgSrc);

                                $("<a/>", {


                                    href: 'https://instabargh.com/products/'+ element.slug,
            
                                    name: 'link_html_edit',
                                    id: 'searchResultItem',
                                    class: 'vazirFont text-black searchResultItem p-3  border-button-search',
                                    html: "<img src=" + imgSrc + ">" + element.name +
                                        ' در دسته ی :  ' + element.cat
                                        .name,

                                }).appendTo(e);

                            });

                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);



                        }
                    });

                    break;

                case 'vendor':
                    var searchInput = $('#searchInput2').val();
                    formData = {
                        searchInput: $('#searchInput2').val()
                    }
                    document.querySelector("#searchResult2").classList.add('d-flex');
                    document.querySelector("#searchResult2").classList.remove('d-none');
                    $.ajax({
                        type: "POST",
                        url: '/searchVendorsAjax',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {

                            var e = document.querySelector("#searchResult2");


                            var child = e.lastElementChild;
                            while (child) {
                                e.removeChild(child);
                                child = e.lastElementChild;
                            }


                            data.data.forEach(element => {

                                $("<a/>", {

                                    href: 'https://instabargh.com/stores/' +
                                        element.name,
                                        
                                    name: 'link_html_edit',
                                    id: 'searchResultItem',
                                    class: 'vazirFont text-black searchResultItem',
                                    html: element.title,

                                }).appendTo(e);



                            });

                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });

                    break;

                case 'brand':
                    var searchInput = $('#searchInput2').val();
                    formData = {
                        searchInput: $('#searchInput2').val()
                    }
                    document.querySelector("#searchResult2").classList.add('d-flex');
                    document.querySelector("#searchResult2").classList.remove('d-none');
                    $.ajax({
                        type: "POST",
                        url: '/searchBrandsAjax',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {

                            var e = document.querySelector("#searchResult2");


                            var child = e.lastElementChild;
                            while (child) {
                                e.removeChild(child);
                                child = e.lastElementChild;
                            }

                            data.data.forEach(element => {



                                $("<a/>", {
                                    href: 'https://instabargh.com/brands/' +
                                        element.slug,
                                    name: 'link_html_edit',
                                    id: 'searchResultItem',
                                    class: 'vazirFont text-black searchResultItem',
                                    html: element.name,

                                }).appendTo(e);



                            });
                        },
                        error: function(data) {

                        }
                    });

                    break;

                default:
                    break;
            }





        }
    }

    function searchBy2(id) {

        console.log(id );



        var product = $('#product_label2');
        var vendor = $('#vendor_label2');
        var brand = $('#brnad_label2');



        
        var searchInputt = $('#searchInputtDiv2');
        var searchText = $('#searchInput2');

        searchText.css('border', 'none');
        var e = document.querySelector("#searchResult2");

        var child = e.lastElementChild;
        while (child) {
            e.removeChild(child);
            child = e.lastElementChild;
        }

        $('.activeSearch').removeClass('activeSearch');

        switch (id) {
            case 1:



                vendor.css('border', 'none ');
                product.css('border', 'none ');
                vendor.css('color', 'black ');
                product.css('color', 'black ');

                // product.css('border-bottom', '3px solid #025e2b  ');
                // vendor.css('border-bottom', '3px solid #025e2b   ');

                brand.css('border', '3px solid #025e2b ');
                brand.addClass('activeSearch');

                brand.css('border-bottom', '5px solid white  ');
                brand.css('color', '#025e2b ');
                brand.css('z-index', '999');
                vendor.css('z-index', '1');
                brand.css('background-color', '#fff');

                searchText.attr("placeholder", "نام برند مورد نظر را اینجا بنویسید ");
                searchInputt.css('border', '3px solid #025e2b');
                searchInputt.css('border-radius', '10px 0px 0px 10px  ');

                break;
            case 2:

                brand.css('border', 'none ');
                product.css('border', 'none ');
                brand.css('color', 'black ');
                product.css('color', 'black');

                vendor.css('border', '3px solid #3c5cfa  ');

                // product.css('border-bottom', '3px solid #3c5cfa  ');

                vendor.css('color', '#3c5cfa ');


                vendor.addClass('activeSearch');

                vendor.css('border-bottom', '5px solid white  ');
                vendor.css('z-index', '999');
                brand.css('z-index', '1');

                searchText.attr("placeholder", "نام فروشگاه مورد نظر را اینجا بنویسید");

                searchInputt.css('border', '3px solid #3c5cfa');

                searchInputt.css('border-radius', '10px 0px 0px 10px  ');

                break;
            case 3:
                brand.css('border', 'none');
                vendor.css('border', 'none');

                brand.css('color', 'black');
                vendor.css('color', 'black');

                // vendor.css('border-bottom', '3px solid #a3a0a0   ');
                product.addClass('activeSearch');

                product.css('border', '3px solid #a3a0a0 ');
                product.css('border-bottom', '5px solid white ');
                product.css('color', '#a3a0a0 ');

                searchText.attr("placeholder", "نام محصول مورد نظر را اینجا بنویسید");
                product.css('z-index', '999');
                brand.css('z-index', '1');
                vendor.css('z-index', '1');

                searchInputt.css('border', '3px solid #a3a0a0');
                searchInputt.css('border-radius', '10px 0px 0px 10px  ');

                break;

            default:
                break;
        }


    }
</script>



<div class="container-fluid fixed-top bg-white pb-2  p-0 ">
    @include('subtitle')

    <div id="searchareaa"
        class="d-flex flex-column align-content-center col-md-8  justify-content-center align-items-center">
        <div style="position: absolute;top:0;">

        </div>

        <form class="col-12 " action="{{ route('search') }}" id="SearcForm" method="get">
            <small id="SearchErr" style="display: none;" class="text-danger animate__fadeIn">لطفا دسته مورد نظر را
                انتخاب کنید</small>

            <div class="d-flex justify-content-between">
                <div class="btn-group  col-md-8" style="  margin-right: 5%; " role="group"
                    aria-label="Basic radio toggle button group">
                    <input type="radio" onchange="searchBy2(3)" class="btn-check  redioo" name="mobileradiochecked"
                        value="product" id="ProductSearchMobile" autocomplete="off" <?php if (isset($search_in) && $search_in == 'product') {
                            echo 'checked';
                        } ?> checked>

                    <label style="padding: 7px 35px;" onclick="searchBy2(3)"
                        @if (isset($search_in) && $search_in == 'product') style=" background-color:#ffff;   border:3px solid #a3a0a0 !important; border-bottom : 5px solid white !important;  color:black !important @endif "
                    class="col-3   text-center rounded-0 rounded-top btlabel  " id="product_label2" for="ProductSearchMobile">
                    محصولات
                </label>
            
    
    
    
                <input onchange="searchBy2(1)" type="radio" class="btn-check redioo" name="mobileradiochecked" value="brand"
                    id="BrandSerachMobile" autocomplete="off" <?php if (isset($search_in) && $search_in == 'brand') {
                        echo 'checked';
                    } ?>>
    
                <label onclick="searchBy2(1)"
                    style=" --bs-btn-border-color: #ced4da;--bs-btn-color: #2c2c2c; padding: 7px ;
                    @if (isset($search_in) && $search_in == 'brand') background-color:#ffff;  border:3px solid #025e2b !important; border-bottom : 5px solid white !important; border-radius: 0px !important;   color:black !important @endif "
                    id="brnad_label2" class="col-3   rounded-0 rounded-top btlabel " for="BrandSerachMobile">
                    برند
                </label>
    
    
    
    
    
                <input type="radio" onchange="searchBy2(2)" class="btn-check redioo" name="mobileradiochecked" value="vendor"
                    id="VendorSearchMobile" autocomplete="off" @if (isset($search_in) && $search_in == 'vendor') checked @endif>
    
                <label
                    style="--bs-btn-border-color: #ced4da;--bs-btn-color: #2c2c2c ;padding : 7px 35px;
                    
                    
                    @if (isset($search_in) && $search_in == 'vendor') background-color:#ffff;  border:3px solid #3c5cfa !important;  border-bottom : 5px solid white !important; color:black !important @endif 
                    "
                    id="vendor_label2" class=" col-3  rounded-0 rounded-top btlabel " for="VendorSearchMobile">
                    فروشگاه
                </label>
    
    
    
    
               
    
    
            </div>
                       @if (Route::currentRouteName() != 'home')
                        <div class="">
                            <a href="{{ url()->previous() }}">

                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-arrow-left text-black" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                                </svg>

                            </a>
                        </div>
                        @endif
                </div>





                <div style="
    
    
            @if (isset($search_in) && $search_in == 'brand') border:3px solid #025e2b !important;  
            
            @elseif(isset($search_in) && $search_in == 'product')
            border:3px solid #a3a0a0 !important;  
            @elseif(isset($search_in) && $search_in == 'vendor')
            
            border:3px solid #3c5cfa !important; @endif
         
            "
                    id="searchInputtDiv2" class=" input-group input-group-lg flex-row-reverse">


                    <button
                        @if (isset($search_in)) style="border-radius: 0px !important;   border:none; border-right: 1px solid black " @endif
                        class="btn btn-primary" type="submit" id="button-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>

                    </button>
                    <input type="text" onkeydown="mobilesearch2()" name="searchInput" id="searchInput2"
                        style="autocomplete='off'; border-top-right-radius: 0px;   @if (isset($search_in)) border:none !important; @endif  "
                        value="  <?php if (isset($search_input)) {
                            echo $search_input;
                        } ?>" class="form-control border-dark fontAwsem searchinputheader"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                        placeholder=" نام محصول مورد نظر را بنویسید ...">



                </div>

        </form>



    </div>
</div>
