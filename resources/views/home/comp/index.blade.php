<?php
// it will be use for top menu on lg devices ... to find out cuurect page
$_SESSION['page'] = false;

?>



@extends('master')

@section('title', 'products')


@push('header_styles')
    @include('layouts.home.header.styles')
@endpush


@push('header_scripts')
    @include('layouts.home.header.scripts')
@endpush


@push('headers')
    @include('layouts.home.header.head')
@endpush


@push('contents')



    @if (Session::has('compList'))
        <?php
        $comp = Session::get('compList');
        ?>



        @foreach ($comp as $item)
            @if (is_null($item['product']))
                @php
                    $comp = Session::get('compList');

                    $myArray = [];

                    $product = Product::find($request->id);
                    $should_delete = [
                        'id' => $request->id,
                        'product' => $product,
                    ];

                    foreach ($comp as $item) {
                        if ($item['id'] != $request->id) {
                            array_push($myArray, $item);
                        }
                    }

                    Session::put('compList', $myArray);

                @endphp

                <script>
                    window.location.reload();
                </script>
            @endif
        @endforeach
        </div>

        </div>
        <div class="container">
            <div class="row mt-sm-header overflow-auto p-3">



                <table
                    class="table table-hover table-light table-responsive align-middle table-bordered table-striped text-center">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">نام محصول</th>
                            <th scope="col">نام فروشنده</th>
                            <th scope="col">عکس محصول</th>
                            <th scope="col">نام برند</th>
                            <th scope="col">دسته بندی</th>
                            <th scope="col">گارانتی</th>
                            <th scope="col">امتیاز</th>
                            <th scope="col">بازدید</th>
                            <th scope="col">قیمت</th>
                            <th scope="col">عملیات</th>


                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($comp as $item)
                            @if ($item["product"]->isActive())
                                <tr>
                                    <th scope="row"> {{ $item['product']->name }}</th>
                                    <td> {{ $item['product']->vendor->name }}</td>
                                    <td> <img class="card-img-top compItemPic"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item['product']->primary_image()) }}"
                                            alt="{{ $item['product']->name }}"></td>
                                    <td>
                                        {{ $item['product']->brand->name }}
                                    </td>
                                    <td>
                                        {{ $item['product']->category->name }}

                                    </td>
                                    <td>
                                        @if ($item['product']->Warranty != null)
                                            <span class="text-success compItem"> {{ $item['product']->Warranty }} </span>
                                        @else
                                            <span class="compItem"> ندارد </span>
                                        @endif
                                    </td>
                                    <td>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            @if ($item["product"]->rate_Ave >= '5') fill="#FFD700"

                                            @else


                                        fill="#949191" @endif
                                            class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            @if ($item["product"]->rate_Ave >= '4') fill="#FFD700"

                                            @else


                                        fill="#949191" @endif
                                            class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            @if ($item["product"]->rate_Ave >= '3') fill="#FFD700"

                                            @else


                                        fill="#949191" @endif
                                            class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            @if ($item["product"]->rate_Ave >= '2') fill="#FFD700"

                                        @else


                                        fill="#949191" @endif
                                            class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            @if ($item["product"]->rate_Ave >= '1') fill="#FFD700"

                                        @else


                                        fill="#949191" @endif
                                            class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>





                                    </td>
                                    <td>
                                        {{ $item['product']->view_counter }}

                                    </td>
                                    <td>
                                        <?php if($item['product']->product_price !=null ) { ?>
                                            <p style="width: 100%; text-align:start !important;" class="">
                                                قیمت
                                                <strong style="width: 100%; text-align:start !important; color:#0782f5 !important;"
                                                    class="text-center ">
                                                    {{ number_format($item['product']->product_price) }}
                                                    تومان
                                                </strong>
                                            </p>
                                            <?php }else{ ?>
                                            <p style="width: 100%; text-align:start !important;">
                                                قیمت : -
                                            </p>
                                            <?php } ?>
                
                                    </td>
                                    <td>

                                        <span class="btn btn-danger" onclick="deleteFromComp({{ $item['product']->id }})"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg></span>

                                        <a class="btn btn-primary"
                                            href="{{ route('products.show', ['vendor' => $item['product']->vendor->name, 'product' => $item['product']->slug]) }}">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                        </a>



                                    </td>

                                </tr>                        
                            @endif
                        @endforeach

                    </tbody>
                </table>











            </div>
        </div>
    @endif



@endpush

@push('footer_scripts')
    {{-- <div class="container"> --}}
    @include('layouts.home.footer.script')
@endpush
