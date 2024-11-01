@extends('admin.layouts.admin')
<link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet" />

@section('title')
    اسلایدر ها
@endsection



<script>
    // $('#from').MdPersianDateTimePicker({
    //     targetTextSelector: `#from`,
    //     englishNumber: true,
    //     enableTimePicker: true,
    //     textFormat: 'yyyy-MM-dd HH:mm:ss',
    // });


    // $('#to').MdPersianDateTimePicker({
    //     targetTextSelector: `#to`,
    //     englishNumber: true,
    //     enableTimePicker: true,
    //     textFormat: 'yyyy-MM-dd HH:mm:ss',
    // });
</script>

@section('content')
    <!-- Modal: modalCart -->
    <div class="row">

        @if (Session::has('accepted'))
            <div class="alert alert-success">
                {{ Session::get('accepted') }}
            </div>
        @endif

        @if (Session::has('destroy'))
            <div class="alert alert-success">
                {{ Session::get('destroy') }}
            </div>
        @endif

        @if (Session::has('edited'))
            <div class="alert alert-success">
                {{ Session::get('edited') }}
            </div>
        @endif

        @if (Session::has('created'))
            <div class="alert alert-success">
                {{ Session::get('created') }}
            </div>
        @endif

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">



                @if ($count_of_slider_in_Queue > 0)
                    <span class="text-danger">


                        {{ $count_of_slider_in_Queue }}

                        استوری

                        در انتظار تایید

                    </span>
                @endif


                <h5 class="font-weight-bold mb-3 mb-md-0">لیست استوری ها ({{ count($stories) }})</h5>

                <a href="{{ route('admin.stories.create') }}" class="btn btn-info">ایجاد استوری</a>

                <form action="" method="get" id="showByForm">
                    <select name="showBy" id="" onchange="$('#showByForm').submit();">
                        <option value="all" @if (request()->has('showBy') && request('showBy') == 'all') selected @endif>همه استوری ها</option>
                        <option value="active"@if (request()->has('showBy') && request('showBy') == 'active') selected @endif>استوری های فعال</option>
                        <option value="archive" @if (request()->has('showBy') && request('showBy') == 'archive') selected @endif>آرشیو</option>
                        <option value="denied" @if (request()->has('showBy') && request('showBy') == 'denied') selected @endif>رد شده ها</option>
                    </select>
                
                
                
                </form>

                <form action="" method="get">
                    <input type="submit" value="خروجی اکسل" name="ExcelExport" class="btn btn-success">
                </form>
    

            </div>
            <?php $dateNow = Carbon\Carbon::now(); ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">



                    <thead>


                        <tr>



                            <th>نوع استوری</th>
                            <th>ساخته شده توسط</th>
                            <th>
                                ُعکس اسلایدر
                            </th>
                            <th>تاریخ ثبت </th>




                            {{-- <th>تعداد کلیک</th> --}}
                            <th>عملیات</th>
                        </tr>

                    </thead>
                    <tbody>



                        @foreach ($stories as $story)
                            <tr>



                                <th>


                                    @if ( $story->vendor_id &&  $story->product)
                                        <a
                                            href="{{ route('products.show', ['vendor' => $story->vendor->name, 'product' => $story->product->slug]) }}">


                                            محصول {{ $story->product->name }}

                                        </a>
                                    @elseif($story->vendor_id && is_null($story->product))
                                       
                                    <a href="{{ route('vendor.home', ['vendor' => $story->vendor->name]) }}">


                                        فروشگاه {{ $story->vendor->name }}
                                    </a>

                                    @else
                                    
                                    
                                    محصول حذف شده


                                    @endif





                                </th>


                                <th>
                                    @if($story->sendBy == "admin")
                                    
                                    
                                    
                                    ادمین
                                    
                                    
                                    
                                    
                                    
                                    @elseif ($story->vendor)
                                        <a href="{{ route('vendor.home', ['vendor' => $story->vendor->name]) }}">


                                            فروشگاه {{ $story->vendor->name }}
                                        </a>
                                    @endif


                                </th>


                                <th>


                                    @if ($story->product)
                                        <img style="border-radius: 50%; width:100px; margin:15px; border:1px solid green;"
                                            src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $story->product->primary_image) }}"
                                            class="storycircle">
                                    @else
                                        <img style="border-radius: 50%; width:100px; margin:15px; border:1px solid green;"
                                            src="{{ asset(env('STORY_MEDIAL_UPLOAD_PATH') . $story->media) }}"
                                            class="storycircle">
                                    @endif



                                </th>

                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($story->created_at) }}


                                </th>


                                <th>
                                    <a class="btn btn-info"
                                        href="{{ route('admin.stories.edit', ['id' => $story->id]) }}">ویرایش</a>
                                    @if (is_null($story->acceptedbyAdmin))
                                        <form action="{{ route('admin.stories.accept') }}" method="post">
                                            @csrf


                                            <input type="hidden" name="id" value="{{ $story->id }}">

                                            <input type="submit"class="btn btn-success" value="تایید">
                                        </form>
                                    @endif




                                    <form action="{{ route('admin.stories.destroy') }}" method="post" class="mt-1">
                                        @csrf


                                        <input type="hidden" name="id" value="{{ $story->id }}">

                                        <input type="submit"class="btn btn-danger" value="حذف">
                                    </form>





                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection


<script>
    function acceptProductRequest() {


        $('#acceptProductRequest').submit();

    }


    function pId(id) {

        console.log(id);

        $('#product_id').val(id);

    }


    function AdProduct() {


        if (('#to') != "null") {
            $('#AdProductForm').submit();
        } else {
            alert('لطفا تاریخ پایان را  وارد کنید');
        }

    }
</script>




<style>
    table {
        font-size: 13px !important;
    }
</style>
