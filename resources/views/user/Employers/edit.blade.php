@extends('user.layouts.user')

@section('title')
    کارمندان
@endsection





@section('content')



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    تغییر رمز کاربر

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    آیا از حذف کاربر اطمینان دارید؟

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
                    <button type="button" class="btn btn-primary">بله</button>
                </div>
            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-6">
            <h1>ویرایش کاربر </h1>
        </div>

        <div class="col-6 d-flex justify-content-end">


            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#exampleModal2">
                حذف کاربر
            </button>


        </div>
    </div>
    <form action="{{ route('user.Employees.update', ['Employee' => $user]) }}" method="post">



        @csrf

        @method('put')


        <input type="hidden" name="id" value="{{ $user->id }}">

        <div class="row">

            <div class=" col-3 p-1">
                <label for="">نام کاربر</label>
                <input type="text" name="name" class="form-control" id="" value="{{ $user->name }}"
                    required>
            </div>


            <div class="col-4 d-flex justify-content-end ">
                <input type="submit" value="ویرایش کاربر" class="btn btn-info m-2">

            </div>

        </div>



        <hr>


        <div class="row">
            <div class="col-3  ">


                {{-- <input type="checkbox" id="addsAll" onchange="selectAll();" name="addsAll"> --}}


                <label for="addsAll">تبلیغات</label>


                <div class="col-12 border border-secondary" style="height:300px; overflow-y: scroll;">
                    <div class="form-group">
                        <input type="checkbox" @if ($UserPermissions['user.story.create']) checked @endif class="Addddd"
                            name="newS" id="newS">


                        <label for="newS">ارسال استوری</label>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="newSpcV" id="newSpcV"
                            @if ($UserPermissions['user.story.create']) checked @endif>


                        <label for="newSpcV">ارسال فروشگاه به صفحه اول</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="SendSlider" id="SendSlider"
                            @if ($UserPermissions['user.vendorSliedrPage']) checked @endif>


                        <label for="SendSlider">ارسال اسلایدر</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="newSpcP" id="newSpcP"
                            @if ($UserPermissions['user.upgradeproduct.create']) checked @endif>


                        <label for="newSpcP">ارسال محصول به صفحه اول</label>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="ladderP" id="ladderP"
                            @if ($UserPermissions['user.products.ladder']) checked @endif>


                        <label for="ladderP">نردبان محصول</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="ladderV" id="ladderV"
                            @if ($UserPermissions['user.ladderVendor']) checked @endif>


                        <label for="ladderV">نردبان فروشگاه</label>

                    </div>




                </div>

            </div>

            <div class="col-3 ">

                {{-- <input type="checkbox" name="productsAll" id="productsAll" onchange="selectAll('ap')" id=""> --}}


                <label for="productsAll">محصولات</label>


                <div class="col-12 border border-secondary" style="height:300px; overflow-y: scroll;">

                    <div class="form-group">
                        <input type="checkbox" name="newp" id="newp"
                            @if ($UserPermissions['user.products.create']) checked @endif>


                        <label for="newp">افزودن محصول جدید</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="editp" id="editp" id=""
                            @if ($UserPermissions['user.products.edit']) checked @endif>


                        <label for="editp">ویرایش محصول</label>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="deletep" id="deletep"
                            @if ($UserPermissions['user.deleteProduct']) checked @endif>


                        <label for="deletep">حذف محصول</label>

                    </div>

                </div>

            </div>

            <div class="col-3 ">





                <label for="productsAll">سایر موارد</label>
                <br>
                <div class="col-12 border border-secondary" style="height:300px;">
                    <div class="form-group">
                        <input type="checkbox" name="editV" id="editV"
                        @if ($UserPermissions['user.vendor.images.edit']) checked @endif>


                        <label for="editV">ویرایش اظلاعات فروشگاه</label>

                    </div>
                    <div class="form-group">

                        <input type="checkbox" @if (
                            $UserPermissions['user.tickets.userIndex'] ||
                                $UserPermissions['user.tickets.createNew'] ||
                                $UserPermissions['user.tickets.show']
                        ) checked @endif name="TicketController"
                            id="TicketController">


                        <label for="TicketController">دسترسی به تیکت ها</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="commentController" id="commentController"
                            @if ($UserPermissions['user.comments']) checked @endif>


                        <label for="commentController">مدیریت دیدگاه ها</label>

                    </div>
                </div>


            </div>


            <div class="col-3 p-1">
                <label for="">حداکثر مبلغ قابل استفاده از کیف پول </label>
                <input type="numner" name="maxUseMoney" value="{{ $UserPermissions['maxUseMoney'] }}"
                    class="form-control" id="">

                تومان
            </div>
        </div>






        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

    </form>



    
@endsection



<script>
    function selectAll() {


        var btn = $('#addsAll');

        if (!$('input:checkbox').is('checked')) {
            console.log('checked');
        } else {
            console.log('0');

        }

    }
</script>
