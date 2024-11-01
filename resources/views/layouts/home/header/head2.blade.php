<nav class="nav-login">

    <div class="d-flex flex-row justify-content-between p-3">
        <div>
            <a href="{{ route('home') }}"><img src="{{ url('main/logo.png') }}" class="logo"></a>
        </div>
        <div class="d-flex flex-column align-content-center justify-content-center align-items-center">

            <form action="{{ route('searchًRoute') }}" method="get">

                <div class="btn-group flex-row-reverse align-self-baseline col-md-12" role="group"
                    aria-label="Basic radio toggle button group">


                    <input type="radio" class="btn-check" name="btnradioSearch" value="brand" id="search-radio-brand"
                        autocomplete="off" checked>

                    <label style="--bs-btn-border-color: #ced4da;--bs-btn-color: #2c2c2c;"
                        class=" col-md-4 border-dark border-bottom-0 btn btn-outline-primary rounded-0  rounded-top-left rounded-top"
                        for="search-radio-brand">
                        برند
                    </label>

                    <input type="radio" class="btn-check" name="btnradioSearch" value="vendor" id="search-radio-store"
                        autocomplete="off">

                    <label style="--bs-btn-border-color: #ced4da;--bs-btn-color: #2c2c2c;"
                        class=" col-md-4 border-dark border-bottom-0 btn btn-outline-primary rounded-0 rounded-top"
                        for="search-radio-store">
                        فروشگاه
                    </label>


                    <input type="radio" class="btn-check" name="btnradioSearch" value="product"
                        id="search-radio-products" autocomplete="off">

                    <label style="--bs-btn-border-color: #ced4da;--bs-btn-color: #2c2c2c;"
                        class=" col-md-4   border-dark border-bottom-0 btn btn-outline-primary rounded-0 rounded-top"
                        for="search-radio-products">
                        محصولات
                    </label>



                </div>
                <div class="input-group input-group-lg flex-row-reverse">



                    <button class="btn btn-outline-primary" type="submit" id="button-addon1">
                        <i class="bi bi-search"></i>
                    </button>
                    <input name="searchInput" type="text" style="border-top-right-radius: 0px;"
                        placeholder="جستجو کنید ..." class="form-control border-dark" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg">



                </div>

            </form>
        </div>
        <div class="p-1 d-flex flex-column align-items-end">
            @guest
                <div>
                    <a href="{{ route('register') }}" class="btn btn-secondary nav-register-link" style="width: 100px;">
                        <i class="fa fa-sign-in"></i>
                        ثبت نام
                    </a>
                </div>

                <div>
                    <a href="{{ route('login') }}" class="btn btn-primary nav-login-link" style="width: 100px;">
                        <i class="fa fa-user-plus"></i>
                        ورود
                    </a>
                </div>
            @endguest

            @auth

                @if (Auth::user()->rols()->where('name', 'admin')->count() == 0)
                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary nav-dashboard-link">
                        <i class="fa fa-user-plus"></i>
                        پنل مدیریت
                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary nav-dashboard-link">
                        <i class="fa fa-user-plus"></i>
                        پنل مدیریت
                    </a>
                @endif

                <a class="btn btn-secondary nav-logout-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    خروج
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            @endauth
        </div>
    </div>

</nav>
<nav class="main">
    <div class="main">
        @include('layouts.home.header.menu')
    </div>
</nav>
@include('layouts.home.header.filteration')

@include('layouts.home.header.mobile-menu')
