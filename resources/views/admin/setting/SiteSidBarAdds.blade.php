@extends('admin.layouts.admin')

@section('title')
    edit categories
@endsection

@section('script')
@endsection



@section('content')


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">افزودن لینک تبلیغ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">


                    <form action="{{ route('admin.settindDetail.SiteAdds.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="">لینک</label>
                            <input type="text" name="link" id="" class="from-controll" required>
                        </div>

                        <div class="form-group">
                            <label for="">عکس</label>
                            <input type="file" name="image" id="" class="from-controll" required>
                        </div>

                        <input type="submit" value="ذخیره تبلیغ" class="btn btn-success">
                    </form>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>

                </div>
            </div>
        </div>
    </div>



    <!-- Content Row -->
    <div class="row">

        @if (Session::has('created'))
            <div class="alert alert-success">
                {{ Session::get('created') }}
            </div>
        @endif
        @if (Session::has('deleted'))
            <div class="alert alert-success">
                {{ Session::get('deleted') }}
            </div>
        @endif
        @if (Session::has('edited'))
            <div class="alert alert-success">   
                {{ Session::get('edited') }}
            </div>
        @endif
        @if ($errors)
            @foreach ($errors->all() as $error)
      
            <div class="alert alert-danger">
                {{$error}}
            </div>
            @endforeach
        @endif
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">

                <h5 class="font-weight-bold mb-3 mb-md-0"> تبلیغات سایت</h5>


                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                    ایجاد تبلیغ

                </button>



            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">



                    <thead>


                        <tr>

                            
                            <th>لینک</th>


                            <th>
                               عکس
                            </th>





                            <th>وضعیت</th>

                            <th>
                                محل نمایش
                                </th>
                                
                                <th>
                                    عملیات
                            </th>
                        </tr>

                    </thead>
                    <tbody>



                        @foreach ($links as $link)
                            <tr>

                                <form action="{{route('admin.settindDetail.SiteAdds.update')}}" method="post"enctype="multipart/form-data">
                                    
                                    @csrf
                                    <input type="hidden" name="id" value="{{$link->id}}">
                                    
                                    <th>
                                        <input type="text" name="link" value="{{ $link->link }}" id="">
                                    </th>

                                    <th>
                                        <img style=" width:100px; height:50px; margin:15px; "
                                            src="{{ asset(env('SIDEBAR_LINKS_PIC_PATH') . $link->image) }}" class="">

                                        <input type="file" name="image" id="">
                                    </th>
                                    <th>


                                        <label for="1"> فعال</label>
                                        <input type="radio" name="status" id="1" value="1"
                                            @if ($link->status == 1) checked @endif>
                                        <label for="0"> غیر فعال</label>
                                        <input type="radio" name="status" id="0" value="0"
                                            @if ($link->status == 0) checked @endif>



                                    </th>
                                    <th>
                                        <label for="p">محصولات</label>
                                        <input type="checkbox" name="showInProducts"
                                        
                                        @if($link->showInProducts)

                                        checked

                                        @endif
                                        
                                        id="p" value="1">
                                        
                                        <label for="v">فروشگاه ها</label>
                                        <input type="checkbox" name="showInVendors" id="v"
                                        @if($link->showInVendors)

                                        checked

                                        @endif

                                        
                                        value="2">
                                        
                                        <label for="b">برند ها</label>
                                        <input type="checkbox"
                                        
                                        @if($link->showInBrands)

checked

@endif
                                        name="showInBrands" id="b" value="3">
                                        
                                        <hr>

                                        <label for="showInSingleProduct">صقحه تکی محصول</label>
                                        <input type="checkbox" name="showInSingleProduct"
                                        
                                        @if($link->showInSingleProduct)

                                        checked

                                        @endif
                                        
                                        id="showInSingleProduct" value="1">


                                        
                                        <label for="showInSingleVendor">صفحه تکی فروشگاه</label>
                                        <input type="checkbox" name="showInSingleVendor"
                                        
                                        @if($link->showInSingleVendor)

                                        checked

                                        @endif
                                        
                                        id="showInSingleVendor" value="1">


                                        
                                        <label for="showInSingleArticle">صفحه تکی مقاله</label>
                                        <input type="checkbox" name="showInSingleArticle"
                                        
                                        @if($link->showInSingleArticle)

                                        checked

                                        @endif
                                        
                                        id="showInSingleArticle" value="1">










                                    </th>

                                    <th>
                                        <input type="submit" value="ویرایش " class="btn btn-success mb-1">
                                    </form>
                                    
                                    <form action="{{route('admin.settindDetail.SiteAdds.delete')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$link->id}}">
                                        <input type="submit" value="حذف" class="btn btn-danger">
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
