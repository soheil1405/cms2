@extends('admin.layouts.admin')

@section('title')
    delete user
@endsection


@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">


                    آیا از حذف فروشگاه اطمینان دارید؟


                    <button onclick="$('#deleVenorForm').submit();" class="btn btn-danger">بله</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>













    <div class="col-12">



        <h1 class="text-center" style="color: black;"> حذف فروشگاه {{ $vendor->name }} </h1>

        <div class="col-12 text-center m-4">

            <span class="text-danger"> توجه ! </span>

            <span> در این صفحه فقط می توانید فروشگاه مد نظر را حذف کنید و توحه داشته باشید که مدیر فروشندگاه حذف نخواهد شد
                ...</span>

        </div>

        <form class="col-12 text-center p-4" style="display: flex; flex-direction: column;"
            action="{{ route('admin.destroyVendor') }}" id="deleVenorForm" method="post">

            @csrf

            <div class="col-12 justify-content-center" style="display: flex;"class="mt-3">

                <input onchange="canSubmit()" type="radio" name="type" value="0" id="sample">
                <label onclick="$('#selectVendor').css('display' , 'none');" style="color: black;" for="sample"> حذف کلی

                    <br>
                    <small>
                        (حذف تمام اطلاعات فروشگاه شامل محصولات و ...)
                    </small>
                </label>

            </div>


            <div class="col-12 justify-content-center" style="display: flex;">

                <input onchange="canSubmit()" type="radio" name="type" value="1" id="sendToanotherVendor">
                <label onclick="$('#selectVendor').css('display' , 'flex');" style="color: black;" onclick=""
                    for="sendToanotherVendor"> حذف و انتقال
                    محصولات
                    <br>
                    <small>
                        (فروشگاه حذف خواهند شد ولی محصولات آن به فروشگاه دیگری انتقال داده
                        خواهد شد )
                    </small>
                </label>
            </div>




            <div id="selectVendor"
                style="height: 300px; margin-top: 100px; overflow: scroll; display: none; flex-direction: column;  "
                class="col-12">



                @foreach ($AllVendors as $item)
                    @if ($item->user->id != $vendor->user->id)
                        <div class="">
                            <input type="radio" class="vendor" name="vendor" value="{{ $item->id }}"
                                id="Vendor({{ $item->id }})">
                            <label style="color: black;" onclick="" for="Vendor({{ $item->id }})">
                                {{ $item->name }}
                            </label>
                        </div>
                    @endif
                @endforeach

            </div>


            <span class="text-danger errmsg" style="display: none;"><span class="text-danger"> * </span> لظفا یکی از فروشگاه
                ها را انتخاب کنید </span>

            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

        </form>





        <div class="col-12 text-center m-5">
            <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">لغو</a>
            <button class="btn btn-danger" onclick="submit()" id="submitbt">
                حذف
                (بدون حذف مدیر)

            </button>

        </div>


        <a class="text-danger" href="{{ route('admin.deleteUser', ['user' => $vendor->user->id]) }}"> حذف فروشگاه همراه با
            حذف مدیر </a>


    </div>
@endsection





<style>
    table {
        font-size: 13px;
    }
</style>


<script>
    function submit() {



        var type = $('input[name="type"]:checked').val();
        var vendor = $('input[name="vendor"]:checked').val();

        var errmsg = $('.errmsg');

        //    console.log(type);

        $('#exampleModalCenter').modal("hide");

        if (type == 1) {

            if (vendor) {
                errmsg.css('display', 'none');

                $('#exampleModalCenter').modal("show");


            } else {

                $('#exampleModalCenter').modal("hide");

                errmsg.css('display', 'block');



            }
        } else {

            $('#exampleModalCenter').modal("show");

            errmsg.css('display', 'none');
            console.log("0");
        }

    }



    function canSubmit() {





        $('#submitbt').removeAttr("disabled");

    }
</script>
