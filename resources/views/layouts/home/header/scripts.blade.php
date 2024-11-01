{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}


{{-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    
    --}}



<link rel="stylesheet" href="{{ url('jquery/jquery.min.js') }}">

<link rel="stylesheet" href="{{ url('bootstrap/js/bootstrap.bundle.min.js') }}">

<link rel="stylesheet" href="{{ url('owlcarousel/owl.carousel.min.js') }}">

<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}




<script type="text/javascript">
    var scrollableElement = document.body; //document.getElementById('scrollableElement');

    scrollableElement.addEventListener('wheel', checkScrollDirection);

    function checkScrollDirection(event) {


        if (checkScrollDirectionIsUp(event)) {


            $('.mainnn').addClass('stickymain');
            $('.bigCatMenu').css('height', 'auto');
            $('.nav-login').addClass('stickyMenu');

            if (document.body.scrollTop < 200) {
                $('.nav-login').removeClass('stickyMenu');
                $('.mainnn').removeClass('stickymain');

            }
        } else {
            if (document.body.scrollTop > 200) {
                $('.bigCatMenu').css('height', '0px');

                var e = document.querySelector("#searchResult");


                var child = e.lastElementChild;
                while (child) {
                    e.removeChild(child);
                    child = e.lastElementChild;
                }


            } else {

                $('.nav-login').addClass('stickyMenu');
                $('.bigCatMenu').css('height', 'auto');
            }
            $('.mainnn').removeClass('stickymain');
            console.log('Down');

        }
    }

    function checkScrollDirectionIsUp(event) {
        if (event.wheelDelta) {
            return event.wheelDelta > 0;
        }
        return event.deltaY < 0;
    }
    console.log('document.querySelector("#searchResult")', 'sa;am');
    document.onclick = function(e) {
        if (e.target.id !== 'searchResult') {
            var searchResultElement = document.querySelector("#searchResult");
            // searchResultElement.addClass('d-none');

            var child = searchResultElement.lastElementChild;
            while (child) {
                searchResultElement.removeChild(child);
                child = searchResultElement.lastElementChild;
            }
        }
    };


    var scrollableElement = document.body; //document.getElementById('scrollableElement');

    scrollableElement.addEventListener('wheel', checkScrollDirection);

    function checkScrollDirection(event) {
        if (checkScrollDirectionIsUp(event)) {

            var scrollVal = window.pageYOffset;


            $('.nav-login').addClass('stickyMenu');


            if (scrollVal < 300) {

                $('.nav-login').removeClass('stickyMenu');


            }

        } else {
            if (scrollVal < 300) {

                $('.nav-login').removeClass('stickyMenu');


            }



            $('.nav-login').removeClass('stickyMenu');


        }
    }

    function checkScrollDirectionIsUp(event) {
        if (event.wheelDelta) {
            return event.wheelDelta > 0;
        }
        return event.deltaY < 0;
    }


    function inputSearch() {

        if ($("input[name='btnradioSearch']:checked").val() == null) {

            $('#SearchErr').css('display', 'block');
            $('form`').on('submit', function(e) {
                e.preventDefault();

            });

        } else {
            $('#SearchErr').css('display', 'none');
            var search_in = $("input[name='btnradioSearch']:checked").val();

            switch (search_in) {

                case 'product':

                    document.querySelector("#searchResult").classList.add('d-flex');
                    document.querySelector("#searchResult").classList.remove('d-none');


                    var searchInput = $('#searchInput').val();
                    formData = {
                        searchInput: $('#searchInput').val()
                    }
                    $.ajax({
                        type: "POST",
                        url: '/SearchProductAjax',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {




                            var e = document.querySelector("#searchResult");



                            var child = e.lastElementChild;
                            while (child) {
                                e.removeChild(child);
                                child = e.lastElementChild;
                            }


                            $("<a/>", {
                                href: 'https://instabargh.com/search?btnradioSearch=product&searchInput=' +
                                    searchInput,
                                name: 'link_html_edit',
                                id: 'searchResultItem',
                                class: ' vazirFont text-black searchResultItem search-title-style bg-white text-center px-3 mx-2 border  rounded',
                                html: searchInput + ' در همه ی دسته ها :  ',

                            }).appendTo(e);



                            data.forEach(element => {

                                var imgSrc =
                                'https://instabargh.com/upload/files/products/min-img/' + element
                                    .img;

                                console.log(imgSrc);

                                $("<a/>", {


                                    href: 'https://instabargh.com/products/'+ element.slug,
                                    name: 'link_html_edit',
                                    id: 'searchResultItem',
                                    class: 'vazirFont text-black searchResultItem px-3 mx-3  border-button-search',
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
                    var searchInput = $('#searchInput').val();
                    formData = {
                        searchInput: $('#searchInput').val()
                    }
                    document.querySelector("#searchResult").classList.add('d-flex');
                    document.querySelector("#searchResult").classList.remove('d-none');



                    $.ajax({
                        type: "POST",
                        url: '/searchVendorsAjax',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {

                            var e = document.querySelector("#searchResult");


                            var child = e.lastElementChild;
                            while (child) {
                                e.removeChild(child);
                                child = e.lastElementChild;
                            }


                            data.data.forEach(element => {
                                var imgCatSrc =
                                    'https://instabargh.com/upload/files/vendors/images/avatars/' +
                                    element.avatar;

                                $("<a/>", {
                                    href: 'https://instabargh.com/stores/' +
                                        element.name,
                                    name: 'link_html_edit',
                                    id: 'searchResultItem',
                                    class: 'vazirFont text-black searchResultItem px-3 mx-2',
                                    html: "<img class='rounded-circle mx-2 my-1' src=" +
                                        imgCatSrc + ">" + element.title,

                                }).appendTo(e);



                            });

                        },
                        error: function(data) {
                            console.log(data.responseJSON.message);
                        }
                    });

                    break;

                case 'brand':
                    var searchInput = $('#searchInput').val();
                    formData = {
                        searchInput: $('#searchInput').val()
                    }
                    document.querySelector("#searchResult").classList.add('d-flex');
                    document.querySelector("#searchResult").classList.remove('d-none');

                   



                    $.ajax({
                        type: "POST",
                        url: '/searchBrandsAjax',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {

                            var e = document.querySelector("#searchResult");


                            var child = e.lastElementChild;
                            while (child) {
                                e.removeChild(child);
                                child = e.lastElementChild;
                            }

                            data.data.forEach(element => {
                                var imgBrandSrc =
                                    'https://instabargh.com/upload/files/brands/icon/' +
                                    element.icon_name;


                                $("<a/>", {
                                    href: 'https://instabargh.com/brands/' +
                                        element.slug,
                                    name: 'link_html_edit',
                                    id: 'searchResultItem',
                                    class: 'vazirFont text-black searchResultItem px-3 mx-2',
                                    html: "<img class=' mx-2 my-1' src=" +
                                        imgBrandSrc + ">" + element.name,

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

        if ($("#searchInput").val() == "" || $("#searchInput").val() == " " || $("#searchInput").val() == "   "){
            
            document.querySelector("#searchResult").classList.add('d-none');
            document.querySelector("#searchResult").classList.remove('d-flex');

        }

    }

    function searchBy(id) {

        console.log(id);



        var product = $('#product_label');
        var vendor = $('#vendor_label');
        var brand = $('#brnad_label');
        var searchInputt = $('#searchInputtDiv');
        var searchText = $('#searchInput');

        searchText.css('border', 'none');
        var e = document.querySelector("#searchResult");

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


                searchInputt.css('border', '3px solid #a3a0a0');
                searchInputt.css('border-radius', '10px 0px 0px 10px  ');

                break;

            default:
                break;
        }


    }



    function Sendticket() {



        var username = $('.ticketUsername').val();
        var ticketUsername_guest = $('.ticketUsername_guest').val();
        var ticketSubject = $('.ticketSubject').val();
        var ticketEmail = $('.ticketEmail').val();
        var ticketText = $('.ticketText').val();
        var Tnumber = $('#Tnumber').val();
        var Tnumber2 = $('#Tnumber2').val();

        if (ticketEmail == "" || ticketSubject == "" || ticketText == "") {
            $('#ticketError').css('display', 'block');
            $('#ticketErrorText').text('لطفا تمامی فیلد ها را به درستی پر کنید ...');
            console.log('all null');

        } else {

            if (!validateEmail(ticketEmail)) {
                $('#ticketError').css('display', 'block');
                console.log('emailError');
                $('#ticketErrorText').text('مقدار ایمیل به درستی وارد نشده است')
            } else {

                formData = {
                    number: Tnumber ? Tnumber : Tnumber2,
                    username: username ? username : ticketUsername_guest,
                    subject: ticketSubject,
                    ticketEmail: ticketEmail,
                    ticketText: ticketText
                };


                $.ajax({

                    type: "POST",
                    url: "/Sendticket",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        $('#ticketError').css('display', 'none');
                        $('#ticketSuccess').css('display', 'block');

                    },
                    error: function(data) {
                        console.log(data.responseJSON.message);


                    }

                });

            }
        }
    }

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function follow(id) {
        formData = {
            id: id
        };

        $.ajax({
            type: "POST",
            url: "/vendor-dashboard/follow/follow",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                console.log("ok followed");

                $("#unfollowBt_"+id).css("display" , "block");
                
                $("#followBt_"+id).css("display" , "none");
            
            }

                ,
            error: function(data) {

                console.log(data);
            }
        })
    }

    function unfollow(id) {
        formData = {
            id: id
        };

        $.ajax({
            type: "POST",
            url: "/vendor-dashboard/follow/unfollow",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                $("#unfollowBt_"+id).css("display" , "none");
                
                $("#followBt_"+id).css("display" , "block");
            
                console.log("ok unfollowed");
                
                }



                ,
            error: function(data) {

                console.log(data);
            }
        })
    }

    function copyToClipboardProductFromAll(vendorName, productName) {



        var inputc = document.body.appendChild(document.createElement("input"));
        console.log(inputc);

        inputc.value = "https://instabargh.com/" + vendorName + "/products/" + productName;



        inputc.focus();
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
        alert("لینک اشتراک گداری کپی شد !");
    }

    function copyToClipboardVendorFromAll(vendorName) {



        var inputc = document.body.appendChild(document.createElement("input"));
        console.log(inputc);

        inputc.value = "https://instabargh.com/" + vendorName + "/products/";



        inputc.focus();
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
        alert("لینک اشتراک گداری کپی شد !");
    }

    function copyToClipboard(id) {
        var inputc = document.body.appendChild(document.createElement("input"));
        inputc.value = window.location.href;
        inputc.focus();
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
        alert("لینک اشتراک گداری کپی شد !");
    }

    function addTocomp(id) {

        $(".compCounter").css("display" , "block")

        var compNumber = $('#compNumber');



        var compSpan = $('.compNumber');


        formData = {
            id: id
        }
        $.ajax({
            type: "POST",
            url: '/AddToComparison',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {


                var newCompNumber = parseInt(compNumber.val()) + 1;

                compNumber.val(newCompNumber);
                compSpan.text(newCompNumber);
                $(".compCounter").css("display" , "block !important")

                
                
            },
            error: function(data) {
                console.log(data.responseJSON.message);
            }
        });


    }

    function deleteFromComp(id) {
        formData = {
            id: id
        };
        $.ajax({

            type: "POST",
            url: '/deleteFromComp',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }

        });
    }


    function addToFAvorite(type, id) {




        switch (type) {
            case 'p':

                formData = {
                    id: id,
                    type: 'product'
                }

                $.ajax({
                    type: "POST",
                    url: '/favorite/save',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        console.log(data);


                        // $('.dissliked').css('display', 'none');

                        // $('.liked').css('display', 'block');

                        $('.addToFAvorite_' + id).css('display', 'none');

                        $('.removeFromFavorite' + id).css('display', 'inline-block');



                    },
                    error: function(data) {
                        console.log(data);
                    }

                });

                break;

            case 's':
                break;

            case 'v':
                formData = {
                    id: id,
                    type: 'vendor'
                }

                $.ajax({
                    type: "POST",
                    url: '/favorite/save',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        console.log(data);


                        $('.addToFAvorite_' + id).css('display', 'none');

                        $('.removeFromFavorite' + id).css('display', 'inline-block');


                        // window.location.reload();


                    },
                    error: function(data) {
                        console.log(data);
                    }

                });

                break;

            case 'c':
                formData = {
                    id: id,
                    type: 'category'
                }

                $.ajax({
                    type: "POST",
                    url: '/favorite/save',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        {{--  console.log(data);  --}}

                        
                        $('.addToFAvorite_' + id).css('display', 'none');

                        $('.removeFromFavorite' + id).css('display', 'inline-block');

                        {{--  window.location.reload();  --}}



                    },
                    error: function(data) {
                        console.log(data);
                    }

                });

                break;

            default:
                break;
        }



    }

    function removeFromFavorite(type, id) {

        switch (type) {
            case 'p':

                formData = {
                    id: id,
                    type: 'product'
                }



                $.ajax({

                    type: "POST",
                    url: '/favorite/deleteFromFAvorite',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {


                        // $('.dissliked').css('display', 'block !important');


                        // $('.liked').css('display', 'none');



                        $('.addToFAvorite_' + id).css('display', 'inline-block');

                        $('.removeFromFavorite' + id).css('display', 'none');

                        // window.location.reload();

                    },
                    error: function(data) {


                    }

                });

                break;

            case 's':
                break;

            case 'v':


                formData = {
                    id: id,
                    type: 'vendor'
                }



                $.ajax({

                    type: "POST",
                    url: '/favorite/deleteFromFAvorite',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        $('.addToFAvorite_' + id).css('display', 'inline-block');

                        $('.removeFromFavorite' + id).css('display', 'none');

                    },
                    error: function(data) {
                        console.log(data);
                    }

                });


                break;
            case 'c':
                formData = {
                    id: id,
                    type: 'category'
                }

                $.ajax({
                    type: "POST",
                    url: '/favorite/deleteFromFAvorite',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        


                        $('.removeFromFavorite' + id).css('display', 'none');

                        $('.addToFAvorite_' + id).css('display', 'inline-block');

                        //window.location.reload();

                    },
                    error: function(data) {
                        console.log(data);
                    }

                });

                break;

            default:
                break;
        }





    }

    function formSubmit() {

        var variations = $('.variations:checked').map(function() {
            return this.value;
        }).get().join('-');


        if (variations == "") {
            $('#variation-form').prop('disabled', true);
        } else {
            $('#variation-form').val(variations);
        }



        var brands = $('#brand:checked').map(function() {

            console.log(this.value);

            return this.value
        }).get().join('-');



        if (brands != "") {

            $('#brands_hidden').val(brands);
        } else {
            $('#brands_hidden').prop('disabled', true);
        }

        let sortBy = $('#SortBy').val();
        // console.log(sortBy);       
        if (sortBy != "") {
            $('#SortByHiddenInput').val(sortBy)
        } else {
            $('#SortByHiddenInput').porp('disabled', true);

        }


        <?php if(isset($attributes))  { ?>
        let attributes = @json($attributes);
        attributes.map(attributes => {

            let attr = $(`.attribute-${attributes.id}:checked`).map(function() {
                return this.value;
            }).get().join('-');

            // console.log(attr)

            if (attr == "") {
                $(`#attribute-form-${attributes.id}`).prop('disabled', true);
            } else {
                $(`#attribute-form-${attributes.id}`).val(attr);

            }
        });

        <?php } ?>


        $('#form').submit();

        $('#form').on('submit', function(event) {
            event.preventDefualt();
            let currentUrl = '{{ url()->current() }}';
            let url = currentUrl + '?' + decodeURIComponent(currentUrl.serialize());
            // $('#form').attr('action', url);
            $(location).attr('href', url);
        });
    }

    function hideOrShowFilterOnMobile() {

        if ($(window).width() < 767) {

            $("#formFilter").toggleClass(" show");

        }
    }



    function gotoResultSearch_product(slug, name) {
        window.location.href = "/categories/" + slug + "?search_in=" + name;

        // window.location.href= +'/categories/'+slug+'/?search_in='+name;
    }



    function rateVendor(id, rate) {
        formData = {
            vendor_id: id,
            rate: rate
        }
        $.ajax({
            type: "POST",
            url: '/VendorRate',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {


                $('.alertVEndorRate').css('display', 'block');
                $('.rate').css('display', 'none');

            },
            error: function(data) {
                console.log(data.responseJSON.message);
            }
        });
    }

    function ProductRate(id, rate) {
        formData = {
            product_id: id,
            rate: rate
        }
        $.ajax({
            type: "POST",
            url: '/ProductRate',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {


                $('.alertVEndorRate').css('display', 'block');

            },
            error: function(data) {
                console.log(data.responseJSON.message);
            }
        });
    }

    $(document).ready(function() {

        /*FILTER/CARDS PAGES JS************************************/
        var filterBtns = $('.filter-btn');
        var cards = $('.card');
        filterBtns.click(function(event) {
            /*Takes care of highlighting current filter*/
            event.preventDefault();
            $('.selected').removeClass('selected');
            $(this).addClass('selected');

            /*Takes care of showing correct cards*/
            var currentFilter = $(this).attr('data-filter');
            if (currentFilter === 'all') {
                jQuery.each(cards, function(i, v) {
                    $(this).show();
                });
            } else {
                jQuery.each(cards, function(i, v) {
                    /*If statement checks if any of the filters are in the currentFilter*/
                    if (v.getAttribute('data-filter').indexOf(currentFilter) >= 0) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });



        /*Takes care of cutting extra chars from cards*/
        var bodyText = $('.card-body');
        bodyText.each(function() {
            $(this).text($(this).attr('data-short-text'));
        });


        /*Takes care of expanding card when more info is clicked*/
        var moreLinks = $('.more-link');

        moreLinks.click(function(event) {
            var cardClicked = $(this).parents('.card');
            var textContainer = cardClicked.find('.card-text-container');
            var cardClickText = cardClicked.find('.card-body');
            var locationInfo = cardClicked.find('p.card-location');

            /*Checks to see if card is already open*/
            if ($(this).html() === 'Back') {
                if ($(window).width() >= 768) {
                    $("html, body").animate({
                        scrollTop: 400
                    }, "slow");
                }
                cardClickText.text(cardClickText.attr('data-short-text'));
                locationInfo.fadeOut('easeOutExpo');

                cardClicked.css({
                    'width': '300px',
                    'height': '500px',
                    'margin': '10px',
                    'display': 'inline-block'
                });
                cardClicked.find('.card-img-container').css({
                    'height': '200px'
                });
                $(this).html('More Info');
                textContainer.removeClass('expanded');
            }

            /*If it isnt open, then depending on device transform width and height or just height*/
            else {
                $(this).html('Back');

                cardClickText.text(cardClickText.attr('data-orig-text'));
                locationInfo.fadeIn('easeInQuint');
                var pos = cardClicked.position();

                /*If desktop*/
                if ($(window).width() >= 768) {
                    cardClicked.css({
                        'display': 'block',
                        'margin': '0 auto',
                        'width': '750px',
                        'height': '750px'
                    });

                    cardClicked.find('.card-img-container').css({
                        'height': '350px'
                    });


                }
                /*If mobile*/
                else {
                    cardClicked.css('height', '750px');
                }
                textContainer.addClass('expanded');
                // $("html, body").animate({ scrollTop: pos.top + 900 }, "slow");
            }

        });
        /**/

    });



    // Open the Modal
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    // Close the Modal
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }

    function openimg(src) {


        var newSrc = src; /* problem line ?*/

        focus = document.getElementById('focus');

        console.log(focus);
        focus.src = newSrc;
        console.log(src);

        focusDiv = document.getElementById('focusDiv');
        focusDiv.style.display = "block";

    }


    function closeimg() {

        focusDiv.style.display = "none";




    }

    $('.variation-select').on('change', function() {
        let variation = JSON.parse(this.value);
        let variationPriceDiv = $('.variation-price');
        variationPriceDiv.empty();

        if (variation.is_sale) {
            let spanSale = $('<span />', {
                class: 'new',
                text: toPersianNum(number_format(variation.sale_price)) + ' تومان'
            });
            let spanPrice = $('<span />', {
                class: 'old',
                text: toPersianNum(number_format(variation.price)) + ' تومان'
            });

            variationPriceDiv.append(spanSale);
            variationPriceDiv.append(spanPrice);
        } else {
            let spanPrice = $('<span />', {
                class: 'new',
                text: toPersianNum(number_format(variation.price)) + ' تومان'
            });
            variationPriceDiv.append(spanPrice);
        }

        $('.quantity-input').attr('data-max', variation.quantity);
        $('.quantity-input').val(1);

    });
    // var start = true;
    // var pan_elem = $(".pan");
    // var pan_zoom = Panzoom(pan_elem[0], {

    //     maxZoom: 2,
    //     minZoom: 0.5,
    //     initialZoom: 1,
    //     zoomSpeed: 1,
    //     animate: true,
    //     overflow: 'unset',
    // });

    // pan_elem[0].addEventListener('panzoomstart', (event) => {
    //     start = false;
    // });
    // pan_elem[0].addEventListener('panzoomend', (event) => {
    //     console.log(event.detail);
    //     pan_zoom.zoom(1, {
    //         animate: true
    //     });
    //     pan_zoom.pan(0, 0);
    //     start = true;
    // });
    // pan_elem[0].parentElement.addEventListener('wheel', (event) => {
    //     if (start) {
    //         pan_zoom.zoomWithWheel(event);
    //         setInterval((pan_zoom) => {
    //             pan_zoom.zoom(1, {
    //                 animate: true
    //             });
    //             pan_zoom.pan(0, 0);
    //         }, 1000, pan_zoom);
    //     }
    // });




    function ChangPic() {

        console.log($('.imgRadio:checked').val())

        $('#MainPic').attr('src', $('.imgRadio:checked').val());
    }


    function showVendorPhone() {


        $('#phoneSvg').css('display', 'none');
        $('#phoneVendor').css('display', 'block');
    }

    function showVendorAddress() {


        $('#AddressSvg').css('display', 'none');
        $('#Address').css('display', 'block');
    }
</script>
