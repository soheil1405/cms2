@extends('user.layouts.user')

@section('title')
    index products
@endsection

@section('content')
    @if (Session::has('storyStore'))
        <div class="alert alert-success">
            {{ Session::get('storyStore') }}
        </div>
    @endif

    @if (Session::has('tekrari'))
    <div class="alert alert-danger">
        {{ Session::get('tekrari') }}
    </div>
@endif


    <a href="{{route('user.upgrade')}}" class="btn btn-secondary">بازگشت</a>

    <h1>
        محصولات ویژه من
    </h1>
<table>
    <thead>
        <tr>
            <th>
                نام محصول
            </th>

            <th>
                غکس محصول
            
            </th>
            <th>
                تاریخ شروع
            </th>

            <th>
                تاریخ پایان
            </th>

            <th>
                وضعیت
            </th>

            <th>
                عملیات
            </th>
        </tr>
    </thead>

    @foreach ($specialProducts as $item)
    <tr>

        <th>
            {{$item->product->name}} 
        </th>
        <th>


            <img style="max-width: 50px;" class="card-img-top"
            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->product->primary_image) }}"
               alt="{{ $item->product->name }}">

        </th>



        <th>
            {{ \Morilog\Jalali\Jalalian::forge($item->fromDate) }}

        </th>

        <th>
            {{ \Morilog\Jalali\Jalalian::forge($item->toDate) }}
        </th>

        <th>
            <?php 
                
                $now = Carbon\Carbon::now();


                if($now > $item->fromDate && $now < $item->toDate )
                {
                    echo "منتشر شده";
                }elseif($now > $item->fromDate && $now > $item->toDate)
                {
                    echo "منقضی شده";        
                }else{
                    echo "در صف انتشار";              
                }

                
                
                
                ?>
                
        </th>

        <th>
            
            <form action="{{route('user.upgradeproduct.deleteUpgeatedProduct')}}" method="post">

                @csrf


                <input type="hidden" name="id" value="{{$item->id}}">

                <input type="submit" class="btn btn-danger" value="حذف">
               
                
            </form>

        </th>
    </tr>
    
    @endforeach

</tbody>

@endsection

<script></script>
