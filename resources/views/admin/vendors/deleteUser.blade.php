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


                    <p>
                        <small class="text-danger">*</small>
                        <small>فروشگاه های ویژه مرتبط با آن حذف خواهند شد</small>
                    </p>


                    <p>
                        <small class="text-danger">*</small>
                        <small>اسلایدر های مرتبط با آن حذف خواهند شد</small>
                    </p>



                    <p>
                        <small class="text-danger">*</small>
                        <small>محصولات ویژه مرتبط با آن حذف خواهند شد</small>
                    </p>


                    <p>
                        <small class="text-danger">*</small>
                        <small>
                            برند های افزوده شده توسط آن فروشگاه به لیست برند های ادمین اضافه خواهند شد
                        </small>
                    
                    </p>


                    <p>
                        <small class="text-danger">*</small>
                        <small>
                            استوری های آن حذف خواهند شد
                        </small>
                    </p>


                    <p>
                        <small class="text-danger">*</small>
                        <small>
                            تمام موارد علامندی مرتبط با آن حذف خواهند شد
                        </small>
                    
                    </p>


                    <p>
                        <small class="text-danger">*</small>
                        <small>
                            تمام سیستم فالووینگ آن حذف خواهد شد
                        </small>
                    
                    </p>






                    <button onclick="$('#deleteForm').submit();" class="btn btn-danger">بله</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="col-12">

        <h1 class="text-center" style="color: black;"> حذف کاربر {{ $user->name }} </h1>


        <form class="col-12 text-center p-4" style="display: flex; flex-direction: column;"
            action="{{ route('admin.destroyUser') }}" id="deleteForm" method="post">

            @csrf

            <div class="col-12 justify-content-center" style="display: flex;"class="mt-3">

                <input onchange="canSubmit()" type="radio" name="type" id="type1" value="0" id="sample"
                    checked>
                <label onclick="$('#selectVendor').css('display' , 'none');" style="color: black;"> حذف کلی

                    <br>
                    <small>
                        (حذف تمام اطلاعات شامل فروشگاه , محصولات و ...)
                    </small>
                </label>

            </div>

            @if ($user->vendor)
                <div class="col-12 justify-content-center" style="display: flex;">

                    <input onchange="canSubmit()" type="radio" name="type" value="1" id="sendToanotherVendor">
                    <label onclick="$('#selectVendor').css('display' , 'flex');" style="color: black;" onclick=""
                        for="sendToanotherVendor"> حذف و انتقال
                        محصولات
                        <br>
                        <small>
                            ( کاربر و فروشگاه حذف خواهند شد ولی محصولات آن به فروشگاه دیگری انتقال داده
                            خواهد شد )
                        </small>
                    </label>
                </div>
            @endif
            <div id="selectVendor"
                style="height: 300px; margin-top: 100px; overflow: scroll; display: none; flex-direction: column;  "
                class="col-12">



                <small class="text-center text-black m-3" style="color: black;">لطفا فروشگاه مورد نظر را انتخاب کنید</small>

                @foreach ($vendors as $item)
                    @if (
                        $item->user->id != $user->id &&
                            $item->user->rols()->where('name', 'admin')->get()->count() == 0)
                        <div class="">
                            <input type="radio" class="vendor" name="vendor" value="{{ $item->id }}"
                                id="Vendor({{ $item->id }})">
                            <label style="color: black;" onclick="" for="Vendor({{ $item->id }})">
                                {{ $item->title }}
                            </label>
                        </div>
                    @endif
                @endforeach

            </div>


            <span class="text-danger errmsg" style="display: none;"><span class="text-danger"> * </span> لظفا یکی از فروشگاه
                ها را انتخاب کنید </span>

            <input type="hidden" name="username" value="{{ $user->id }}">

        </form>





        <div class="">
            <a href="{{ route('admin.allUsers') }}" class="btn btn-secondary">لغو</a>
            <button class="btn btn-danger"
                onclick="
        
        submit()
        
        
        
        @if (!$user->vendor) normalDelete(); @endif
        
        
        
        
        "
                id="submitbt">
                حذف
            </button>

        </div>



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


    function normalDelete() {
        var type = $('#type').val(1);

    }



    function canSubmit() {

        $('#submitbt').removeAttr("disabled");

    }
</script>
