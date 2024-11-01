<?php

$vandorStatus = Auth::user()->vendor->status;


$products = Auth::user()->vendor->products;
$productNotifs = 0;

foreach ($products as $product) {
    if($product->status != "yes"){
        $productNotifs ++ ;
    }
    
}

?>














<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0"  id="accordionSidebar">


    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img style="margin:10px auto; width:50px;" src="{{ url('main/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">
            {{ env('APP_NAME') }}
        </div>
    </a>
    {{-- 
    <!-- Sidebar - Brand -->
    <a href="{{ route('home') }}">
        <span style=" margin:auto; color: #ffff">
            INSTABARGH
        </span>
    </a>
     --}}
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> داشبورد </span></a>
    </li>

    @isVerified(Auth::user())
    @else
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('user.verify.index') }}">
                <i class="fas fa-fw fa-check-double"></i>
                <span>
                    تایید حساب کاربری
                </span>
            </a>
        </li>
    @endisVerified
    <!-- Heading -->
    @hasvendor(Auth::user())
        <!-- Divider -->
        <hr class="sidebar-divider">



        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductss"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-store"></i>

                <span> مدیریت فروشگاه



                    <span>
                        @if ($vandorStatus != "yes")
                            <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                                1

                            </small>
                        @endif
                    </span>





                </span>
            </a>
            <div id="collapseProductss" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item"
                        href="{{ route('user.vendor.images.edit', ['vendor' => Auth::user()->vendor->name]) }}">
                        ویرایش اطلاعات </a>
                    <a class="collapse-item" href="{{ route('user.Employees.index') }}">
                        کاربران
                    </a>

                    <a class="collapse-item" href="{{ route('vendor.home', ['vendor' => Auth::user()->vendor->name]) }}">
                        صفحه ی فروشگاه
                    </a>

                </div>
            </div>
        </li>





        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.products.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-seam" viewBox="0 0 16 16">
                    <path
                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                </svg> <span> محصولات

                    <span>
                        @if ($productNotifs > 0)
                            <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                                {{ $productNotifs }}


                            </small>
                        @endif
                    </span>


                </span>
            </a>
        </li>


        @if (userDashboard())
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAds"
                    aria-expanded="true" aria-controls="collapsePages">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-lightning" viewBox="0 0 16 16">
                        <path
                            d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1H6.374z" />
                    </svg>
                    <span> تبلیغات </span>
                </a>
                <div id="collapseAds" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">




                        @if (userDashboard(['usersSendSlider']))
                            <a class="collapse-item" href="{{ route('user.mysliders') }}">ارسال اسلایدر</a>
                        @endif


                        @if (userDashboard(['usersLaddelV', 'usersUpgradeVendor']))
                            <a class="collapse-item" href="{{ route('user.SpecialVendors.index') }}">تبلیغ فروشگاه</a>
                        @endif


                        @if (userDashboard(['usersUpgradeProduct', 'usersLaddelP', 'usersSendStory']))
                            <a class="collapse-item" href="{{ route('user.upgrade') }}">
                               
                            استوری , نردیان , تبلیغ کالا 
                            </a>
                        @endif
                    </div>
                </div>
            </li>
        @endif






        <li class="nav-item">
            <a class="nav-link" href="{{ route('favorite.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                </svg> <span> علاقه مندی ها </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.tickets.userIndex') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                </svg> <span>
                    
        
                    @if (Auth::user()->vendor->Tickets->sum("has_New_Ticket_In_This_Thread_from_admin")  > 0)
                        
                    
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">
                        
                        {{ Auth::user()->vendor->Tickets->sum("has_New_Ticket_In_This_Thread_from_admin")}}
                        
                    </small>
                    
                    @endif

                    تیکت ها </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.comments') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-signal" viewBox="0 0 16 16">
                    <path
                        d="m6.08.234.179.727a7.264 7.264 0 0 0-2.01.832l-.383-.643A7.9 7.9 0 0 1 6.079.234zm3.84 0L9.742.96a7.265 7.265 0 0 1 2.01.832l.388-.643A7.957 7.957 0 0 0 9.92.234zm-8.77 3.63a7.944 7.944 0 0 0-.916 2.215l.727.18a7.264 7.264 0 0 1 .832-2.01l-.643-.386zM.75 8a7.3 7.3 0 0 1 .081-1.086L.091 6.8a8 8 0 0 0 0 2.398l.74-.112A7.262 7.262 0 0 1 .75 8zm11.384 6.848-.384-.64a7.23 7.23 0 0 1-2.007.831l.18.728a7.965 7.965 0 0 0 2.211-.919zM15.251 8c0 .364-.028.727-.082 1.086l.74.112a7.966 7.966 0 0 0 0-2.398l-.74.114c.054.36.082.722.082 1.086zm.516 1.918-.728-.18a7.252 7.252 0 0 1-.832 2.012l.643.387a7.933 7.933 0 0 0 .917-2.219zm-6.68 5.25c-.72.11-1.453.11-2.173 0l-.112.742a7.99 7.99 0 0 0 2.396 0l-.112-.741zm4.75-2.868a7.229 7.229 0 0 1-1.537 1.534l.446.605a8.07 8.07 0 0 0 1.695-1.689l-.604-.45zM12.3 2.163c.587.432 1.105.95 1.537 1.537l.604-.45a8.06 8.06 0 0 0-1.69-1.691l-.45.604zM2.163 3.7A7.242 7.242 0 0 1 3.7 2.163l-.45-.604a8.06 8.06 0 0 0-1.691 1.69l.604.45zm12.688.163-.644.387c.377.623.658 1.3.832 2.007l.728-.18a7.931 7.931 0 0 0-.916-2.214zM6.913.831a7.254 7.254 0 0 1 2.172 0l.112-.74a7.985 7.985 0 0 0-2.396 0l.112.74zM2.547 14.64 1 15l.36-1.549-.729-.17-.361 1.548a.75.75 0 0 0 .9.902l1.548-.357-.17-.734zM.786 12.612l.732.168.25-1.073A7.187 7.187 0 0 1 .96 9.74l-.727.18a8 8 0 0 0 .736 1.902l-.184.79zm3.5 1.623-1.073.25.17.731.79-.184c.6.327 1.239.574 1.902.737l.18-.728a7.197 7.197 0 0 1-1.962-.811l-.007.005zM8 1.5a6.502 6.502 0 0 0-6.498 6.502 6.516 6.516 0 0 0 .998 3.455l-.625 2.668L4.54 13.5a6.502 6.502 0 0 0 6.93-11A6.516 6.516 0 0 0 8 1.5" />
                </svg>

                <span> نظرات کاربران
                    @if (count($newComments) > 0)
                        <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">
                            {{ count($newComments) }}
                        </small>
                    @endif
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('user.UserArticles.index') }}" class="nav-link">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-square" viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                </svg>
                <span> مدیریت مقاله ها </span>
            </a>
        </li>
        @if (\App\Models\Admin\SiteSetting::first()->paymentStatus)
            <li class="nav-item">
                <a href="{{ route('user.orders.index') }}" class="nav-link">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chat-square" viewBox="0 0 16 16">
                        <path
                            d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                    </svg>
                    <span> مدیریت مالی </span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a href="{{ route('user.dashboardHelp') }}" class="nav-link">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-square" viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                </svg>
                <span> راهنمای داشبورد </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.contact_us') }}" class="nav-link">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-square" viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                </svg>
                <span> تماس با ما  </span>
            </a>
        </li>

        

        <li class="nav-item">

            <form action="{{route('logout')}}" id="logoutForm" method="post">
            
                @csrf
                
            </form>
            <a onclick="$('#logoutForm').submit()"  class="nav-link">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-square" viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                </svg>
                
                <span> خروج  </span>
            </a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    @endhasvendor

</ul>
