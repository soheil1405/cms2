@extends('user.layouts.user')

@section('title')
index products
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">


                <form action="{{ route('user.payAfterSend') }}" id="form" method="post">

                    @csrf

                    <input type="hidden" name="linkBack" value="{{ Route::current()->getName() }}">
                    <input type="hidden" name="type" value="story">

                    <input type="hidden" name="typeId" id="typeee">
                    انتخاب شیوه پرداخت
                    :
                    <br>
                    <label for="0">پرداخت از کیف پول</label>
                    <input type="radio" checked name="payType" value="0" id="0">

                    <br>
                    <label for="1">پرداخت از طریق درگاه پرداخت</label>
                    <input type="radio" name="payType" value="1" id="1">

                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                <button type="button" onclick="$('#form').submit();" class="btn btn-primary">پرداخت</button>
            </div>
        </div>
    </div>
</div>












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

    @if (Session::has('payed'))
    <div class="alert alert-success">
        {{ Session::get('payed') }}
    </div>
    @endif

    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">

        <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">

            <h5 class="font-weight-bold mb-3 mb-md-0">لیست استوری ها ({{ count($stories) }})</h5>

            <form action="" method="get" id="showByForm">
                <select name="showBy" id="" onchange="$('#showByForm').submit();">
                    <option value="all" @if (request()->has('showBy') && request('showBy') == 'all') selected @endif>همه
                        استوری ها</option>
                    <option value="notPayed" @if (request()->has('showBy') && request('showBy') == 'notPayed') selected
                        @endif>در انتظار پرداخت</option>
                    <option value="active" @if (request()->has('showBy') && request('showBy') == 'active') selected
                        @endif>استوری های فعال</option>
                    <option value="archive" @if (request()->has('showBy') && request('showBy') == 'archive') selected
                        @endif>آرشیو</option>
                    <option value="denied" @if (request()->has('showBy') && request('showBy') == 'denied') selected
                        @endif>رد شده ها</option>
                </select>
            </form>

        </div>




        @if ($errors->any())
        @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
        @endif












        <?php $dateNow = Carbon\Carbon::now(); ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">



                <thead>


                    <tr>



                        <th>نوع اسلایدر</th>
                        <th>ساخته شده توسط</th>
                        <th>
                            ُعکس استوری
                        </th>
                        <th>تاریخ ثبت </th>
                        <th>عملیات</th>
                    </tr>

                </thead>
                <tbody>



                    @foreach ($stories as $story)
                    <tr>



                        <th>


                            @if ($story->vendor_id && $story->product)
                            <a
                                href="{{ route('products.show', ['product' => $story->product->slug]) }}">


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
                            @if ($story->sendBy == 'admin')
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
                                src="{{ asset(env('STORY_MEDIAL_UPLOAD_PATH') . $story->media) }}" class="storycircle">
                            @endif



                        </th>

                        <th>
                            {{ \Morilog\Jalali\Jalalian::forge($story->created_at) }}


                        </th>


                        <th>


                            @if ($story->paymentStatus == 'inPaymentQueue' &&
                            \App\Models\Admin\SiteSetting::first()->paymentStatus &&
                            \App\Models\Admin\SiteSetting::first()->storyPayStatus)

                            <!-- Button trigger modal -->
                            <button type="button" onclick="$('#typeee').val({{$story->id}});" class="btn btn-primary"
                                data-toggle="modal" data-target="#exampleModal">
                                پرداخت و انتشار
                            </button>

                            @endif


                            <form action="{{ route('user.story.destroy' , ['story'=>$story]) }}"
                                id="deleteForm_{{$story->id}}" method="post">
                                @csrf


                                <input type="hidden" name="id" value="{{ $story->id }}">

                                <span onclick="deleteeee({{$story->id}})" class="btn btn-danger">حذف</span>
                            </form>

                            @if (!$story->isActive())
                                

                                <form action="{{ route('user.story.restory' , ['story'=>$story]) }}" method="post">
                                    @csrf


                                    <input type="hidden" name="story_id" value="{{ $story->id }}">

                               
                                    <input type="submit" value="استوری مجدد" 
                                    class="btn btn-danger">

                                </form>
                            @endif




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
    function deleteeee(id){

        console.log(id);
        if(confirm('ایا از حذف این استوری شماره '+id+'اظمینان دارید؟')  == true){
            $('#deleteForm_'+id).submit();
        }
    }
</script>