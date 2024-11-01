<script>
    document.onclick = function(e) {
        if (e.target.id !== 'searchResult') {
            var searchResultElement = document.querySelector("#searchResult");
            searchResultElement.classList.add('d-none');

            var child = searchResultElement.lastElementChild;
            while (child) {
                searchResultElement.removeChild(child);
                child = searchResultElement.lastElementChild;
            }
        }
    };
    document.onclick = function(e) {
        if (e.target.id !== 'searchResult2') {
            var searchResultElement = document.querySelector("#searchResult2");
            searchResultElement.classList.add('d-none');

            var child = searchResultElement.lastElementChild;
            while (child) {
                searchResultElement.removeChild(child);
                child = searchResultElement.lastElementChild;
            }
        }
    };

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

                brand.css('border', '3px solid #025e2b ');
                brand.addClass('activeSearch');

                brand.css('border-bottom', '3px solid white  ');
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
                vendor.css('color', '#3c5cfa ');
                vendor.addClass('activeSearch');
                vendor.css('z-index', '999');
                brand.css('z-index', '1');
                vendor.css('background-color', '#fff');
                vendor.css('border-bottom', '7px solid white  ');
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
                product.css('z-index', '999');
                brand.css('z-index', '1');
                vendor.css('z-index', '1');
                product.css('background-color', '#fff');
                searchInputt.css('border-radius', '10px 0px 0px 10px  ');

                break;

            default:
                break;
        }


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




















    $(document).ready(function() {
        $('.loop').owlCarousel({

            items: 9,
            loop: false,
            rewind: true,
            rtl: true,
            autoplay: true,
            autoplayTimeout: 4500,
            autoplayHoverPause: true,
            dots: false

        });
        $('.loop-vendor').owlCarousel({

            items: 5,
            loop: false,
            rewind: true,
            margin: 10,
            rtl: true,
            autoplay: true,
            autoplayTimeout: 4500,
            autoplayHoverPause: true,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                    margin: 40,
                },
                440: {
                    items: 2,
                    margin: 5,
                },
                // breakpoint from 480 up
                768: {
                    items: 2,
                },
                // breakpoint from 768 up
                900: {
                    items: 5,
                }
            }

        });
        $('.similar-vendor').owlCarousel({

            items: 5,
            loop: false,
            rewind: true,
            margin: 10,
            rtl: true,

            autoplayTimeout: 4500,
            autoplayHoverPause: true,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                    margin: 40,
                },
                440: {
                    items: 2,
                    margin: 5,
                },
                // breakpoint from 480 up
                768: {
                    items: 2,
                },
                // breakpoint from 768 up
                900: {
                    items: 5,
                }
            }

        });

    });
</script>

