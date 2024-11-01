<?php


$_SESSION['page'] = 'Allproducts';

?>









@extends('master')

@section('title','products')


@push('header_styles')

    @include('layouts.home.header.styles')
    <style>
        body{
            overflow-x: hidden !important;
            transition: all 0.5s;
        }


        body::-webkit-scrollbar {
    display: none;
}
    </style>

@endpush


@push('header_scripts')


    @include('layouts.home.header.scripts')

@endpush


@push('headers')

    @include('layouts.home.header.head2')

@endpush


@push('contents')



    <div class="container" >



        <div id="DivCats"  onmouseover="CategoryShow()" style=" z-index:1000; display:none;opacity:0; background-color: blue;  position:fixed;  top:24%;    width:100%; height:500px;  display:flex " class="filterDiv">

            <div style="display:flex;  color:red; flex-direction:column ;flex-wrap:wrap;  height:100%;  width:100%;">

                <div style="display:flex; background-color: rgb(217, 255, 0); height:100%; color:red; flex-direction:column ;flex-wrap:wrap;">

                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>

                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>

                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>



                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>



                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>



                    <a href="">a</a>

                    <a href="">a</a>




                </div>

            </div>

            
        </div>
        
        <div id="DivBrands"  onmouseover="BransShow()" onmousemove="BrandHide()"  style=" z-index:1000; opacity:0; background-color: blue;  position:fixed;  top:24%;    width:100%; height:500px;  display:flex " class="filterDivs">

            <div style="display:flex;  color:red; flex-direction:column ;flex-wrap:wrap;  height:100%;  width:100%;">

                <div style="display:flex; background-color: rgb(0, 247, 255); height:100%; color:red; flex-direction:column ;flex-wrap:wrap;">

                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>

                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>

                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>



                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>



                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>


                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>
                    <a href="">a</a>



                    <a href="">a</a>

                    <a href="">a</a>




                </div>

            </div>

            
        </div>
        
        
        <div class="row">
            <div class="owl-carousel loop-vendor">
                @for ($i = 0 ; $i <count($products)  ; $i++)
                
                <div class="card round-25 h-30" style="">
                    
                    
                    <img src="{{url(env('PRODUCT_IMAGES_UPLOAD_PATH').$products[$i]->primary_image)}}" id="product_img" class="card-img-top round-25" alt="{{$products[$i]->name}}">
                            
                    
                    
                    <div class="card-body">
                        
                                    <h5 class="card-title">
                                        {{$products[$i]->name}}
                                    </h5>
                                    
                                    <p class="card-text" style="font-size: 15px; padding:0px !important">
                                        {{$products[$i]->description}}
                                      </p>
                                      
                                      <p>دسته ی :
                                          <br>
                                          <small>
                                              
                                              {{$products[$i]->category->name}}
                                              
                                            </small>
                                        
                                        </p>

                                        
                                        
                                        <p>
                                        برند
                                        <small>
                                            {{$products[$i]->brand->name}}
                                        </small>
                                    </p>

                                     <p>
                                        قیمت
                                        <small class="text-center texr-danger">
                                        {{$products[$i]->variations[0]->price}}
                                    </small>
                                        تومان
                                    </p>
                                    </div>
                                    <div class="card-footer">
                                        
                                        <a href="{{route('products.show',['vendor'=>$products[$i]->vendor->name,'product'=>$products[$i]->slug])}}" class="btn btn-primary w-100" style="font-size: 20px;">
                                            مشاهده محصول
                                        </a>
                                    </div>
                                </div>
                                @endfor  
                            </div>
                        </div>

                        
                    </div>       
                        
                        
                        
                </div>
            </div>
        </div>
    

        <div class="row">

                    @if($products->links())


                    <nav aria-label="Page navigation example"  class=" col-sm-12" >
                    <ul class="pagination col-sm-12" style=" padding:0 50%; margin:30px;" >


                        @if($products->currentPage() !=1  )
                        <li class=""><a class="page-link paaa" href="{{$products->previousPageUrl()}}" >قبلی</a></li>
                        @endif
                    

                        <li class=""><a class="page-link paaa"  style="  margin-right:2%; border:1px solid gray" href="" >{{$products->currentPage()}}</a></li>    

                        @if( $products->currentPage() != $products->lastPage()	)
                        <li   class=""><a class=" paaa page-link" href="{{$products->nextPageUrl()}}"     >بعدی</a></li>
                        @endif



                        </ul>
                    </nav>

                @endif

            </div>
        </div
        



@endpush




@push('footer_scripts')
      {{-- <div class="container"> --}}
         
    @include('layouts.home.footer.script')
@endpush
