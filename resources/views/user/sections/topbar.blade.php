<nav class="navbar navbar-expand navbar-light  bg-white topbar mb-1  shadow justify-content-evenly"
    style="">
    <div class="row ">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle">
            <i class="fa fa-bars" style="margin-top: 4px;"></i>
        </button>

        
        
        <?php $products = Auth::user()->vendor->products; ?>

        

        <!-- Topbar Navbar -->


    </div>
    <ul class="navbar-nav  mr-auto col-12 " style="justify-content: end;">



        <?php
        
        $massages = Auth::user()->vendor->AdminMassages;
        
        $unread_massages = $massages->where('seen_at', null);
        
        $count_of_unread_messages = count($unread_massages);
        
        ?>


        {{-- @dd($unread_massages); --}}

        <!-- Nav Item - Messages -->
        {{-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                    class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path
                        d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                </svg> <!-- Counter - Messages -->




            </a>



            <!-- Dropdown - Messages -->
            <div style="overflow-y: scroll; height:500px;"
                class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in text-right"
                aria-labelledby="messagesDropdown">



                <h6 class="dropdown-header">
                    تیکت ها
                </h6>

                <a href="{{ route('user.tickets.userIndex') }}">مشاهده همه تیکت ها</a>

                


            </div>
        </li> --}}


        <!-- Nav Item - Alerts -->


        <li class="nav-item dropdown no-arrow mx-1 ">



            @php

                $comments = \App\Models\Admin\ProductComments::where('vendor_id', Auth::user()->vendor->id)
                    ->where('is_active', 1)
                    ->whereNull('seenOrNot')
                    ->latest()
                    ->get();

            @endphp




            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                    class="bi bi-chat-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z" />
                </svg> <!-- Counter - Alerts -->
                @if ($count_of_unread_messages != 0)
                    <span class="badge badge-danger badge-counter">{{ $count_of_unread_messages }}</span>
                @endif

            </a>
            {{-- @dd($unread_massages) --}}
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in text-right"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    مشاهده پیام های جدید
                </h6>
                <a class="dropdown-item text-center small text-500" href="{{ route('user.inbox') }}"> مشاهده تمام
                    پیام ها </a>

                @foreach ($unread_massages as $massage)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('user.inbox') }}">
                        <div class="col-10">
                            <div style="color: rgb(7, 7, 7)" class="small text-500">

                                {{ $massage->subject }}
                                -
                                {{ \Morilog\Jalali\Jalalian::forge($massage->created_at) }}

                            </div>

                            <span style="color: rgb(80, 78, 78)" class="font-weight-bold">
                                {{ $massage->message }}
                            </span>
                        </div>

                        <div class="col-2">
                            <div class="icon-circle">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z" />
                                </svg>
                            </div>
                        </div>

                    </a>
                @endforeach


            </div>
        </li>




        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="ml-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('/images/admin/user.png') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in text-right"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('user.me') }}">
                    <i class="fas fa-user fa-sm fa-fw ml-2 text-gray-400"></i>
                    اطلاعات حساب گاربری
                </a>
                {{-- <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw ml-2 text-gray-400"></i>
            تنظیمات
              </a> --}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw ml-2 text-gray-400"></i>
                    خروج
                </a>
            </div>
        </li>



    </ul>

        @if( checkIfHasActiveSpcVendor(Auth::user()->vendor->id))
        <img
        
        style="width:40px; height:40px;"
        
        src="{{ asset('images/pngtree-vip-icon-for-game-golden-crown-with-red-jewel-png-image_3603951.jpg') }}" alt="">
        @endif











</nav>
<div class="text-center  ">
    <div class="dashboard-button-style  ">



        <div class=" d-md-block">

            @if (Auth::user()->vendor->status == 'no')

                <div class="alert alert-danger ">


                    <a href="{{ route('user.vendor.images.edit', ['vendor' => Auth::user()->vendor->name]) }}">
                        خوش آمدید ، لطفا ابتدا اطلاعات خود را تکمیل کنید
                    </a>

                </div>
            @else
                @if (Auth::user()->vendor->status == 'yes')
                    <div class="alert alert-success mb-1">
                        وضعیت فروشگاه : فعال
                    </div>
                @else
                    @if (!is_null(Auth::user()->vendor->EditReportText))
                    <div class="alert alert-danger your-store-dashbord">
                    
                    {!!  json_decode(Auth::user()->vendor->EditReportText  , true)["message"] !!}
                    </div>
                    @else
                        <div class="alert alert-danger your-store-dashbord">
                            فروشگاه شما در صف تایید کارشناسان می باشد
                        </div>
                    @endif
                @endif


            @endif




        </div>



        @if (Route::is('user.products.index') || Route::is('user.upgrade'))
            <!-- Topbar Search -->
            {{-- <form class="d-none d-sm-inline-block form-inline ml-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">



            <input type="text" name="search" class="form-control bg-light border-0 small order-2"
                aria-label="Search"
                @if (Request()->has('search')) value="{{ Request('search') }}"

            @else

            placeholder="جستجو ..." @endif
                aria-describedby="basic-addon2">


            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>

        </div>


        @if (Request()->has('search'))
            @if (Route::is('user.products.index'))
                <a href="{{ route('user.products.index') }}" class="btn btn-danger">همه محصولات</a>
            @elseif(Route::is('user.upgrade'))
                <a href="{{ route('user.upgrade') }}" class="btn btn-danger">همه محصولات</a>
            @endif

        @endif



    </form> --}}
        @endif
    </div>
    <div class=" d-sm-block ">
        @if (\App\Models\Admin\SiteSetting::first()->paymentStatus)
            <div
                @if (Auth::user()->CREDIT < 10000) class="alert alert-warning d-flex justify-content-between align-items-center p-2"
    
     @else
     class="alert alert-info d-flex justify-content-between " @endif>

                موجودی : {{ Auth::user()->CREDIT }} تومان


                <a class="btn btn-success " href="{{ route('user.orders.index') }}"> افزایش +</a>


            </div>
        @endif
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">

                <h2>میخواهید خارج شوید ؟</h2>


            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{ route('logout') }}" style="color: white;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                    بله

                </a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal"> خیر </button>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</div>