<script>
    function convert(a) {
        return ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"][a];
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.side').persiaNumber();
        $('.pay-salle-mini').persiaNumber();
        $('.rt-14').persiaNumber();
        $('.rt-21').persiaNumber();
        $('.rt').persiaNumber();
        $('.woocommerce-Price-amount').persiaNumber();
        $('.screenshot-preview').persiaNumber();
        $('.wr-item').persiaNumber();

    });


    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                console.log('ServiceWorker registration :', registration.scope);
            }).catch(function(error) {
                console.log('ServiceWorker registration failed:', errror);
            });
        });
    }

    var menu_bar = document.querySelector('.sc-bottom-bar');
    var menu_item = document.querySelectorAll('.sc-menu-item');
    var menu_indicator = document.querySelector('.sc-nav-indicator');
    var menu_current_item = document.querySelector('.sc-current');
    var menu_position;

    menu_position = menu_current_item.offsetLeft - 16;
    menu_indicator.style.left = menu_position + "px";
    menu_bar.style.backgroundPosition = menu_position - 8 + 'px';
    menu_item.forEach(
        function(select_menu_item) {
            select_menu_item.addEventListener('click', function(e) {
                e.preventDefault();
                menu_position = this.offsetLeft - 16;
                menu_indicator.style.left = menu_position + "px";
                menu_bar.style.backgroundPosition = menu_position - 8 + 'px';
                [...select_menu_item.parentElement.children].forEach(
                    sibling => {
                        sibling.classList.remove('sc-current');
                    })
                select_menu_item.classList.add('sc-current');
            });
        }
    );






    $("a[href='#top']").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });


    function reloadCaptcha() {
        console.log('asdasd');
        $.ajax({
            type: 'POST',
            url: '/reloadCaptch',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data) {
                $(".captcha span").html(data.captcha);
            },
            error: function(data) {
                console.log(data.responseJSON.message);
            }
        });
    }









    function Sendticket() {



        var username = $('.ticketUsername').val();
        var ticketUsername_guest = $('.ticketUsername_guest').val();
        var ticketSubject = $('.ticketSubject').val();
        var ticketEmail = $('.ticketEmail').val();
        var ticketText = $('.ticketText').val();
        var Tnumber = $('#Tnumber').val();
        var Tnumber2 = $('#Tnumber2').val();

        var captcha = $('#captchainput').val();


        console.log(captcha);


        if (ticketEmail == "" || ticketSubject == "" || ticketText == "" || captcha == "") {
            $('#ticketError').css('display', 'block');
            $('#ticketErrorText').text('لطفا تمامی فیلد ها را به درستی پر کنید ...');
            console.log('all null');

        } else {

            if (!validateEmail(ticketEmail)) {
                $('#ticketError').css('display', 'block');

                $('#ticketErrorText').text('مقدار ایمیل به درستی وارد نشده است')
            } else {

                formData = {
                    number: Tnumber ? Tnumber : Tnumber2,
                    username: username ? username : ticketUsername_guest,
                    subject: ticketSubject,
                    ticketEmail: ticketEmail,
                    ticketText: ticketText,
                    captcha: captcha,
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
                        $('#ticketSuccesss').css('display', 'block');

                    },
                    error: function(data) {

                        if (data.responseJSON.message == "validation.captcha") {
                            $('#ticketError').css('display', 'block');

                            $('#ticketErrorText').text('مقدار فرم اعتبار سنجی به درستی وارد نشده است')

                        } else {
                            console.log(data);
                        }


                    }

                });

            }
        }


    }

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    $(window).on('load', function() { // makes sure the whole site is loaded
        $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({
            'overflow': 'visible'
        });
    });

    // js code to make draggable nav
    function onDrag({
        movementY
    }) { //movementY gets mouse vertical value
        const navStyle = window.getComputedStyle(nav), //getting all css style of nav
            navTop = parseInt(navStyle.top), // getting nav top value & convert it into string
            navHeight = parseInt(navStyle.height), // getting nav height value & convert it into string
            windHeight = window.innerHeight; // getting window height

        nav.style.top = navTop > 0 ? `${navTop + movementY}px` : "1px";
        if (navTop > windHeight - navHeight) {
            nav.style.top = `${windHeight - navHeight}px`;
        }
    }

    //this function will call when user click mouse's button and  move mouse on nav
    nav.addEventListener("mousedown", () => {
        nav.addEventListener("mousemove", onDrag);
    });

    //these function will call when user relase mouse button and leave mouse from nav
    nav.addEventListener("mouseup", () => {
        nav.removeEventListener("mousemove", onDrag);
    });
    nav.addEventListener("mouseleave", () => {
        nav.removeEventListener("mousemove", onDrag);
    });
</script>

<script type="text/javascript" src="{{ url('main/js/owl.carousel.js') }}"></script>
<script type="text/javascript" src="{{ url('main/js/java.js') }}"></script>
<script type="text/javascript" src="{{ url('main/js/parsinumber.min.js') }}"></script>


<script>
    var navBt = document.getElementsByClassName(' link');
</script>
<script src="{{ url('/sw.js') }}"></script>




<script src="sabt2/js/functions.js"></script>

