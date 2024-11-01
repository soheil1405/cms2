{{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> --}}

<style>
    .link {


        height: 40px;

    }

    .link a {
        width: 100%;
        height: 100%;
    }

    .link h5 {
        width: 100%;
        height: 100%;
    }
</style>


<div class="category  instarang instarang1  my-1 ">

    <section>
        <input id="menu-toggle" type="checkbox" />
        <label class='menu-button-container me-3' for="menu-toggle">
            <div class='menu-button'></div>
        </label>

        <ul style="display:felx; justify-content:space-around;" class="p-1 rt-category m-0 menu " id="category-side1">
            <li style="padding:0px;" class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'home') {
                echo 'aactive';
            } ?>" onclick="aactive()"><a href="{{ url('/') }}"
                    class="right name navclass">
                    <h5 style="text-align:center;"> صفحه اصلی </h5>
                </a>
            <li style="padding:0px;" class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'Allproducts') {
                echo 'aactive';
            } ?> " onclick="aactive()"><a
                    href="{{ route('products.index') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;"> محصولات </h5>
                    </strong></a>
            <li style="padding:0px;" class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'Vendors') {
                echo 'aactive';
            } ?>" onclick="aactive()">
                <a href="{{ route('Vendors.list') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;">فروشگاه ها </h5>
                    </strong></a>
            <li style="padding:0px;"class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'AllBrands') {
                echo 'aactive';
            } ?>" onclick="aactive()"><a
                    href="{{ route('brands.homeIndex') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;"> برندها </h5>
                    </strong></a>
            <li style="padding:0px;"class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'favorite') {
                echo 'aactive';
            } ?>" onclick="aactive()"><a
                    href="{{ route('favorite.index') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;"> علاقه مندی ها </h5>
                    </strong></a>
            <li style="padding:0px;"class="link" onclick="aactive()"><a href="https://instabargh.com/#bloggg"
                    class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;"> مجله اینستابرق </h5>
                    </strong></a>
                {{-- <li style="padding:0px;"class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'questions') {
                    echo 'aactive';
                } ?>" onclick="aactive()"><a
                    href="{{ route('home.questions') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;">سوالات متداول </h5>
                    </strong></a>
            <li style="padding:0px;"class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'laws') {
                echo 'aactive';
            } ?>" onclick="aactive()"><a
                    href="{{ route('home.laws') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;"> شرایط و قوانین </h5>
                    </strong></a>
            <li style="padding:0px;"class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'aboute_us') {
                echo 'aactive';
            } ?>" onclick="aactive()"><a
                    href="{{ route('home.aboute_us') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center;"> درباره ما</h5>
                    </strong></a> --}}
            <li style="padding:0px;"class="link <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'contact_us') {
                echo 'aactive';
            } ?>" onclick="aactive()"><a
                    href="{{ route('home.contact_us') }}" class="right rt-13 name navclass"><strong>
                        <h5 style="text-align:center; "> تماس باما</h5>
                    </strong></a>
        </ul>
    </section>

</div>
