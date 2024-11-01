@extends('admin.layouts.admin')

@section('title')
    show products
@endsection
<style>
    .changed {
        border: 1px solid green;
    }
</style>

@section('content')


    <?php
    $lastOne = count($data) - 1;
    
    ?>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>




                <form method="post" action="{{ route('admin.productEditList.report') }}">

                    @csrf

                    <input type="hidden" value="{{ $product->id }}" name="product_id">



                    <textarea name="text"></textarea>




                    <div class="modal-footer">

                        <label for="0">بدون متن</label>
                        <input type="radio" name="textStatus" value="0" id="0" checked>

                        <label for="1">با متن</label>
                        <input type="radio" name="textStatus" value="1" id="1">

                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                        <input type="submit" value="ریپوت تغییرات" class="btn btn-danger">
                    </div>
            </div>
            </form>
        </div>
    </div>





    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-4 col-md-4 mb-4 p-4 bg-white border  border-secondary">
            <div class="mb-4 text-center text-md-right">

                اطلاعات کنونی
            </div>
            <hr>

            <div class="row">
                <div class="form-group col-md-3">
                    <label>نام</label>{{ $product->name }}"

                    <br>
                    <label>نام برند</label>{{ $product->brand->name }}
                    <br>

                    <label>نام دسته بندی</label>{{ $product->category->name }}
                    <br>

                    <label>وضعیت گارانتی</label>
                    @if ($product->Warranty != null)
                        {{ $product->Warranty }}
                    @else
                        گارانتی ندارد
                    @endif
                    <br>

                    <label>تاریخ ایجاد</label>
                    {{ verta($product->created_at) }}"
                    <br>

                    <label>توضیحات</label>
                    {{ $product->description }}
                </div>



                {{-- Images --}}
                <div class="col-md-12">
                    <hr>
                    <p>تصاویر محصول : </p>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top"
                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                            alt="{{ $product->name }}">
                    </div>
                </div>


                @foreach ($product->images as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                alt="{{ $product->name }}">
                        </div>
                    </div>
                @endforeach

            </div>







        </div>
        <div class="col-xl-6 col-md-6 mb-4 p-4 bg-white ">
            <form action="{{ route('admin.productEditList.saveChanges') }}" id="mainForm" method="POST">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" >{{ $error }}</div>
                    @endforeach
                @endif
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>نام</label>

                        @if (get_object_vars($data[$lastOne])['name'])
                            <input class="form-control changed" type="text" name="name"
                                value="{{ get_object_vars($data[$lastOne])['name'] }}">
                        @else
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ $product->name }}">
                        @endif

                    </div>
                    <div class="form-group col-md-3">
                        <label>نام برند</label>
                        <select id="brandSelect" name="brand_id"
                            class="brandSelect
                    
                                        
                    @if (get_object_vars($data[$lastOne])['name']) changed @endif
                    
                    

                    
                    "
                            data-live-search="true">

                            @foreach ($brands as $brand)
                                @if (get_object_vars($data[$lastOne])['name'])
                                    @if ($brand->created_by == null || $brand->created_by == Auth::user()->vendor->id || $brand->is_active == 1)
                                        <option value="{{ $brand->id }}"
                                            @if ($brand->id == get_object_vars($data[$lastOne])['brand_id']) selected @endif>{{ $brand->name }}</option>
                                    @endif
                                @else
                                    <option value="{{ $brand->id }}" @if ($brand->id == $product->brand_id) selected @endif>
                                        {{ $brand->name }}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-md-3">
                        <label>نام دسته بندی</label>


                        <select name="category_id" @if (get_object_vars($data[$lastOne])['category_id']) class="changed" @endif>
                            @foreach ($categories as $category)
                                @if (get_object_vars($data[$lastOne])['category_id'])
                                    <option value="{{ $category->id }}" @if ($category->id == get_object_vars($data[$lastOne])['category_id']) selected @endif>
                                        {{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}" @if ($category->id == $product->lvl_one_category_id) selected @endif>
                                        {{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>




                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label>توضیحات</label>

                    @if (get_object_vars($data[$lastOne])['description'])
                        <textarea class="form-control changed" rows="3" name="description">{{ get_object_vars($data[$lastOne])['description'] }}</textarea>
                    @else
                        <textarea class="form-control" rows="3" name="description">{{ $product->description }}</textarea>
                    @endif
                </div>
                <input value="{{ $product->id }}" name="product_id" type="hidden">


            </form>


            {{-- Images --}}
            <div class="col-md-12">
                <hr>
                <p>تصاویر محصول : </p>
            </div>


            <div class='row'>

                @if (!is_null($primaryImage))
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top"
                                src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $primaryImage->image) }}"
                                alt="{{ $product->name }}">
                            <form id="photoForm"
                                action="{{ route('admin.products.images.destroy', ['product' => $product->id]) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $primaryImage->id }}">
                                <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>
                            </form>

                        </div>

                    </div>
                @endif


                @foreach ($images as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <img style="width: 120px;" class="card-img-top"
                                src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                                alt="{{ $product->name }}">
                            <div class="card-body text-center">
                                <form id="photoForm"
                                    action="{{ route('admin.products.images.destroy', ['product' => $product->id]) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>
                                </form>

                            </div>

                        </div>

                    </div>
                @endforeach


            </div>
        </div>

    </div>



    </div>
    </div>


    <div>




        <button class="btn btn-outline-primary mt-5" onclick="$('#mainForm').submit();">ویرایش</button>






        <a href="{{ route('admin.products.index') }}" class="btn btn-dark ">بازگشت</a>


    </div>





    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        ریپورت وبرایش ها

    </button>







    <form method="post" action="{{ route('admin.productEditList.deleteChanges') }}">

        @csrf

        <input type="hidden" value="{{ $product->id }}" name="product_id">
        <input type="submit" value="حذف همه وبرایش ها" class="btn btn-danger">

    </form>


    <div class="">



        لیست تغییرات
        <hr>
        <div class="row text-center">
        @for ($i = 1; $i <= count($data); $i++)
                <div class="col-12 justify-content-center">



                    @if (count($data) > 1)
                        تغییر شماره {{ $i }}

                        <hr>
                    @endif



                    <hr>
                    <?php $newData = get_object_vars($data[$i - 1]);
                    
                    $editorId = get_object_vars($newData[0])['editor'];
                    
                    $user = App\Models\User::find($editorId);
                    
                    $editTime = get_object_vars($newData[0])['time'];

                    $cat =  App\Models\category::find(get_object_vars($data[$i - 1])['category_id']); ;
                    $brand =  App\Models\Brand::find(get_object_vars($data[$i - 1])['brand_id']); ;

                    ?>


                    @if ($user)
                        ویرایش دهنده :

                        {{ $user->name }}
                    @endif



                    @if ($editTime)
                        /
                        تاریخ ویرایش :
                        {{ $editTime }}"



                        <br>
                    @endif
                    @if ($newData['name'])
                        نام جدید : {{ $newData['name'] }}

                        <br>
                    @endif

                    

                    @if ($newData['category_id'])
                        دسته بندی جدید : {{ $cat->name }}
                        <br>
                    @endif

                    @if ($newData['brand_id'])
                        برند جدید : {{ $brand->name }}
                        <br>
                    @endif

                    @if ($newData['description'])
                        توضیحات جدید : {{ $newData['description'] }}
                        <br>
                    @endif
                    
                    <hr>

                </div>
        @endfor

    </div>


@endsection



<script>
    function showDenyVendor() {

        $('#textTovendor').css('display', 'block');
        $('#ReportSubmit').css('display', 'block');


    }
</script>