{{-- <script>
    let slider = document.querySelector('.slider');
    let wrapper = document.querySelector('.wrapper');
    let next = document.querySelector('.arrow-next');
    let prev = document.querySelector('.arrow-prev');
    let item = document.querySelectorAll('.item');
    let currdeg = 0;
    let active = 0;

    next.addEventListener('click', () => {
        slider.classList.toggle('zoom');

        currdeg = currdeg - 120;

        if (active === item.length - 1) {
            active = 0;
        } else {
            active++;
        }

        toggle();
    });

    prev.addEventListener('click', () => {
        slider.classList.toggle('zoom');

        currdeg = currdeg + 120;

        if (active === 0) {
            active = item.length - 1;
        } else {
            active--;
        }

        toggle();
    });

    let toggle = () => {
        setTimeout(() => {
            for (let i = 0; i < item.length; i++) {
                item[i].classList.remove('active-3d-slider');
            }

            item[active].classList.add('active-3d-slider')
            wrapper.style.transform = 'rotateY(' + currdeg + 'deg)';
        }, 900);

        setTimeout(() => {
            slider.classList.toggle('zoom');
        }, 1900);
    }
</script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script>
    setInterval(() => {
        var nextActiveSlide = $(".slide.active").next();

        if ($(this).hasClass("arrow-left")) {
            nextActiveSlide = $(".slide.active").prev();
        }

        if (nextActiveSlide.length > 0) {


            var nextActiveIndex = nextActiveSlide.index();
            $(".dots span").removeClass("active");
            $($(".dots").children()[nextActiveIndex]).addClass("active");

            updateSlides(nextActiveSlide);
        } else {
            console.log('no');
            if ($(this).hasClass("arrow-left")) {



                nextActiveSlide = $(".slider").children().last();

                var nextActiveIndex = nextActiveSlide.index();
                $(".dots span").removeClass("active");
                $($(".dots").children()[nextActiveIndex]).addClass("active");

                updateSlides(nextActiveSlide);

            } else {

                nextActiveSlide = $(".slider").children().first();

                var nextActiveIndex = nextActiveSlide.index();

                $(".dots span").removeClass("active");
                $($(".dots").children()[nextActiveIndex]).addClass("active");


                updateSlides(nextActiveSlide);

            }
        }


    }, "3000");


    var updateSlides = function(nextActiveSlide) {

        // console.log(nextActiveSlide);
        var nextActiveSlideIndex = $(nextActiveSlide).index();

        $(".slide").removeClass("prev-1");
        $(".slide").removeClass("next-1");
        $(".slide").removeClass("active");
        $(".slide").removeClass("prev-2");
        $(".slide").removeClass("next-2");

        nextActiveSlide.addClass("active");

        nextActiveSlide.prev().addClass("prev-1");
        nextActiveSlide.prev().prev().addClass("prev-2");
        nextActiveSlide.addClass("active");
        nextActiveSlide.next().addClass("next-1");
        nextActiveSlide.next().next().addClass("next-2");
    }

    var Slider = (function() {
        var initSlider = function() {
            var dir = $("html").attr("dir");
            var swipeHandler = new Hammer(document.getElementById("slider"));
            swipeHandler.on('swipeleft', function(e) {
                if (dir == "ltr")
                    $(".arrow-left").trigger("click");
                else
                    $(".arrow-right").trigger("click");
            });

            swipeHandler.on('swiperight', function(e) {

                if (dir == "ltr")
                    $(".arrow-right").trigger("click");
                else
                    $(".arrow-left").trigger("click");
            });

            $(".arrow-right , .arrow-left").click(function(event) {
                var nextActiveSlide = $(".slide.active").next();

                if ($(this).hasClass("arrow-left")) {
                    nextActiveSlide = $(".slide.active").prev();
                }

                if (nextActiveSlide.length > 0) {


                    var nextActiveIndex = nextActiveSlide.index();
                    $(".dots span").removeClass("active");
                    $($(".dots").children()[nextActiveIndex]).addClass("active");

                    updateSlides(nextActiveSlide);
                } else {
                    console.log('no');
                    if ($(this).hasClass("arrow-left")) {



                        nextActiveSlide = $(".slider").children().last();

                        var nextActiveIndex = nextActiveSlide.index();
                        $(".dots span").removeClass("active");
                        $($(".dots").children()[nextActiveIndex]).addClass("active");

                        updateSlides(nextActiveSlide);

                    } else {

                        nextActiveSlide = $(".slider").children().first();

                        var nextActiveIndex = nextActiveSlide.index();

                        $(".dots span").removeClass("active");
                        $($(".dots").children()[nextActiveIndex]).addClass("active");


                        updateSlides(nextActiveSlide);

                    }
                }

            });

            $(".dots span").click(function(event) {
                var slideIndex = $(this).index();
                var nextActiveSlide = $($(".slider").children()[slideIndex]);
                $(".dots span").removeClass("active");
                $(this).addClass("active");

                updateSlides(nextActiveSlide);
            });

            var updateSlides = function(nextActiveSlide) {

                var nextActiveSlideIndex = $(nextActiveSlide).index();

                $(".slide").removeClass("prev-1");
                $(".slide").removeClass("next-1");
                $(".slide").removeClass("active");
                $(".slide").removeClass("prev-2");
                $(".slide").removeClass("next-2");

                nextActiveSlide.addClass("active");

                nextActiveSlide.prev().addClass("prev-1");
                nextActiveSlide.prev().prev().addClass("prev-2");
                nextActiveSlide.addClass("active");
                nextActiveSlide.next().addClass("next-1");
                nextActiveSlide.next().next().addClass("next-2");
            }

            var updateToNextSlide = function(nextActiveSlide) {

            }
        }
        return {
            init: function() {
                initSlider();
            }
        }
    })();

    $(function() {
        Slider.init();
    });

    if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {

        if (window.navigator.standalone === true) {

        } else {
            // console.log('add to home screen !!!');
        }
    } else {

    }
</script>
<script>
    $(document).ready(function() {
        $(".category-carousel").owlCarousel({
            margin: 2,
            items: 2,
            loop: true,
            dots: false,
            rtl: true,
            autoplay: true,
            autoplayTimeout: 3000,


        });
    });
</script>


{{-- {rtl:!0,dots:!1,nav:!1,autoplay:!0,autoplayHoverPause:!0,margin:10,autoWidth:!0,responsive:{1200:{items:5},920:{items:4},710:{items:3},0:{items:2} --}}





<script>
    setInterval(() => {
        var nextActiveSlideVendor = $(".vendor-slide.vendor-active").next();

        if ($(this).hasClass("vendor-arrow-left")) {
            nextActiveSlideVendor = $(".vendor-slide.vendor-active").prev();
        }

        if (nextActiveSlideVendor.length > 0) {


            var nextActiveIndexVendor = nextActiveSlideVendor.index();
            $(".vendor-dots span").removeClass("vendor-active");
            $($(".vendor-dots").children()[nextActiveIndexVendor]).addClass("vendor-active");

            updateSlidesVendor(nextActiveSlideVendor);
        } else {
            console.log('no');
            if ($(this).hasClass("vendor-arrow-left")) {



                nextActiveSlideVendor = $(".vendor-slider").children().last();

                var nextActiveIndexVendor = nextActiveSlideVendor.index();
                $(".vendor-dots span").removeClass("vendor-active");
                $($(".vendor-dots").children()[nextActiveIndexVendor]).addClass("vendor-active");

                updateSlidesVendor(nextActiveSlideVendor);

            } else {

                nextActiveSlideVendor = $(".vendor-slider").children().first();

                var nextActiveIndexVendor = nextActiveSlideVendor.index();

                $(".vendor-dots span").removeClass("vendor-active");
                $($(".vendor-dots").children()[nextActiveIndexVendor]).addClass("vendor-active");


                updateSlidesVendor(nextActiveSlideVendor);

            }
        }


    }, "4000");


    var updateSlidesVendor = function(nextActiveSlideVendor) {

        // console.log(nextActiveSlideVendor);
        var nextActiveSlideVendorIndex = $(nextActiveSlideVendor).index();

        $(".vendor-slide").removeClass("vendor-prev-1");
        $(".vendor-slide").removeClass("vendor-next-1");
        $(".vendor-slide").removeClass("vendor-active");
        $(".vendor-slide").removeClass("vendor-prev-2");
        $(".vendor-slide").removeClass("vendor-next-2");

        nextActiveSlideVendor.addClass("vendor-active");

        nextActiveSlideVendor.prev().addClass("vendor-prev-1");
        nextActiveSlideVendor.prev().prev().addClass("vendor-prev-2");
        nextActiveSlideVendor.addClass("vendor-active");
        nextActiveSlideVendor.next().addClass("vendor-next-1");
        nextActiveSlideVendor.next().next().addClass("vendor-next-2");
    }

    var vendorSlider = (function() {
        var initSliderVendor = function() {
            var dir = $("html").attr("dir");
            var swipeHandlerVendor = new Hammer(document.getElementById("vendor-slider"));
            swipeHandlerVendor.on('swipeleft', function(e) {
                if (dir == "ltr")
                    $(".vendor-arrow-left").trigger("click");
                else
                    $(".vendor-arrow-right").trigger("click");
            });

            swipeHandlerVendor.on('swiperight', function(e) {

                if (dir == "ltr")
                    $(".vendor-arrow-right").trigger("click");
                else
                    $(".vendor-arrow-left").trigger("click");
            });

            $(".vendor-arrow-right , .vendor-arrow-left").click(function(event) {
                var nextActiveSlideVendor = $(".vendor-slide.vendor-active").next();

                if ($(this).hasClass("vendor-arrow-left")) {
                    nextActiveSlideVendor = $(".vendor-slide.vendor-active").prev();
                }

                if (nextActiveSlideVendor.length > 0) {


                    var nextActiveIndexVendor = nextActiveSlideVendor.index();
                    $(".vendor-dots span").removeClass("vendor-active");
                    $($(".vendor-dots").children()[nextActiveIndexVendor]).addClass(
                        "vendor-active");

                    updateSlidesVendor(nextActiveSlideVendor);
                } else {
                    console.log('no');
                    if ($(this).hasClass("vendor-arrow-left")) {



                        nextActiveSlideVendor = $(".vendor-slider").children().last();

                        var nextActiveIndexVendor = nextActiveSlideVendor.index();
                        $(".vendor-dots span").removeClass("vendor-active");
                        $($(".vendor-dots").children()[nextActiveIndexVendor]).addClass(
                            "vendor-active");

                        updateSlidesVendor(nextActiveSlideVendor);

                    } else {

                        nextActiveSlideVendor = $(".vendor-slider").children().first();

                        var nextActiveIndexVendor = nextActiveSlideVendor.index();

                        $(".vendor-dots span").removeClass("vendor-active");
                        $($(".vendor-dots").children()[nextActiveIndexVendor]).addClass(
                            "vendor-active");


                        updateSlidesVendor(nextActiveSlideVendor);

                    }
                }

            });

            $(".vendor-dots span").click(function(event) {
                var slideIndexVendor = $(this).index();
                var nextActiveSlideVendor = $($(".vendor-slider").children()[slideIndexVendor]);
                $(".vendor-dots span").removeClass("vendor-active");
                $(this).addClass("vendor-active");

                updateSlidesVendor(nextActiveSlideVendor);
            });

            var updateSlidesVendor = function(nextActiveSlideVendor) {

                var nextActiveSlideVendorIndex = $(nextActiveSlideVendor).index();

                $(".vendor-slide").removeClass("vendor-prev-1");
                $(".vendor-slide").removeClass("vendor-next-1");
                $(".vendor-slide").removeClass("vendor-active");
                $(".vendor-slide").removeClass("vendor-prev-2");
                $(".vendor-slide").removeClass("vendor-next-2");

                nextActiveSlideVendor.addClass("vendor-active");

                nextActiveSlideVendor.prev().addClass("vendor-prev-1");
                nextActiveSlideVendor.prev().prev().addClass("vendor-prev-2");
                nextActiveSlideVendor.addClass("vendor-active");
                nextActiveSlideVendor.next().addClass("vendor-next-1");
                nextActiveSlideVendor.next().next().addClass("vendor-next-2");
            }

            var updateToNextSlide = function(nextActiveSlideVendor) {

            }
        }
        return {
            init: function() {
                initSliderVendor();
            }
        }
    })();

    $(function() {
        vendorSlider.init();
    });
</script>

{{-- mahboob vendors tab --}}
<script>
    setInterval(() => {
        var nextActiveSlideMahboob = $(".mahboob-slide.mahboob-active").next();

        if ($(this).hasClass("mahboob-arrow-left")) {
            nextActiveSlideMahboob = $(".mahboob-slide.mahboob-active").prev();
        }

        if (nextActiveSlideMahboob.length > 0) {


            var nextActiveIndexMahboob = nextActiveSlideMahboob.index();
            $(".mahboob-dots span").removeClass("mahboob-active");
            $($(".mahboob-dots").children()[nextActiveIndexMahboob]).addClass("mahboob-active");

            updateSlidesMahboob(nextActiveSlideMahboob);
        } else {
            console.log('no');
            if ($(this).hasClass("mahboob-arrow-left")) {



                nextActiveSlideMahboob = $(".mahboob-slider").children().last();

                var nextActiveIndexMahboob = nextActiveSlideMahboob.index();
                $(".mahboob-dots span").removeClass("mahboob-active");
                $($(".mahboob-dots").children()[nextActiveIndexMahboob]).addClass("mahboob-active");

                updateSlidesMahboob(nextActiveSlideMahboob);

            } else {

                nextActiveSlideMahboob = $(".mahboob-slider").children().first();

                var nextActiveIndexMahboob = nextActiveSlideMahboob.index();

                $(".mahboob-dots span").removeClass("mahboob-active");
                $($(".mahboob-dots").children()[nextActiveIndexMahboob]).addClass("mahboob-active");


                updateSlidesMahboob(nextActiveSlideMahboob);

            }
        }


    }, "4000");


    var updateSlidesMahboob = function(nextActiveSlideMahboob) {

        // console.log(nextActiveSlideMahboob);
        var nextActiveSlideMahboobIndex = $(nextActiveSlideMahboob).index();

        $(".mahboob-slide").removeClass("mahboob-prev-1");
        $(".mahboob-slide").removeClass("mahboob-next-1");
        $(".mahboob-slide").removeClass("mahboob-active");
        $(".mahboob-slide").removeClass("mahboob-prev-2");
        $(".mahboob-slide").removeClass("mahboob-next-2");

        nextActiveSlideMahboob.addClass("mahboob-active");

        nextActiveSlideMahboob.prev().addClass("mahboob-prev-1");
        nextActiveSlideMahboob.prev().prev().addClass("mahboob-prev-2");
        nextActiveSlideMahboob.addClass("mahboob-active");
        nextActiveSlideMahboob.next().addClass("mahboob-next-1");
        nextActiveSlideMahboob.next().next().addClass("mahboob-next-2");
    }

    var mahboobSlider = (function() {
        var initSliderMahboob = function() {
            var dir = $("html").attr("dir");
            var swipeHandlerMahboob = new Hammer(document.getElementById("mahboob-slider"));
            swipeHandlerMahboob.on('swipeleft', function(e) {
                if (dir == "ltr")
                    $(".mahboob-arrow-left").trigger("click");
                else
                    $(".mahboob-arrow-right").trigger("click");
            });

            swipeHandlerMahboob.on('swiperight', function(e) {

                if (dir == "ltr")
                    $(".mahboob-arrow-right").trigger("click");
                else
                    $(".mahboob-arrow-left").trigger("click");
            });

            $(".mahboob-arrow-right , .mahboob-arrow-left").click(function(event) {
                var nextActiveSlideMahboob = $(".mahboob-slide.mahboob-active").next();

                if ($(this).hasClass("mahboob-arrow-left")) {
                    nextActiveSlideMahboob = $(".mahboob-slide.mahboob-active").prev();
                }

                if (nextActiveSlideMahboob.length > 0) {


                    var nextActiveIndexMahboob = nextActiveSlideMahboob.index();
                    $(".mahboob-dots span").removeClass("mahboob-active");
                    $($(".mahboob-dots").children()[nextActiveIndexMahboob]).addClass(
                        "mahboob-active");

                    updateSlidesMahboob(nextActiveSlideMahboob);
                } else {
                    console.log('no');
                    if ($(this).hasClass("mahboob-arrow-left")) {



                        nextActiveSlideMahboob = $(".mahboob-slider").children().last();

                        var nextActiveIndexMahboob = nextActiveSlideMahboob.index();
                        $(".mahboob-dots span").removeClass("mahboob-active");
                        $($(".mahboob-dots").children()[nextActiveIndexMahboob]).addClass(
                            "mahboob-active");

                        updateSlidesMahboob(nextActiveSlideMahboob);

                    } else {

                        nextActiveSlideMahboob = $(".mahboob-slider").children().first();

                        var nextActiveIndexMahboob = nextActiveSlideMahboob.index();

                        $(".mahboob-dots span").removeClass("mahboob-active");
                        $($(".mahboob-dots").children()[nextActiveIndexMahboob]).addClass(
                            "mahboob-active");


                        updateSlidesMahboob(nextActiveSlideMahboob);

                    }
                }

            });

            $(".mahboob-dots span").click(function(event) {
                var slideIndexMahboob = $(this).index();
                var nextActiveSlideMahboob = $($(".mahboob-slider").children()[slideIndexMahboob]);
                $(".mahboob-dots span").removeClass("mahboob-active");
                $(this).addClass("mahboob-active");

                updateSlidesMahboob(nextActiveSlideMahboob);
            });

            var updateSlidesMahboob = function(nextActiveSlideMahboob) {

                var nextActiveSlideMahboobIndex = $(nextActiveSlideMahboob).index();

                $(".mahboob-slide").removeClass("mahboob-prev-1");
                $(".mahboob-slide").removeClass("mahboob-next-1");
                $(".mahboob-slide").removeClass("mahboob-active");
                $(".mahboob-slide").removeClass("mahboob-prev-2");
                $(".mahboob-slide").removeClass("mahboob-next-2");

                nextActiveSlideMahboob.addClass("mahboob-active");

                nextActiveSlideMahboob.prev().addClass("mahboob-prev-1");
                nextActiveSlideMahboob.prev().prev().addClass("mahboob-prev-2");
                nextActiveSlideMahboob.addClass("mahboob-active");
                nextActiveSlideMahboob.next().addClass("mahboob-next-1");
                nextActiveSlideMahboob.next().next().addClass("mahboob-next-2");
            }

            var updateToNextSlide = function(nextActiveSlideMahboob) {

            }
        }
        return {
            init: function() {
                initSliderMahboob();
            }
        }
    })();

    $(function() {
        mahboobSlider.init();
    });
</script>

{{-- pormahsol vendors tab 
     --}}

<script>
    setInterval(() => {
        var nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").next();

        if ($(this).hasClass("mostproduct-arrow-left")) {
            nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").prev();
        }

        if (nextActiveSlideMostproduct.length > 0) {


            var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
            $(".mostproduct-dots span").removeClass("mostproduct-active");
            $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass("mostproduct-active");

            updateSlidesMostproduct(nextActiveSlideMostproduct);
        } else {
            console.log('no');
            if ($(this).hasClass("mostproduct-arrow-left")) {



                nextActiveSlideMostproduct = $(".mostproduct-slider").children().last();

                var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
                $(".mostproduct-dots span").removeClass("mostproduct-active");
                $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass("mostproduct-active");

                updateSlidesMostproduct(nextActiveSlideMostproduct);

            } else {

                nextActiveSlideMostproduct = $(".mostproduct-slider").children().first();

                var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();

                $(".mostproduct-dots span").removeClass("mostproduct-active");
                $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass("mostproduct-active");


                updateSlidesMostproduct(nextActiveSlideMostproduct);

            }
        }


    }, "4000");


    var updateSlidesMostproduct = function(nextActiveSlideMostproduct) {

        // console.log(nextActiveSlideMostproduct);
        var nextActiveSlideMostproductIndex = $(nextActiveSlideMostproduct).index();

        $(".mostproduct-slide").removeClass("mostproduct-prev-1");
        $(".mostproduct-slide").removeClass("mostproduct-next-1");
        $(".mostproduct-slide").removeClass("mostproduct-active");
        $(".mostproduct-slide").removeClass("mostproduct-prev-2");
        $(".mostproduct-slide").removeClass("mostproduct-next-2");

        nextActiveSlideMostproduct.addClass("mostproduct-active");

        nextActiveSlideMostproduct.prev().addClass("mostproduct-prev-1");
        nextActiveSlideMostproduct.prev().prev().addClass("mostproduct-prev-2");
        nextActiveSlideMostproduct.addClass("mostproduct-active");
        nextActiveSlideMostproduct.next().addClass("mostproduct-next-1");
        nextActiveSlideMostproduct.next().next().addClass("mostproduct-next-2");
    }

    var mostproductSlider = (function() {
        var initSliderMostproduct = function() {
            var dir = $("html").attr("dir");
            var swipeHandlerMostproduct = new Hammer(document.getElementById("mostproduct-slider"));
            swipeHandlerMostproduct.on('swipeleft', function(e) {
                if (dir == "ltr")
                    $(".mostproduct-arrow-left").trigger("click");
                else
                    $(".mostproduct-arrow-right").trigger("click");
            });

            swipeHandlerMostproduct.on('swiperight', function(e) {

                if (dir == "ltr")
                    $(".mostproduct-arrow-right").trigger("click");
                else
                    $(".mostproduct-arrow-left").trigger("click");
            });

            $(".mostproduct-arrow-right , .mostproduct-arrow-left").click(function(event) {
                var nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").next();

                if ($(this).hasClass("mostproduct-arrow-left")) {
                    nextActiveSlideMostproduct = $(".mostproduct-slide.mostproduct-active").prev();
                }

                if (nextActiveSlideMostproduct.length > 0) {


                    var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
                    $(".mostproduct-dots span").removeClass("mostproduct-active");
                    $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass(
                        "mostproduct-active");

                    updateSlidesMostproduct(nextActiveSlideMostproduct);
                } else {
                    console.log('no');
                    if ($(this).hasClass("mostproduct-arrow-left")) {



                        nextActiveSlideMostproduct = $(".mostproduct-slider").children().last();

                        var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();
                        $(".mostproduct-dots span").removeClass("mostproduct-active");
                        $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass(
                            "mostproduct-active");

                        updateSlidesMostproduct(nextActiveSlideMostproduct);

                    } else {

                        nextActiveSlideMostproduct = $(".mostproduct-slider").children().first();

                        var nextActiveIndexMostproduct = nextActiveSlideMostproduct.index();

                        $(".mostproduct-dots span").removeClass("mostproduct-active");
                        $($(".mostproduct-dots").children()[nextActiveIndexMostproduct]).addClass(
                            "mostproduct-active");


                        updateSlidesMostproduct(nextActiveSlideMostproduct);

                    }
                }

            });

            $(".mostproduct-dots span").click(function(event) {
                var slideIndexMostproduct = $(this).index();
                var nextActiveSlideMostproduct = $($(".mostproduct-slider").children()[
                    slideIndexMostproduct]);
                $(".mostproduct-dots span").removeClass("mostproduct-active");
                $(this).addClass("mostproduct-active");

                updateSlidesMostproduct(nextActiveSlideMostproduct);
            });

            var updateSlidesMostproduct = function(nextActiveSlideMostproduct) {

                var nextActiveSlideMostproductIndex = $(nextActiveSlideMostproduct).index();

                $(".mostproduct-slide").removeClass("mostproduct-prev-1");
                $(".mostproduct-slide").removeClass("mostproduct-next-1");
                $(".mostproduct-slide").removeClass("mostproduct-active");
                $(".mostproduct-slide").removeClass("mostproduct-prev-2");
                $(".mostproduct-slide").removeClass("mostproduct-next-2");

                nextActiveSlideMostproduct.addClass("mostproduct-active");

                nextActiveSlideMostproduct.prev().addClass("mostproduct-prev-1");
                nextActiveSlideMostproduct.prev().prev().addClass("mostproduct-prev-2");
                nextActiveSlideMostproduct.addClass("mostproduct-active");
                nextActiveSlideMostproduct.next().addClass("mostproduct-next-1");
                nextActiveSlideMostproduct.next().next().addClass("mostproduct-next-2");
            }

            var updateToNextSlide = function(nextActiveSlideMostproduct) {

            }
        }
        return {
            init: function() {
                initSliderMostproduct();
            }
        }
    })();

    $(function() {
        mostproductSlider.init();
    });
</script>
