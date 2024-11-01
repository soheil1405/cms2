<style>
    .sidebar::-webkit-scrollbar {
        display: none;
    }
</style>

<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion pr-0" {{-- style="height:100vh !important; overflow-y: scroll;" --}} id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon ">
            <img class="img-fluid "
            src="http://instabargh.com/main/logoasli.png" width="50" height="50" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">
           اینستابرق
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductss"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-store"></i>

            <span> فروشگاه ها



                @if (count($vendorsInQueue) > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                        {{ count($vendorsInQueue) }}


                    </small>
                @endif



            </span>
        </a>
        <div id="collapseProductss" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('admin.vendors.index') }}">



                    همه فروشگاه ها




                </a>
                <a class="collapse-item" href="{{ route('admin.AllSpecialVendors') }}"> فروشگاه های ویژه




                </a>
            </div>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductsz"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-store"></i>

            <span>


                محصولات



                @if (count($productsInQueue) > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">




                        {{ count($productsInQueue) }}


                    </small>
                @endif



            </span>
        </a>
        <div id="collapseProductsz" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('admin.products.index') }}">
                    همه محصولات






                </a>
                <a class="collapse-item" href="{{ route('admin.allSpecialProducts') }}">


                    محصولات ویژه




                </a>
            </div>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-store"></i>
            <span> دسته بندی ها </span>
        </a>
    </li>




    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.allUsers') }}">
            <i class="fas fa-store"></i>
            <span> کاربران </span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.admins.index') }}">
            <i class="fas fa-store"></i>
            <span> ادمین ها </span>
        </a>
    </li>








    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.articles.index') }}">
            <i class="fas fa-store"></i>
            <span>مقالات ادمین</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.UserArticles.index') }}">
            <i class="fas fa-store"></i>
            <span> مقالات کاربران




                @if (count($inQueueArticles) > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                        {{ count($inQueueArticles) }}


                    </small>
                @endif

            </span>
        </a>
    </li>




    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.newsLinks.index') }}">
            <i class="fas fa-store"></i>
            <span> لینک های جذاب خبری </span>
        </a>
    </li>




    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.buyGuidProduct.index') }}">
            <i class="fas fa-store"></i>
            <span> راهنمای خرید کالا</span>
        </a>
    </li>





    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.brands.index') }}">
            <i class="fas fa-store"></i>
            <span> برند ها


                @if (count($brandsInQueue) > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                        {{ count($brandsInQueue) }}


                    </small>
                @endif




            </span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.comments.index') }}">
            <i class="fas fa-store"></i>
            <span> دیدگاه ها


                @if (count($commentInQueue) > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                        {{ count($commentInQueue) }}


                    </small>
                @endif





            </span>
        </a>
    </li>



    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tickets.index') }}">
            <i class="fas fa-store"></i>
            <span> تیکت ها


                @if ($notSeenTickets > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                        {{ $notSeenTickets }}


                    </small>
                @endif





            </span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.sliderss.index') }}">
            <i class="fas fa-store"></i>
            <span> اسلایدر ها



                @if (count($slidersInQueue) > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                        {{ count($slidersInQueue) }}


                    </small>
                @endif





            </span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.stories.index') }}">
            <i class="fas fa-store"></i>
            <span> استوری ها





                @if (count($storiesInQueue) > 0)
                    <small style=" float:left; padding:2px 5px; border-radius: 50%;" class="bg-danger">


                        {{ count($storiesInQueue) }}


                    </small>
                @endif





            </span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.settindDetail.index') }}">
            <i class="fas fa-store"></i>
            <span> تنظیمات سایت </span>
        </a>
    </li>


    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.brands.index') }}">
            <i class="fas fa-store"></i>
            <span> نظرات و پیام ها </span>
        </a>
    </li> --}}


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-store"></i>
            <span> مدیزیت مالی </span>
        </a>
    </li>


    <li class="nav-item">
        <a href="{{ route('admin.settindDetail.SiteAdds.edit') }}" class="nav-link"
            href="{{ route('admin.banners.index') }}">
            <i class="fas fa-store"></i>
            <span>
                بنر ها
            </span>
        </a>
    </li>







    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.brands.index') }}">
            <i class="fas fa-store"></i>
            <span> چیدمان منوی محصولات </span>
        </a>
    </li>








    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
