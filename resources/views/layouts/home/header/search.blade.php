<div id="searchareaa"
    class="d-flex flex-column align-content-center col-md-8 pt-2 justify-content-center align-items-center">


    <form class="col-12" action="{{ route('search') }}" id="SearcForm" method="get">
        <small id="SearchErr" style="display: none;" class="text-danger animate__fadeIn">لطفا دسته مورد نظر را
            انتخاب کنید</small>

        <div class="btn-group  col-md-8" style="  margin-right: 5%; " role="group"
            aria-label="Basic radio toggle button group">
            <input type="radio" onchange="searchBy(3)" class="btn-check  redioo" name="btnradioSearch" value="product"
                id="ProductSearch" autocomplete="off" <?php if (isset($search_in) && $search_in == 'product') {
                    echo 'checked';
                } ?> checked>

            <label style="padding: 7px 35px;" onclick="searchBy(3)"
                @if (isset($search_in) && $search_in == 'product') style=" background-color:#ffff;   border:3px solid #a3a0a0 !important; border-bottom : 5px solid white !important;  color:black !important @endif "
                class="col-3   text-center rounded-0 rounded-top btlabel  " id="product_label" for="ProductSearch">
                محصولات
            </label>
        



            <input onchange="searchBy(1)" type="radio" class="btn-check redioo" name="btnradioSearch" value="brand"
                id="BrandSerach" autocomplete="off" <?php if (isset($search_in) && $search_in == 'brand') {
                    echo 'checked';
                } ?>>

            <label onclick="searchBy(1)"
                style=" --bs-btn-border-color: #ced4da;--bs-btn-color: #2c2c2c; padding: 7px ;
                @if (isset($search_in) && $search_in == 'brand') background-color:#ffff;  border:3px solid #025e2b !important;z-index:999; border-bottom : 5px solid white !important; border-radius: 0px !important;   color:black !important @endif "
                id="brnad_label" class="col-3   rounded-0 rounded-top btlabel " for="BrandSerach">
                برند
            </label>





            <input type="radio" onchange="searchBy(2)" class="btn-check redioo" name="btnradioSearch" value="vendor"
                id="VendorSearch" autocomplete="off" @if (isset($search_in) && $search_in == 'vendor') checked @endif>

            <label onclick="searchBy(2)"
                style="--bs-btn-border-color: #ced4da;--bs-btn-color: #2c2c2c ;padding : 7px 35px;
                
                
                @if (isset($search_in) && $search_in == 'vendor') background-color:#ffff;  border:3px solid #3c5cfa !important;  border-bottom : 5px solid white !important; color:black !important @endif 
                "
                id="vendor_label" class=" col-3  rounded-0 rounded-top btlabel " for="VendorSearch">
                فروشگاه
            </label>




           


        </div>
        <div style="


        @if (isset($search_in) && $search_in == 'brand') border:3px solid #025e2b !important;  
        
        @elseif(isset($search_in) && $search_in == 'product')
        border:3px solid #a3a0a0 !important;  
        @elseif(isset($search_in) && $search_in == 'vendor')
        
        border:3px solid #3c5cfa !important; @endif
     
        "
            id="searchInputtDiv" class="input-group input-group-lg flex-row-reverse">


            <button
                @if (isset($search_in)) style="border-radius: 0px !important;   border:none; border-right: 1px solid black " @endif
                class="btn btn-primary" type="submit" id="button-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d=" M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0
                1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>

            </button>
            <input type="text" onkeydown="inputSearch()" name="searchInput" id="searchInput"
                style="autocomplete='off'; border-top-right-radius: 0px;  @if (isset($search_in)) border:none !important; @endif  "
                value="  <?php if (isset($search_input)) {
                    echo $search_input;
                } ?>" class="form-control border-dark fontAwsem"
                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                placeholder=" نام محصول مورد نظر را بنویسید ...">



        </div>

    </form>


</div>
