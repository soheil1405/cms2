@extends('admin.layouts.admin')

@section('title')
show products
@endsection

@section('content')

<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
        <div class="mb-4 text-center text-md-right">
            <h5 class="font-weight-bold">محصول : {{ $product->name }}</h5>
        </div>
        <hr>

        <div class="row">
            <div class="form-group col-md-3">
                <label>نام</label>
                <input class="form-control" type="text" value="{{ $product->name }}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label>نام برند</label>
                <input class="form-control" type="text" value="{{ $product->brand->name }}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label>نام دسته بندی</label>
                <input class="form-control" type="text" value="{{ $product->category->name }}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label>وضعیت گارانتی</label>
                @if($product->Warranty != Null)
                <input class="form-control" type="text" value="{{ $product->Warranty }}" disabled>
                @else


                <input class="form-control" type="text" value="گارانتی ندارد" disabled>

                @endif
            </div>
            <div class="form-group col-md-3">
                <label>تگ ها</label>
                <div class="form-control div-disabled">
                    @foreach ($product->tags as $tag)
                    {{ $tag->name }} {{ $loop->last ? '' : '،' }}
                    @endforeach
                </div>
            </div>
            <div class="form-group col-md-3">
                <label>تاریخ ایجاد</label>
                <input class="form-control" type="text" value="{{ verta($product->created_at) }}" disabled>
            </div>
            <div class="form-group col-md-12">
                <label>توضیحات</label>
                <textarea class="form-control" rows="3" disabled>{{ $product->description }}</textarea>
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

            <div class="col-md-12">
                <hr>
            </div>

            @foreach ($images as $image)
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                        alt="{{ $product->name }}">
                </div>
            </div>
            @endforeach


            <label for="">لینک ویدیو اپارات</label>
            <input type="text" disabled name="apatatVideoLink"  value="{{$product->apatatVideoLink}}" id="">


            @if ($product->apatatVideoLink)

            {!!  $product->apatatVideoLink !!}
            
            @endif

        </div>



        <form id="acceptProductRequest" action="{{ route('admin.acceptProduct') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-success" style="margin: 0 !important;" for="id"> تایید
                محصول
            </button>
            <input type="hidden" value="{{ $product->id }}" id="acceptVendor" name="id">

        </form>



        {{-- <button class="btn btn-outline-danger mt-5" onclick="showDenyVendor()">ریپورت محصول</button> --}}

        {{--
        <form id="DenyForm" action="{{route('admin.sendMassage')}}" method="POST">

            @csrf
            <textarea name="msg" id="textTovendor" style="display: none" cols="80" rows="10">
                </textarea>
            <input type="hidden" name="subject" value="product">
            <input type="hidden" name="subjectId" value="{{$product->id}}">
            <input type="submit" id="ReportSubmit" style="display: none" value="ریپورت" name="report">
        </form> --}}
        <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-5">بازگشت</a>

    </div>

</div>

@endsection



<script>
    function showDenyVendor(){

$('#textTovendor').css('display' , 'block');
$('#ReportSubmit').css('display' , 'block');


}

</script>