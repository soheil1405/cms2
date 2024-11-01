@extends('admin.layouts.admin')

@section('title')
    index vendors
@endsection


@section('content')
    <!-- Modal: modalCart -->
    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--Header-->
                <div id="CanAdd">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">ارسال فروشگاه به قسمت ویژه</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">


                        <form id="AdVendorForm" action="{{ route('admin.MakeVendorSpecial') }}" method="post">
                            @csrf

                            <input type="hidden" name="vendor_id" id="vendor_id">
                            <div class=""> <label for="from">از تاریخ</label>
                                <input type="date" id="from" name="from" class="range-from-example">
                            </div>


                            <div class="">
                                <label for="to">تا تاریخ</label>
                                <input type="date" id="to" name="to" class="range-to-example" required>

                            </div>


                            <div class="">


                                <div class=""> <label for="">شماره جایگاه</label>
                                    <small>(عدد مورد نظر باید بین 1 تا 12 باشد)</small>
                                </div>
                                <input type="number" min="1" max="12" name="position">
                            </div>


                        </form>

                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">لغو</button>
                        <button onclick="AdVendor()" class="btn btn-success">تایید</button>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Modal: modalCart -->


    <!-- Content Row -->
    <div class="row">



        @if (Session::has('success'))
        <div class="alert alert-info">
            <a class=" btn btn-danger close" data-dismiss="alert">×</a>
            {!! Session::get('success') !!}
        </div>
    @endif


        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
               
                
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست  کاربران ({{ $users->total() }})</h5>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام  </th>
                            <th> شماره موبایل  </th>
                            <th> اسم فروشگاه </th>
                            <th> نقش کاربر</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        
                        @foreach ($users as $user)
                      
                        
                        @if($user->id != 29 || $user->id != 12)
                            <a>
                                <tr>
                                    <th>
                                        {{ $vendor->id }}
                                    </th>
                                    <th>
                                        {{ $user->name }}
                                    </th>
                                    <th>
                                        {{ $user->mobile}}
                                    </th>
                                    <th>
                                        @if ( $user->vendor )
                                            {{ $user->vendor }}
                                        @else

                                        بدون فروشگاه

                                        @endif
                                    </th>
                                    <th>
                                        مدیر فروشگاه
                                    </th>
                                    <th>
                                
                                        
                                        <button class="btn btn-danger">حذف</button>

                                        <button class="btn btn-primary">ویرایش</button>

                                    </th>


                                </tr>
                            </a>

                            @endif
                            @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{-- {{ $brands->render() }} --}}
            </div>
        </div>
    </div>
@endsection




<script>
    function acceptVendorReuest() {


        $('#acceptVendorRequest').submit();

    }



    function vId(id) {

        console.log(id);

        $('#vendor_id').val(id);

    }


    function AdVendor() {


        if (('#to') != "null") {
            $('#AdVendorForm').submit();
        } else {
            alert('لطفا تاریخ پایان را  وارد کنید');
        }

    }
</script>

<style>
    table {
        font-size: 13px;
    }
</style>
