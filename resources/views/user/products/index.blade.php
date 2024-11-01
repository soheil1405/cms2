@extends('user.layouts.user')

@section('title')
    index products
@endsection

<script>
    function deleteProduct(id) {

        console.log(id)
        if (window.confirm('آیا از حذف محصول ' + id + 'اطمینان دارید؟')) {
            $("#deleteForm_" + id).submit();
        }
    }
</script>


@section('content')
    <!-- Content Row -->
    <div class="container-fluid p-0">
        <div class="row p-0">

            <div class="col-12 bg-white rounded">
                <div class="col-xs-12 col-md-4 d-inline-block">
                    <h5 class="font-weight-bold mb-3 mt-1">لیست محصولات ({{ $products->total() }})</h5>

                </div>
                <div class="col-xs-12 col-md-4 d-inline-block">
                    <form class="navbar-search ">
                        <div class="input-group">


                            <input type="text" name="search"
                                class="form-control bg-light border border-primary small order-2" aria-label="Search"
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


                    </form>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 mb-4 py-4">


                @if (Session::has('update'))
                    <div class="alert alert-success">
                        {{ Session::get('update') }}
                    </div>
                @endif

                @if (Session::has('spcAdd'))
                    <div class="alert alert-success">
                        {{ Session::get('spcAdd') }}
                    </div>
                @endif
                @if (Session::has('created'))
                    <div class="alert alert-success">
                        {{ Session::get('created') }}
                    </div>
                @endif
                <div class="table-responsive" style="overflow-y: hidden;
                ">
                    <table class="table table-bordered table-striped text-center">

                        <thead>
                            <tr>

                                <th></th>
                                <th>عملیات</th>

                                <th>نام</th>
                                <th>نام برند</th>
                                <th>نام دسته بندی</th>
                                <th>عکس اصلی</th>

                                <th>تعداد بازدید</th>
                                <th>تعداد دیدگاه</th>
                                <th>تاریخ ثبت </th>
                                <th>پین</th>
                                <th>وضعیت</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>

                                    <th>
                                        @if (checkIfHasActiveSpc($product->id))
                                            <img style="width:40px; height:40px;"
                                                src="{{ asset('images/pngtree-vip-icon-for-game-golden-crown-with-red-jewel-png-image_3603951.jpg') }}"
                                                alt="">
                                        @endif

                                        @if (checkIfHasActiveStory($product->id))
                                            <img style="width:40px; height:40px;"
                                                src="{{ asset('images/instagram-stories.jpg') }}" alt="">
                                        @endif


                                    </th>

                                    <th>




                                        @if ($product->status == 'yes' && userDashboard(['usersSendStory', 'usersLaddelP', 'usersUpgradeProduct']))
                                            <div class="btn-group">
                                                <button class="btn btn-success btn-sm dropdown-toggle " type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                    ارتقای کالا

                                                </button>
                                                <div class="dropdown-menu">
                                                    <div class="text-center">


                                                        @if (userDashboard(['usersUpgradeProduct']))
                                                            <a href="{{ route('user.upgradeproduct.create', ['id' => $product->id]) }}"
                                                                class="dropdown-item border-bottom p-2"> تبلیغ محصول
                                                            </a>
                                                        @endif
                                                        @if (userDashboard(['usersLaddelP']))
                                                            <form class="m-0"
                                                                action="{{ route('user.products.ladder') }}"
                                                                method="post">


                                                                @csrf
                                                                <input type="hidden" name="product"
                                                                    value="{{ $product->id }}">



                                                                <button class="dropdown-item border-bottom p-2"
                                                                    type="submit" name="ladder" value="">

                                                                    نردبان
                                                                </button>



                                                            </form>
                                                        @endif

                                                        @if (userDashboard(['usersSendStory']))
                                                            <a href="{{ route('user.story.create', ['productId' => $product->id]) }}"
                                                                style="color:black;" class="dropdown-item  p-2">
                                                                استوری
                                                            </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="btn-group text-center">

                                            <button type="button"
                                                class="btn m-2 btn-sm btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                عملیات
                                            </button>
                                            <div style="" class="dropdown-menu text-center">




                                                <a href="{{ route('user.products.edit', ['product' => $product->id]) }}"
                                                    class="dropdown-item border-bottom p-2 text-dark"> ویرایش </a>

                                                <a class="dropdown-item  p-2 text-primary border-bottom"{{-- style="  font-size:8px border-radius: 3px;" --}}
                                                    href="{{ route('products.show', ['product' => $product->slug]) }}">نمایش</a>
                                                <form class="m-0" action="{{ route('user.deleteProduct') }}"
                                                    method="post" id="deleteForm_{{ $product->id }}">
                                                    @csrf
                                                    <input type="hidden" name='id' value="{{ $product->id }}">
                                                    <span onclick="deleteProduct({{ $product->id }})"
                                                        class="  p-2 d-block text-danger">

                                                        حذف
                                                    </span>
                                                </form>

                                            </div>
                                        </div>
                                    </th>
                                    {{-- <th>
                                        {{ $products->firstItem() + $key }}
                                    </th> --}}
                                    <th>
                                        <a href="{{ route('user.products.edit', ['product' => $product->id]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </th>
                                    <th>
                                        <a href="">
                                            {{ $product->brand->name }}
                                        </a>
                                    </th>
                                    <th>
                                        {{ $product->category->name }}
                                    </th>

                                    <th>
                                        <img src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                            style="width:40px; height:40px; object-fit: cover;" alt="">
                                    </th>

                                    <th>
                                        {{ $product->view_counter }}
                                    </th>


                                    <th>
                                        {{ count($product->commentCounts) }}
                                    </th>



                                    <th>

                                        <?php
                                        
                                        $datetime = \Morilog\Jalali\Jalalian::forge($product->created_at);
                                        
                                        $date = substr($datetime, 0, 10);
                                        
                                        echo $date;
                                        
                                        ?> </th>




                                    <th>
                                        <form action="{{ route('user.pinproducts') }}" method="post">

                                            @csrf
                                            <div class="d-flex">


                                                <input type="hidden" name="type" value="product">
                                                <input type="hidden" name="id" value="{{ $product->id }}">

                                                <input type="number" style="width:50px;" name="pin_number" id=""
                                                    value="{{ $product->VendorPinNumber }}">
                                                <input type="submit" class="" value="پین">
                                            </div>

                                        </form>

                                    </th>



                                    <th>
                                        @if ($product->status == 'yes')
                                            <a href="{{ route('user.products.edit', ['product' => $product->id]) }}">
                                                <span class="text-success ">

                                                    منتشر شده
                                                </span>
                                            </a>
                                        @elseif($product->status == 'reported')
                                            <a href="{{ route('user.products.edit', ['product' => $product->id]) }}">
                                                <span class="text-danger ">



                                                    ریپورت شده

                                                </span>

                                            </a>
                                        @elseif($product->status == 'reported-edited')
                                            <a href="{{ route('user.products.edit', ['product' => $product->id]) }}">
                                                <span class="text-danger ">



                                                    ریپورت شده -در انتظار تایید تغییرات جدید شما

                                                </span>

                                            </a>
                                        @elseif($product->status == 'edited')
                                            <a href="{{ route('user.products.edit', ['product' => $product->id]) }}">
                                                <span class="text-warning ">

                                                    در انتظار تایید ویرایش های جدید


                                                </span>

                                            </a>
                                        @elseif($product->status == 'new')
                                            <a href="{{ route('user.products.edit', ['product' => $product->id]) }}">
                                                <span class="text-warning ">

                                                    در صف انتشار

                                                </span>

                                            </a>
                                        @endif

                                    </th>



                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $products->links() }}
                {{-- <div class="d-flex justify-content-center mt-5">
                {{ $products->render() }}
            </div> --}}
            </div>
        </div>
    </div>


@endsection
